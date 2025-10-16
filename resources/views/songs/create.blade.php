@extends('layout')

@section('content')

<div class="min-h-screen bg-white px-4 py-12 flex items-center justify-center">
    <div class="w-full max-w-xl">
        <div class="mb-6">
            <h2 class="text-2xl font-extrabold text-black">Subir canción</h2>
            <p class="text-sm text-gray-600">Añade una pista para compartirla o mantenerla privada.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-600">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white border border-gray-200 rounded-lg p-6">
            @csrf
            <div>
                <label class="block text-sm text-gray-700">Título</label>
                <input type="text" name="title" class="w-full border border-gray-200 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Artista</label>
                <input type="text" name="artist" class="w-full border border-gray-200 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Archivo (mp3, wav, ogg)</label>
                <input type="file" name="file" class="w-full" required>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('songs.index') }}" class="text-sm px-3 py-1 border border-gray-200 rounded mr-2">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-black text-white rounded">Subir</button>
            </div>
        </form>
    </div>
</div>

@endsection
