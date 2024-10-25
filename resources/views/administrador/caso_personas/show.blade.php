@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    {{-- Datos del sumario: {{ $persona->nombre }}&nbsp;{{ $persona->apellidop }} --}}
                </h1>
            </strong>

            <!-- Alinear los botones justo después del apellido -->
            <div class="d-flex justify-content-start mt-3">
                <!-- Botón Mostrar Sanción -->
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#sancionModal">
                    Mostrar Sanción
                </button>
                <!-- Botón Mostrar Casos -->
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#casosModal">
                    Mostrar Casos
                </button>
                <!-- Botón Mostrar tipo de Sumarios Gestión -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sumariosgestionModal">
                    Mostrar tipo de Sumarios Gestión
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container">
    <h1>Detalles de Persona en Caso</h1>
    
    <!-- Detalles del caso -->
    <h2>Detalles del Caso</h2>
    <div class="mb-3">
        <strong>ID del Caso:</strong> {{ $casoPersona->id }}
    </div>
    <div class="mb-3">
        <strong>Descripción del Caso:</strong> {{ $casoPersona->descripcion }} <!-- Ajusta según tu modelo -->
    </div>
    <div class="mb-3">
        <strong>Fecha del Caso:</strong> 
        {{ $casoPersona->fecha ? $casoPersona->fecha->format('Y-m-d') : 'No disponible' }}
    </div>

    <!-- Detalles de la persona -->
    <h2>Detalles de las Personas</h2>
    @foreach ($casoPersona->personas as $persona)
        <div class="mb-3">
            <strong>ID de la Persona:</strong> {{ $persona->id }}
        </div>
        <div class="mb-3">
            <strong>Nombre:</strong> {{ $persona->nombre }}
        </div>
        <div class="mb-3">
            <strong>Apellido Paterno:</strong> {{ $persona->apellidop }}
        </div>
        <div class="mb-3">
            <strong>Apellido Materno:</strong> {{ $persona->apellidom }}
        </div>
        <div class="mb-3">
            <strong>CI:</strong> {{ $persona->ci }}
        </div>
        <div class="mb-3">
            <strong>Género:</strong> {{ $persona->genero ? 'Masculino' : 'Femenino' }}
        </div>
        <div class="mb-3">
            <strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($persona->fnacimiento)->format('Y-m-d') }}
        </div>
        <div class="mb-3">
            <strong>WhatsApp:</strong> {{ $persona->whatsapp }}
        </div>
        <div class="mb-3">
            <strong>Nacionalidad:</strong> {{ $persona->nacionalidad }}
        </div>
        <div class="mb-3">
            <strong>Institución:</strong> {{ $persona->institucion }}
        </div>
        <div class="mb-3">
            <strong>Fecha de Relación:</strong> 
            {{ isset($persona->pivot->fecha) && $persona->pivot->fecha instanceof \Carbon\Carbon ? $persona->pivot->fecha->format('Y-m-d') : 'No disponible' }}
        </div>
    @endforeach

    <a href="{{ route('caso_personas.edit', $casoPersona->id) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('caso_personas.destroy', $casoPersona->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
    <a href="{{ route('caso_personas.index') }}" class="btn btn-secondary">Regresar</a>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .custom-img {
            max-width: 100%;
            height: auto;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(127, 5, 7)) 1;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }

        .photo-container {
            max-width: 300px;
            /* Ajusta este valor según tu diseño */
            margin: 0 auto;
            /* Para centrar la foto */
        }
    </style>
@stop

@section('js')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@stop
