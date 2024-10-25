@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un tipos de Sumarios</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="mt-3">Crear Nueva Relación entre Sumarios y Tipo de Sumarios</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('persona_tipo_personas.store') }}" method="POST" id="relationForm">
            @csrf

            <div class="form-group mb-3">
                <label for="personas" class="form-label">Seleccionar Personas</label>
                <select multiple id="personas" name="persona_id[]" class="form-control select2" required>
                    <!-- Inicialmente vacío, las opciones se llenarán a través de la búsqueda -->
                </select>
                <input type="text" id="personaSearch" class="form-control mt-2" placeholder="Buscar por CI o Nombre" />
                <ul id="personaResults" class="list-group mt-2" style="display:none;"></ul> <!-- Inicialmente oculto -->
            </div>

            <div class="form-group mb-3">
                <label for="tipo_personas" class="form-label">Seleccionar Tipos de Persona</label>
                <select multiple id="tipo_personas" name="tipo_persona_id[]" class="form-control select2" required>
                    <!-- Inicialmente vacío, las opciones se llenarán a través de la búsqueda -->
                </select>
                <input type="text" id="tipoPersonaSearch" class="form-control mt-2" placeholder="Buscar por Nombre" />
                <ul id="tipoPersonaResults" class="list-group mt-2" style="display:none;"></ul> <!-- Inicialmente oculto -->
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-3">Crear Relación</button>
                <a href="{{ route('persona_tipo_personas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
            </div>
        </form>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <style>
        /* Asegurarse de que el Select2 ocupe el 100% de su contenedor */
        .select2-container {
            width: 100% !important;
            /* Asegura que el select2 sea completamente responsivo */
        }

        /* Estilos para los resultados de búsqueda */
        .persona-item,
        .tipo-item {
            cursor: pointer;
            /* Cambia el cursor al pasar sobre los resultados */
            padding: 10px;
            /* Espaciado interno */
            border: 1px solid #ddd;
            /* Bordes alrededor de los resultados */
            margin-bottom: 5px;
            /* Espaciado entre resultados */
            border-radius: 5px;
            /* Bordes redondeados */
            background-color: #ffffff;
            /* Color de fondo */
            transition: background-color 0.3s;
            /* Suaviza la transición de color */
        }

        /* Cambia el color de fondo al pasar el ratón */
        .persona-item:hover,
        .tipo-item:hover {
            background-color: #e0e0e0;
            /* Cambia el fondo al pasar el ratón */
            color: #333;
            /* Cambia el color del texto al pasar el ratón */
        }

        /* Estilos para el campo de búsqueda al ser seleccionado */
        .form-control:focus {
            border-color: #6f42c1;
            /* Cambia el color del borde */
            box-shadow: 0 0 5px rgba(111, 66, 193, 0.5);
            /* Sombra alrededor del campo */
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                placeholder: "Seleccione",
                allowClear: true
            });

            // Búsqueda de personas
            $('#personaSearch').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('search.personas') }}",
                    method: "GET",
                    data: {
                        persona: query
                    },
                    success: function(data) {
                        $('#personaResults').empty(); // Limpia resultados anteriores
                        if (data.length > 0) {
                            data.forEach(persona => {
                                $('#personaResults').append(
                                    `<li class="persona-item" data-id="${persona.id}">${persona.ci} - ${persona.nombre}</li>`
                                    );
                            });
                            $('#personaResults').show(); // Muestra los resultados
                        } else {
                            $('#personaResults').html('<li>No se encontraron resultados.</li>')
                                .show();
                        }
                    },
                    error: function() {
                        $('#personaResults').html('<li>Error al buscar personas.</li>').show();
                    }
                });
            });

            // Seleccionar persona de resultados
            $(document).on('click', '.persona-item', function() {
                let id = $(this).data('id');
                let text = $(this).text(); // Obtener el texto de la selección

                // Comprobar si ya está seleccionado
                if (!$(`#personas option[value="${id}"]`).length) {
                    let option = `<option value="${id}" selected>${text}</option>`;
                    $('#personas').append(option).trigger('change'); // Actualiza el select2
                }
                $('#personaSearch').val(''); // Limpia el campo de búsqueda
                $('#personaResults').empty().hide(); // Limpia los resultados
            });

            // Ocultar resultados si el campo de búsqueda está vacío
            $('#personaSearch').on('blur', function() {
                setTimeout(() => {
                    $('#personaResults').hide();
                }, 200);
            });

            // Búsqueda de tipos de personas
            $('#tipoPersonaSearch').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('search.tipo_personas') }}",
                    method: "GET",
                    data: {
                        tipo_persona: query
                    },
                    success: function(data) {
                        $('#tipoPersonaResults').empty(); // Limpia resultados anteriores
                        if (data.length > 0) {
                            data.forEach(tipo => {
                                $('#tipoPersonaResults').append(
                                    `<li class="tipo-item" data-id="${tipo.id}">${tipo.nombre}</li>`
                                    );
                            });
                            $('#tipoPersonaResults').show(); // Muestra los resultados
                        } else {
                            $('#tipoPersonaResults').html(
                                '<li>No se encontraron resultados.</li>').show();
                        }
                    },
                    error: function() {
                        $('#tipoPersonaResults').html(
                            '<li>Error al buscar tipos de persona.</li>').show();
                    }
                });
            });

            // Seleccionar tipo de persona de resultados
            $(document).on('click', '.tipo-item', function() {
                let id = $(this).data('id');
                let text = $(this).text(); // Obtener el texto de la selección

                // Comprobar si ya está seleccionado
                if (!$(`#tipo_personas option[value="${id}"]`).length) {
                    let option = `<option value="${id}" selected>${text}</option>`;
                    $('#tipo_personas').append(option).trigger('change'); // Actualiza el select2
                }
                $('#tipoPersonaSearch').val(''); // Limpia el campo de búsqueda
                $('#tipoPersonaResults').empty().hide(); // Limpia los resultados
            });

            // Ocultar resultados si el campo de búsqueda está vacío
            $('#tipoPersonaSearch').on('blur', function() {
                setTimeout(() => {
                    $('#tipoPersonaResults').hide();
                }, 200);
            });
        });
    </script>
@stop
