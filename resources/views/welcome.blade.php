@extends('layout')

@section('title','Inicio - Sonora')

@section('content')
	<section class="bg-white rounded-lg shadow-sm overflow-hidden">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center p-8">
			<div>
				<h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">Comparte tu música. Llega más lejos.</h1>
				<p class="mt-4 text-gray-600 text-lg">Sube, escucha y comparte pistas en segundos. Sonora es rápido, ligero y diseñado para músicos y oyentes.</p>

				<div class="mt-6 flex gap-3">
					<a href="{{ route('songs.index') }}" class="px-5 py-2 bg-sky-600 text-white rounded-md shadow hover:bg-sky-700">Explorar canciones</a>
					@guest
						<a href="{{ route('register') }}" class="px-5 py-2 border rounded-md text-sky-600 border-sky-200">Registro</a>
					@endguest
				</div>

				<div class="mt-8 grid grid-cols-3 gap-3 max-w-sm">
					<div class="bg-gray-50 p-4 rounded">
						<div class="text-xs text-gray-500">Canciones</div>
						<div class="mt-1 text-xl font-bold">{{ \App\Models\Song::count() }}</div>
					</div>
					<div class="bg-gray-50 p-4 rounded">
						<div class="text-xs text-gray-500">Usuarios</div>
						<div class="mt-1 text-xl font-bold">{{ \App\Models\User::count() }}</div>
					</div>
					<div class="bg-gray-50 p-4 rounded">
						<div class="text-xs text-gray-500">Última subida</div>
						<div class="mt-1 text-sm">{{ optional(\App\Models\Song::latest()->first())->created_at?->diffForHumans() ?? '—' }}</div>
					</div>
				</div>
			</div>

			<div>
				<div class="bg-gradient-to-br from-indigo-50 to-white p-6 rounded">
					<h3 class="text-lg font-semibold text-gray-800">Últimas canciones</h3>
					<div class="mt-4 space-y-3">
						@forelse(\App\Models\Song::latest()->take(6)->get() as $recent)
							<div class="flex items-center gap-4 p-3 bg-white border rounded shadow-sm">
								<div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded flex items-center justify-center font-semibold">♪</div>
								<div class="flex-1 min-w-0">
									<div class="text-sm font-medium text-gray-900 truncate">{{ $recent->title }}</div>
									<div class="text-xs text-gray-500 truncate">{{ $recent->artist }}</div>
								</div>
								<div class="w-36">
									<audio controls class="w-full">
										<source src="{{ asset('storage/' . $recent->file_path) }}" type="audio/mpeg">
									</audio>
								</div>
							</div>
						@empty
							<div class="text-sm text-gray-500">Todavía no hay canciones. Sé el primero en subir una.</div>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="features" class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
		<div class="p-6 bg-white rounded shadow-sm">
			<h4 class="font-semibold">Sube en segundos</h4>
			<p class="mt-2 text-sm text-gray-500">Interfaz simple para subir tus pistas y compartir enlaces.</p>
		</div>
		<div class="p-6 bg-white rounded shadow-sm">
			<h4 class="font-semibold">Reproductor integrado</h4>
			<p class="mt-2 text-sm text-gray-500">Escucha online con controles responsive.</p>
		</div>
		<div class="p-6 bg-white rounded shadow-sm">
			<h4 class="font-semibold">Privacidad y control</h4>
			<p class="mt-2 text-sm text-gray-500">Decide quién ve y descarga tus pistas.</p>
		</div>
	</section>

@endsection
