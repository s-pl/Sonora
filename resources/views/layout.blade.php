<!DOCTYPE html>
<html lang="en">
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonora</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white min-h-screen font-sans">
    <nav class="border-b border-gray-200 py-4 mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-gray-900">Sonora</a>
            <div class="flex gap-4 items-center">
                <a href="{{ route('songs.index') }}" class="text-gray-700 font-semibold">Canciones</a>
                @auth
                    <div class="relative">
                        <button id="userMenuBtn" class="text-gray-700 font-semibold focus:outline-none">{{ auth()->user()->name }}</button>
                        <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden">
                            <a href="{{ route('songs.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mis canciones</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Salir</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 font-semibold">Entrar</a>
                    <a href="{{ route('register') }}" class="text-gray-700 font-semibold">Registro</a>
                @endauth
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener('click', function(e){
            const btn = document.getElementById('userMenuBtn');
            const menu = document.getElementById('userMenu');
            if (!btn) return;
            if (btn.contains(e.target)) {
                menu.classList.toggle('hidden');
            } else if (!menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
    <main class="container mx-auto px-4">
        @yield('content')
    </main>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap');
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</body>
</html>
</body>
</html>