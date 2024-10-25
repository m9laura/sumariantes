@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body text-center">
        <h1 class="font-weight-bold" style="text-transform: uppercase;">Formulario para agregar un Caso Actuado</h1>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="card-title">Asignar Casos y Actuados</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('caso_actuados.store') }}" method="POST" id="casoActuadoForm">
                @csrf

                <!-- Búsqueda de Casos -->
                <div class="form-group mb-4">
                    <label for="casos" class="form-label">Seleccionar Casos</label>
                    <select multiple id="casos" name="caso_id[]" class="form-control select2" required>
                        <!-- Aquí se llenarán las opciones de casos -->
                    </select>
                    <input type="text" id="casoSearch" class="form-control mt-2" placeholder="Buscar por Expediente Administrativo o Identificación" />
                    <ul id="casoResults" class="list-group mt-2 shadow-sm" style="display:none;"></ul> <!-- Inicialmente oculto -->
                </div>

                <!-- Búsqueda de Actuados -->
                <div class="form-group mb-4">
                    <label for="actuas" class="form-label">Seleccionar Actuados</label>
                    <select multiple id="actuas" name="actua_id[]" class="form-control select2" required>
                        <!-- Aquí se llenarán las opciones de actuados -->
                    </select>
                    <input type="text" id="actuaSearch" class="form-control mt-2" placeholder="Buscar por Nombre" />
                    <ul id="actuaResults" class="list-group mt-2 shadow-sm" style="display:none;"></ul> <!-- Inicialmente oculto -->
                </div>

                <!-- Fecha -->
                <div class="form-group mb-4">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" />
                </div>

                <!-- Botón de enviar -->
                <button type="submit" class="btn btn-primary btn-block shadow-sm">Asignar Actuados</button>
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
    /* Estilos generales para el formulario */
    body {
        background-color: #f8f9fa; /* Color de fondo general */
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .card-header {
        background-color: #6f42c1;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .form-group {
        position: relative; /* Para poder aplicar efectos de hover */
    }

    .form-control {
        border-radius: 0.25rem; /* Bordes redondeados para inputs */
        font-size: 14px; /* Tamaño de fuente más pequeño */
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 5px rgba(111, 66, 193, 0.5);
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transición suave */
    }

    .btn {
        border-radius: 0.25rem;
        transition: background-color 0.3s ease, transform 0.2s; /* Efecto de transformación */
    }

    .btn:hover {
        background-color: #5a3798;
        transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
    }

    /* Alertas personalizadas */
    .alert {
        border-radius: 0.25rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-dismissible .close {
        position: relative;
        top: -0.5rem;
        right: -0.5rem;
        background-color: transparent;
        border: none;
    }

    /* Estilos para los resultados de búsqueda */
    .list-group {
        max-height: 150px; /* Ajustar altura para que se vea más compacto */
        overflow-y: auto;
        z-index: 1000;
        border-radius: 0.25rem; /* Bordes redondeados */
    }

    .list-group-item {
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #6f42c1;
        color: #fff;
    }

    /* Estilo para las opciones seleccionadas en el select2 */
    .select2-container--bootstrap4 .select2-selection--multiple {
        border: 1px solid #6f42c1;
        border-radius: 0.25rem;
        font-size: 14px; /* Tamaño de fuente para el select2 */
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
        background-color: #6f42c1; /* Color del fondo de las opciones seleccionadas */
        color: #fff; /* Color del texto de las opciones seleccionadas */
        border-radius: 0.25rem; /* Bordes redondeados para las opciones seleccionadas */
        margin-right: 5px;
        padding: 0.25rem; /* Espaciado interno */
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff; /* Color del icono de eliminar */
        margin-left: 5px;
    }

    /* Mensaje "No results found" */
    #noCasoResults,
    #noActuaResults {
        font-size: 14px;
        font-weight: bold;
        display: none; /* Inicialmente oculto */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card {
            margin: 10px; /* Margen para móviles */
        }

        .form-group {
            margin-bottom: 1rem; /* Espaciado entre campos */
        }

        .btn {
            font-size: 1rem; /* Aumentar tamaño del botón en pantallas pequeñas */
        }
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
        allowClear: true,
        theme: 'bootstrap4'
    });

    // Búsqueda de Casos
    $('#casoSearch').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('caso_actuados.create') }}",
            method: "GET",
            data: { caso: query },
            success: function(data) {
                $('#casoResults').empty();
                if (data.length > 0) {
                    $.each(data, function(index, caso) {
                        $('#casoResults').append(`<li class="list-group-item caso-item" data-id="${caso.id}">${caso.exp_adm} - ${caso.identificacion_caso}</li>`);
                    });
                    $('#casoResults').show(); // Mostrar resultados
                } else {
                    $('#casoResults').hide(); // Ocultar si no hay resultados
                }
            }
        });
    });

    // Selección de Caso
    $(document).on('click', '.caso-item', function() {
        let id = $(this).data('id');
        let option = `<option value="${id}">${$(this).text()}</option>`;
        $('#casos').append(option).trigger('change'); // Actualiza select2
        $('#casoResults').empty().hide(); // Limpiar resultados y ocultar
        $('#casoSearch').val(''); // Limpiar campo de búsqueda
    });

    // Búsqueda de Actuados
    $('#actuaSearch').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('caso_actuados.create') }}",
            method: "GET",
            data: { actua: query },
            success: function(data) {
                $('#actuaResults').empty();
                if (data.length > 0) {
                    $.each(data, function(index, actua) {
                        $('#actuaResults').append(`<li class="list-group-item actua-item" data-id="${actua.id}">${actua.nombre}</li>`);
                    });
                    $('#actuaResults').show(); // Mostrar resultados
                } else {
                    $('#actuaResults').hide(); // Ocultar si no hay resultados
                }
            }
        });
    });

    // Selección de Actuado
    $(document).on('click', '.actua-item', function() {
        let id = $(this).data('id');
        let option = `<option value="${id}">${$(this).text()}</option>`;
        $('#actuas').append(option).trigger('change'); // Actualiza select2
        $('#actuaResults').empty().hide(); // Limpiar resultados y ocultar
        $('#actuaSearch').val(''); // Limpiar campo de búsqueda
    });
});
</script>
@stop