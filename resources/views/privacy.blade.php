@extends('layout')

@section('title','Política de privacidad - Sonora')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold">Política de privacidad</h1>
        <p class="mt-4 text-gray-600">Última actualización: {{ date('Y-m-d') }}</p>

        <section class="mt-6">
            <h2 class="font-semibold">Recopilación de datos</h2>
            <p class="text-sm text-gray-600 mt-2">Recopilamos la información que proporcionas al registrarte y al subir contenido (nombre, correo electrónico, archivos de audio y metadatos asociados).</p>
        </section>

        <section class="mt-4">
            <h2 class="font-semibold">Uso de datos</h2>
            <p class="text-sm text-gray-600 mt-2">Usamos los datos para ofrecer el servicio, procesar subidas y enviar notificaciones relevantes. Nunca venderemos tu información a terceros.</p>
        </section>

        <section class="mt-4">
            <h2 class="font-semibold">Contacto</h2>
            <p class="text-sm text-gray-600 mt-2">Para preguntas sobre privacidad escribe a <a href="mailto:privacy@sonora.local" class="text-sky-600">privacy@sonora.local</a>.</p>
        </section>
    </div>
</div>
@endsection
