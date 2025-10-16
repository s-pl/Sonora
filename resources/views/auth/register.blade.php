@extends('layout')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-white">
    <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-xl border border-gray-200 animate-fade-in">
        <!-- Icono eliminado -->
        <h2 class="text-2xl font-extrabold mb-4 text-center text-black">Registro</h2>
        <form method="POST" action="{{ url('/register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700">Nombre</label>
                <input type="text" name="name" class="w-full border border-gray-200 rounded px-3 py-2" required value="{{ old('name') }}">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border border-gray-200 rounded px-3 py-2" required value="{{ old('email') }}">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Contraseña</label>
                <input type="password" name="password" class="w-full border border-gray-200 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-200 rounded px-3 py-2" required>
            </div>
            @if($errors->any())
                <div class="text-sm text-red-600">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="w-full px-4 py-2 bg-black text-white rounded">Registrarse</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-700">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</div>

@endsection
