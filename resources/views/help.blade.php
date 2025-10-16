@extends('layout')

@section('title','Ayuda - Sonora')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold">Centro de ayuda</h1>
        <p class="mt-4 text-gray-600">Aquí encontrarás respuestas a las preguntas más frecuentes sobre Sonora.</p>

        <div class="mt-6">
            <h2 class="font-semibold">Subir pistas</h2>
            <p class="text-sm text-gray-600 mt-2">Para subir una pista, ve a "Mis canciones" y usa el formulario. Asegúrate de que tu archivo esté en formato MP3 y que no exceda el límite de tamaño.</p>
        </div>

        <div class="mt-4">
            <h2 class="font-semibold">Privacidad</h2>
            <p class="text-sm text-gray-600 mt-2">Puedes controlar quién ve tus pistas desde la página de edición de cada canción.</p>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Contacto</h3>
            <p class="text-sm text-gray-600 mt-2">Si necesitas ayuda adicional escribe a <a href="mailto:soporte@sonora.local" class="text-sky-600">soporte@sonora.local</a>.</p>
        </div>
    </div>
</div>
@endsection
