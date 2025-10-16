@extends('layout')

@section('title','Términos y condiciones - Sonora')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold">Términos y condiciones</h1>
        <p class="mt-4 text-gray-600">Última actualización: {{ date('Y-m-d') }}</p>

        <section class="mt-6">
            <h2 class="font-semibold">Aceptación</h2>
            <p class="text-sm text-gray-600 mt-2">Al usar Sonora aceptas estos términos. No publiques contenido que infrinja derechos de autor ni material ilegal.</p>
        </section>

        <section class="mt-4">
            <h2 class="font-semibold">Contenido del usuario</h2>
            <p class="text-sm text-gray-600 mt-2">Eres responsable del contenido que subes. Puedes eliminar tus archivos en cualquier momento desde la interfaz.</p>
        </section>

        <section class="mt-4">
            <h2 class="font-semibold">Limitación de responsabilidad</h2>
            <p class="text-sm text-gray-600 mt-2">Sonora no se hace responsable por el uso indebido del contenido por terceros. Revisa las condiciones completas aquí.</p>
        </section>
    </div>
</div>
@endsection
