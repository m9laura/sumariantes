@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<h1 class="m-0">Asignar Sanciones a Sumariantes</h1>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sancion_personas.store') }}" method="POST" id="sancionForm">
                @csrf

                <div class="form-group mb-3">
                    <label for="personas" class="form-label">Seleccionar Personas</label>
                    <select multiple id="personas" name="persona_id[]" class="form-control select2" required>
                        <!-- Aquí se llenarán las opciones de personas -->
                    </select>
                    <input type="text" id="personaSearch" class="form-control mt-2" placeholder="Buscar por CI o Nombre" />
                    <ul id="personaResults" class="list-group mt-2" style="display:none;"></ul> <!-- Inicialmente oculto -->
                </div>

                <div class="form-group mb-3">
                    <label for="sanciones" class="form-label">Seleccionar Sumariantes</label>
                    <select multiple id="sanciones" name="sancion_id[]" class="form-control select2" required>
                        <!-- Aquí se llenarán las opciones de sanciones -->
                    </select>
                    <input type="text" id="sancionSearch" class="form-control mt-2" placeholder="Buscar por Nombre" />
                    <ul id="sancionResults" class="list-group mt-2" style="display:none;"></ul> <!-- Inicialmente oculto -->
                </div>

                <div class="form-group mb-3">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" />
                </div>

                <button type="submit" class="btn btn-primary mt-3">Asignar Sumariantes</button>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
<style>
    /* Asegurarse de que el Select2 ocupe el 100% de su contenedor */
    .select2-container {
        width: 100% !important; /* Asegura que el select2 sea completamente responsivo */
    }

    /* Estilos para resaltar el campo de entrada al ser seleccionado */
    .form-control:focus {
        border-color: #6f42c1; /* Cambia el color a lo que desees */
        box-shadow: 0 0 5px rgba(111, 66, 193, 0.5); /* Sombra alrededor del campo */
    }

    /* Cambia el color de la línea del select2 */
    .select2-container--bootstrap4 .select2-selection--multiple {
        border: 1px solid #6f42c1; /* Cambia el color a lo que desees */
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
        background-color: #6f42c1; /* Color del fondo de las opciones seleccionadas */
        color: #fff; /* Color del texto de las opciones seleccionadas */
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff; /* Color del icono de eliminar */
    }

    /* Color del texto de las opciones no seleccionadas */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__placeholder {
        color: #6f42c1; /* Cambia a lo que desees */
    }

    /* Estilo para los resultados de búsqueda */
    .list-group {
        max-height: 200px; /* Altura máxima para el listado */
        overflow-y: auto; /* Agregar scroll si hay más de 5 resultados */
        z-index: 1000; /* Asegúrate de que aparezca encima */
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
            url: "{{ route('sancion_personas.create') }}",
            method: "GET",
            data: { persona: query },
            success: function(data) {
                $('#personaResults').empty();
                if (data.length > 0) {
                    $.each(data, function(index, persona) {
                        $('#personaResults').append(`<li class="list-group-item persona-item" data-id="${persona.id}">${persona.ci} - ${persona.nombre}</li>`);
                    });
                    $('#personaResults').show(); // Muestra los resultados
                } else {
                    $('#personaResults').hide(); // Oculta si no hay resultados
                }
            }
        });
    });

    // Agregar persona seleccionada
    $(document).on('click', '.persona-item', function() {
        let id = $(this).data('id');
        let option = `<option value="${id}">${$(this).text()}</option>`;
        $('#personas').append(option).trigger('change'); // Actualiza el select2
        $('#personaResults').empty().hide(); // Limpia resultados y oculta
        $('#personaSearch').val('');
    });

    // Búsqueda de sanciones
    $('#sancionSearch').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('sancion_personas.create') }}",
            method: "GET",
            data: { sancion: query },
            success: function(data) {
                $('#sancionResults').empty();
                if (data.length > 0) {
                    $.each(data, function(index, sancion) {
                        $('#sancionResults').append(`<li class="list-group-item sancion-item" data-id="${sancion.id}">${sancion.nombre}</li>`);
                    });
                    $('#sancionResults').show(); // Muestra los resultados
                } else {
                    $('#sancionResults').hide(); // Oculta si no hay resultados
                }
            }
        });
    });

    // Agregar sanción seleccionada
    $(document).on('click', '.sancion-item', function() {
        let id = $(this).data('id');
        let option = `<option value="${id}">${$(this).text()}</option>`;
        $('#sanciones').append(option).trigger('change'); // Actualiza el select2
        $('#sancionResults').empty().hide(); // Limpia resultados y oculta
        $('#sancionSearch').val('');
    });
});
</script>
@stop