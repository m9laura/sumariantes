@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@section('content_header')
<h1>Detalles del Tipo de Caso</h1>
@stop

@section('content')

<h3>Nombre: {{ ucfirst($tipoCaso->nombre) }}</h3>
<p>Descripción: {{ $tipoCaso->descripcion }}</p>
<p>Estado: {{ $tipoCaso->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
<p>Gravedad: 
    @switch($tipoCaso->gravedad)
        @case(1)
            Económico
        @break
        @case(2)
            Días de impedimento
        @break
        @default
            Destitución
    @endswitch
</p>
<p>Fecha: {{ $tipoCaso->fecha }}</p>

<h4>Casos Relacionados:</h4>
<ul>
    @forelse ($casos as $caso)
        <li>{{ $caso->identificacion_caso }}</li>
    @empty
        <li>No hay casos relacionados.</li>
    @endforelse
</ul>

<a href="{{ route('tipo_casos.index') }}" class="btn btn-secondary">Volver</a>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')

@stop
