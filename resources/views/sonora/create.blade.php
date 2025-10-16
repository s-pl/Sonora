@extends('layout')

@section('content')

<h1 class="text-3xl font-bold mb-6">Add Song</h1>


<form method="POST" action="/sonora" id="songForm" class="space-y-4">
    @csrf

    <!-- Campo oculto para almacenar la cadena Base64 del audio -->
    <input type="hidden" name="audio_base64" id="audio_base64">

    <!-- CAMPO DE CARGA DE ARCHIVO DE AUDIO -->
    <div class="p-4 border rounded-lg bg-gray-50">
        <label for="audio_file" class="block text-sm font-medium text-gray-700 mb-2">
            Audio File (MP3/WAV)
        </label>
        <input 
            type="file" 
            name="audio_file_input" 
            id="audio_file_input" 
            accept="audio/*" 
            class="block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4
                   file:rounded-full file:border-0
                   file:text-sm file:font-semibold
                   file:bg-indigo-50 file:text-indigo-700
                   hover:file:bg-indigo-100"
        >
        <p id="conversion_status" class="mt-2 text-sm text-yellow-600 hidden">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-yellow-500 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Converting file to Base64... Please wait.
        </p>
    </div>
    @error('audio_base64')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <!-- CAMPOS DE METADATOS -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="artist" class="block text-sm font-medium text-gray-700">Artist</label>
        <input type="text" name="artist" id="artist" value="{{ old('artist') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('artist')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="album" class="block text-sm font-medium text-gray-700">Album</label>
        <input type="text" name="album" id="album" value="{{ old('album') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('album')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('genre')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
        <input type="number" name="year" id="year" value="{{ old('year') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('year')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="cover_url" class="block text-sm font-medium text-gray-700">Cover Image URL</label>
        <input type="url" name="cover_url" id="cover_url" value="{{ old('cover_url') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('cover_url')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" id="submitButton"
        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Add Song
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('songForm');
        const fileInput = document.getElementById('audio_file_input');
        const base64Input = document.getElementById('audio_base64');
        const submitButton = document.getElementById('submitButton');
        const statusMessage = document.getElementById('conversion_status');

        // Función para deshabilitar el botón y mostrar el estado de conversión
        function setProcessing(isProcessing) {
            submitButton.disabled = isProcessing;
            if (isProcessing) {
                submitButton.textContent = 'Processing...';
                statusMessage.classList.remove('hidden');
            } else {
                submitButton.textContent = 'Add Song';
                statusMessage.classList.add('hidden');
            }
        }
        
        // Deshabilitar el botón inicialmente si no hay archivo
        setProcessing(false);

        // 1. Manejar el envío del formulario
        form.addEventListener('submit', function(e) {
            // Si el campo oculto ya tiene datos, se envía directamente
            if (base64Input.value) {
                return; 
            }

            // Si no hay Base64, detenemos el envío para procesar el archivo
            e.preventDefault(); 
            
            const file = fileInput.files[0];

            if (!file) {
                alert('Please select an audio file.');
                return;
            }

            setProcessing(true);

            // 2. Usar FileReader para leer el archivo
            const reader = new FileReader();

            reader.onload = function(event) {
                // event.target.result contiene la cadena Base64
                
                // Extraemos solo la parte de los datos (después de la coma)
                const base64String = event.target.result.split(',')[1];
                
                // 3. Almacenar la Base64 en el campo oculto
                base64Input.value = base64String;

                // 4. Re-enviar el formulario programáticamente
                // Esto permite que Laravel reciba la cadena B64 como un campo POST normal.
                form.submit();
            };

            reader.onerror = function(error) {
                setProcessing(false);
                console.error("Error reading file:", error);
                alert("An error occurred while reading the file.");
            };

            // Inicia la lectura del archivo como URL de datos (que es Base64)
            reader.readAsDataURL(file);
        });
    });
</script>
<style>
/* Solo un poco de estilo Tailwind si tu layout no lo tiene */
.shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.rounded-md {
    border-radius: 0.375rem;
}
</style>
@endsection
