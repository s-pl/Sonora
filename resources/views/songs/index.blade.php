@extends('layout')

@section('content')

<div class="min-h-screen bg-white px-4 py-12">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-black">Canciones</h2>
                <p class="text-sm text-gray-600">Tus pistas subidas y las públicas.</p>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Conectado como</div>
                        <div class="font-medium text-black">{{ auth()->user()->name }}</div>
                    </div>
                @endauth
                <a href="{{ route('songs.create') }}" class="px-4 py-2 bg-black text-white rounded-lg text-sm">Subir</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 text-center text-sm text-green-700">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($songs as $song)
                <div class="border border-gray-200 rounded-lg p-4 bg-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-lg font-semibold text-black">{{ $song->title }}</div>
                            <div class="text-sm text-gray-500">{{ $song->artist }}</div>
                        </div>
                        <div class="text-sm text-gray-400">{{ $song->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="mt-4">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                    </div>
                    <div class="mt-4 flex gap-2 justify-end">
                        <button onclick="showEditModal({{ $song->id }}, '{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}')" class="text-sm px-3 py-1 border border-gray-300 rounded">Editar</button>
                        <form method="POST" action="{{ route('songs.destroy', $song->id) }}" onsubmit="return confirm('¿Eliminar esta canción?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm px-3 py-1 border border-gray-300 rounded">Eliminar</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-400">No hay canciones subidas aún.</div>
            @endforelse
        </div>

        <!-- Modal de edición -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h3 class="text-lg font-semibold text-black">Editar canción</h3>
                <form id="editForm" method="POST" enctype="multipart/form-data" class="mt-4 space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm text-gray-700">Título</label>
                        <input type="text" name="title" id="editTitle" class="w-full border border-gray-200 rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700">Artista</label>
                        <input type="text" name="artist" id="editArtist" class="w-full border border-gray-200 rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700">Archivo (opcional)</label>
                        <input type="file" name="file" class="w-full">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="px-3 py-1 border border-gray-200 rounded">Cancelar</button>
                        <button type="submit" class="px-3 py-1 bg-black text-white rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function showEditModal(id, title, artist) {
                document.getElementById('editModal').style.display = 'flex';
                document.getElementById('editTitle').value = title;
                document.getElementById('editArtist').value = artist;
                document.getElementById('editForm').action = '/songs/' + id;
            }
            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }
        </script>
    </div>
</div>

@endsection

