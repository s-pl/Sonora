<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Sonora')</title>

  
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
       
        tailwind.config = {
          theme: {
            extend: {
              colors: { accent: '#06b6d4' },
              fontFamily: { sans: ['Montserrat', 'ui-sans-serif', 'system-ui'] }
            }
          }
        }
    </script>

    <!-- Alpine for small interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

    @stack('head')
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 font-sans">

    <header x-data="{open:false, userOpen:false}" class="bg-white/60 backdrop-blur sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="/" class="flex items-center gap-3">
                        
                        <span class="font-semibold text-lg">Sonora</span>
                    </a>
                    <nav class="hidden md:flex items-center gap-4 text-sm text-gray-600">
                        <a href="{{ route('songs.index') }}" class="hover:text-accent">Canciones</a>
                    </nav>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Search removed per request --}}

                    @auth
                        <div class="relative" x-data="{open:false}">
                            <button @click="open = !open" class="flex items-center gap-2 px-3 py-1 rounded hover:bg-gray-100">
                                <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                                <span class="hidden sm:inline font-medium">{{ auth()->user()->name }}</span>
                            </button>
                            <div x-show="open" @click.away="open=false" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg">
                                <a href="{{ route('songs.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mis canciones</a>
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Salir</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex items-center gap-2">
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-accent">Entrar</a>
                            <a href="{{ route('register') }}" class="text-sm px-3 py-1 bg-sky-600 text-white rounded hover:bg-sky-700">Registro</a>
                        </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <button @click="open = !open" class="md:hidden p-2 rounded hover:bg-gray-100">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile panel -->
        <div x-show="open" x-transition class="md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('songs.index') }}" class="block">Canciones</a>
                @guest
                    <a href="{{ route('login') }}" class="block">Entrar</a>
                    <a href="{{ route('register') }}" class="block">Registro</a>
                @endguest
            </div>
        </div>
    </header>

    <main class="pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="mt-16 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <a href="/" class="flex items-center gap-3 mb-4 inline-block">
                        
                        <span class="font-semibold text-lg">Sonora</span>
                    </a>
                    <p class="text-sm text-gray-600">Plataforma ligera para subir y compartir música. Diseñada para creadores y oyentes que valoran la simplicidad.</p>
                    <div class="mt-4 flex items-center gap-3">
                        <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.92c-.66.29-1.36.48-2.09.57a3.66 3.66 0 0 0 1.61-2.02 7.34 7.34 0 0 1-2.33.9 3.66 3.66 0 0 0-6.24 3.34A10.4 10.4 0 0 1 3.15 4.7a3.66 3.66 0 0 0 1.13 4.88 3.6 3.6 0 0 1-1.66-.46v.05a3.66 3.66 0 0 0 2.93 3.59c-.3.08-.62.12-.95.12-.23 0-.46-.02-.68-.06a3.67 3.67 0 0 0 3.42 2.54A7.34 7.34 0 0 1 2 19.54 10.36 10.36 0 0 0 7.29 21c6.28 0 9.72-5.2 9.72-9.71v-.44c.67-.48 1.25-1.09 1.7-1.78a7.2 7.2 0 0 1-2.71.74z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 6.5A4.5 4.5 0 1 0 16.5 13 4.5 4.5 0 0 0 12 8.5zm6.5-3a1 1 0 1 0 1 1 1 1 0 0 0-1-1z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="GitHub">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5A12 12 0 0 0 0 12.6c0 5.3 3.4 9.8 8.2 11.4.6.1.8-.3.8-.6v-2.1c-3.3.7-4-1.6-4-1.6-.5-1.3-1.3-1.6-1.3-1.6-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1 1.6.8 1.9 1.2.5.9 1.2 1.2 2 .9.1-.7.4-1.2.7-1.5-2.6-.3-5.3-1.3-5.3-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.3 0 0 1-.3 3.3 1.2a11.2 11.2 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.7.2 3 .1 3.3.8.8 1.2 1.9 1.2 3.2 0 4.6-2.7 5.6-5.3 5.9.4.4.7 1 .7 2v3c0 .3.2.7.8.6A12 12 0 0 0 12 .5z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-semibold">Navegación</h4>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li><a href="{{ route('songs.index') }}" class="hover:text-accent">Canciones</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" class="hover:text-accent">Entrar</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-accent">Registro</a></li>
                        @endguest
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold">Recursos</h4>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li><a href="{{ route('help') }}" class="hover:text-accent">Ayuda</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-accent">Política de privacidad</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-accent">Términos</a></li>
                    </ul>
                </div>

                <div class="md:col-span-1">
                    <h4 class="text-sm font-semibold">Boletín</h4>
                    <p class="mt-2 text-sm text-gray-600">Recibe noticias y lanzamientos destacados.</p>
                    <form action="#" method="POST" class="mt-4 flex gap-2">
                        <input aria-label="Correo" type="email" name="email" placeholder="tu@correo.com" class="flex-1 border border-gray-200 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-sky-200">
                        <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md text-sm hover:bg-sky-700">Suscribir</button>
                    </form>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-6 text-sm text-gray-500 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>© {{ date('Y') }} Sonora. Todos los derechos reservados.</div>
                <div class="flex items-center gap-4">
                    
                </div>
            </div>
        </div>
    </footer>

    

    @stack('scripts')
</body>
</html>