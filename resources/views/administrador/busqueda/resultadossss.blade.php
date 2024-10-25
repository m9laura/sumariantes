@extends('adminlte::page')

@section('title', 'Resultados de la búsqueda')

@section('content_header')
    <h1 style="font-family: 'Times New Roman', Times, serif;">Resultados de la Búsqueda</h1>
@endsection

@section('content')
<div class="container" style="font-family: 'Times New Roman', Times, serif;">
    <!-- Botones para seleccionar la tabla -->
    <div class="text-center mb-4">
        <div class="btn-group">
            <button id="btnPersonas" class="btn btn-custom mx-2">Personas</button>
            <button id="btnCasos" class="btn btn-custom mx-2">Casos</button>
            <button id="btnTipoCasos" class="btn btn-custom mx-2">Tipo Casos</button>
            <button id="btnActuas" class="btn btn-custom mx-2">Actuas</button>
        </div>
    </div>

    <!-- Formulario para los filtros -->
    <form id="searchForm" method="POST" action="{{ route('busqueda.buscar') }}">
        @csrf
        <!-- Contenedor para los filtros -->
        <div id="filtersContainer" style="opacity: 0; transition: opacity 0.5s;"></div>
        
        <div class="text-center">
            <button type="submit" id="btnBuscar" class="btn btn-warning btn-lg mt-3" disabled>Buscar</button>
        </div>
    </form>

    <!-- Mostrar Resultados -->
    <div class="container mt-4">
        @if (isset($results) && $results->isEmpty())
            <div class="alert alert-warning">
                No se encontraron resultados.
            </div>
        @elseif (isset($results))
            <div class="table-responsive">
                <h1 style="font-family: 'Times New Roman', Times, serif;">Resultados de Búsqueda</h1>
                <table id="resultados-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            @if ($results->first() instanceof \App\Models\Persona)
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>WhatsApp</th>
                                <th>CI</th>
                                <th>Institución</th>
                                @if (auth()->user()->can('busquedas.show') || auth()->user()->can('busquedas.pdf'))
                                    <th>Acción</th>
                                @endif
                            @elseif ($results->first() instanceof \App\Models\Caso)
                                <th>Exp. Adm</th>
                                <th>Estado del Proceso</th>
                                <th>Fecha</th>
                            @elseif ($results->first() instanceof \App\Models\TipoCaso)
                                <th>Nombre</th>
                                <th>Descripción</th>
                            @elseif ($results->first() instanceof \App\Models\Actua)
                                <th>Nombre</th>
                                <th>Descripción</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                @if ($result instanceof \App\Models\Persona)
                                    <th scope="row">{{ $result->id }}</th>
                                    <td>{{ ucfirst($result->nombre) }}</td>
                                    <td>{{ ucfirst($result->apellidop) }}</td>
                                    <td>{{ ucfirst($result->apellidom) }}</td>
                                    <td>{{ ucfirst($result->whatsapp) }}</td>
                                    <td>{{ ucfirst($result->ci) }}</td>
                                    <td>{{ ucfirst($result->institucion) }}</td>
                                    @if (auth()->user()->can('busquedas.show') || auth()->user()->can('busquedas.pdf'))
                                        <td>
                                            @can('busquedas.pdf')
                                                <a class="btn btn-primary btn-sm" href="{{ route('busquedas.pdf', $result) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    @endif
                                @elseif ($result instanceof \App\Models\Caso)
                                    <td>{{ $result->exp_adm }}</td>
                                    <td>{{ $result->estado_proceso }}</td>
                                    <td>{{ $result->fecha }}</td>
                                @elseif ($result instanceof \App\Models\TipoCaso)
                                    <td>{{ $result->nombre }}</td>
                                    <td>{{ $result->descripcion }}</td>
                                @elseif ($result instanceof \App\Models\Actua)
                                    <td>{{ $result->nombre }}</td>
                                    <td>{{ $result->descripcion }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@stop

@section('css')
    <style>
        /* Botones con borde negro y fondo blanco */
        .btn-custom {
            background-color: #fff;
            color: #000;
            border: 2px solid #000;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s;
        }

        /* Estilo del botón activo */
        .btn-active {
            background-color: #007bff;
            /* Color azul */
            color: #fff;
            border-color: #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Estilo del botón desactivado */
        .btn-disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Estilo para organizar los campos en dos columnas */
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            width: 48%;
            margin-bottom: 10px;
        }

        /* Ajustar para pantallas más pequeñas */
        @media (max-width: 768px) {
            .form-group {
                width: 100%;
            }
        }

        .btn-warning {
            width: 50%;
            /* Hacer que el botón Buscar ocupe el 50% del ancho */
        }
    </style>
@stop

@section('js')
<script>
    function setActiveButton(button) {
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.classList.remove('btn-active');
        });
        button.classList.add('btn-active');
    }

    function generateFilters(fields) {
        const container = document.getElementById('filtersContainer');
        container.innerHTML = ''; // Limpia el contenedor antes de agregar nuevos campos
        fields.forEach(field => {
            const div = document.createElement('div');
            div.className = 'form-group';
            div.innerHTML = `
                <label for="${field}">${field.charAt(0).toUpperCase() + field.slice(1)}:</label>
                <input type="text" id="${field}" name="${field}" class="form-control">
            `;
            container.appendChild(div);
        });
        container.style.opacity = '1'; // Mostrar el contenedor de filtros
        document.getElementById('btnBuscar').disabled = false; // Habilitar el botón de búsqueda
    }

    // Event listeners para los botones
    document.getElementById('btnPersonas').addEventListener('click', function() {
        setActiveButton(this);
        generateFilters(['nombre', 'apellidop', 'apellidom', 'whatsapp']); // Campos para Personas
    });

    document.getElementById('btnCasos').addEventListener('click', function() {
        setActiveButton(this);
        generateFilters(['exp_adm', 'registro_auxiliar', 'fecha']); // Campos para Casos
    });

    document.getElementById('btnTipoCasos').addEventListener('click', function() {
        setActiveButton(this);
        generateFilters(['nombre', 'descripcion']); // Campos para Tipo Casos
    });

    document.getElementById('btnActuas').addEventListener('click', function() {
        setActiveButton(this);
        generateFilters(['nombre', 'descripcion', 'tipo']); // Campos para Actuas
    });
</script>
@stop
