@extends('layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-4 py-12">
	<div class="max-w-5xl w-full">
		<div class="flex flex-col items-center text-center">
			<div>
				<h1 class="text-4xl md:text-5xl font-extrabold text-black leading-tight">Sonora</h1>
				<p class="mt-3 text-gray-600 text-lg">Sube, escucha y comparte tu música. Minimalista, rápido y fácil de usar.</p>

				<div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl mx-auto">
					<div class="p-4 bg-gray-50 border border-gray-200 rounded text-center">
						<div class="text-sm text-gray-500">Canciones</div>
						<div class="mt-2 text-2xl font-bold text-black">{{ \App\Models\Song::count() }}</div>
					</div>
					<div class="p-4 bg-gray-50 border border-gray-200 rounded text-center">
						<div class="text-sm text-gray-500">Usuarios</div>
						<div class="mt-2 text-2xl font-bold text-black">{{ \App\Models\User::count() }}</div>
					</div>
					<div class="p-4 bg-gray-50 border border-gray-200 rounded text-center">
						<div class="text-sm text-gray-500">Última subida</div>
						<div class="mt-2 text-sm text-gray-700">{{ optional(\App\Models\Song::latest()->first())->created_at?->diffForHumans() ?? '—' }}</div>
					</div>
				</div>

				<div class="mt-8 max-w-3xl mx-auto">
					<h3 class="text-lg font-semibold text-black">Últimas canciones</h3>
					<div class="mt-4 space-y-4">
						@foreach(\App\Models\Song::latest()->take(5)->get() as $recent)
							<div class="border border-gray-100 rounded p-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
								<div class="text-center sm:text-left">
									<div class="font-medium text-black">{{ $recent->title }}</div>
									<div class="text-sm text-gray-500">{{ $recent->artist }}</div>
								</div>
								<div class="w-full sm:w-48">
									<audio controls class="w-full">
										<source src="{{ asset('storage/' . $recent->file_path) }}" type="audio/mpeg">
										Tu navegador no soporta el elemento de audio.
									</audio>
								</div>
							</div>
						@endforeach
						@if(\App\Models\Song::count() === 0)
							<div class="text-sm text-gray-500">Todavía no hay canciones. Sé el primero en subir una.</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
