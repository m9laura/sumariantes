@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                {{-- <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Datos de sancion: {{ $sancion->nombre }}&nbsp;{{ $persona->apellidop }} </h1> --}}
            </strong>
        </div>
    </div>
@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-12 mb-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{ $Sancionpersonas->persona && $Sancionpersonas->persona->foto ? Storage::url($Sancionpersonas->persona->foto) : asset('default-image.jpg') }}"
                                alt="Foto de la persona" class="custom-img mx-auto">
                        </div>
                        <p><strong>Nombre Persona:</strong>
                            {{ $Sancionpersonas->persona ? $Sancionpersonas->persona->nombre : 'No disponible' }}</p>
                        <p><strong>Apellido:</strong>
                            {{ $Sancionpersonas->persona ? $Sancionpersonas->persona->apellidop : '' }}
                            {{ $Sancionpersonas->persona ? $Sancionpersonas->persona->apellidom : '' }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <p><strong>CI Persona:</strong> {{ $Sancionpersonas->persona ? $Sancionpersonas->persona->ci : 'No disponible' }}</p>
                            </li>
                            <li class="list-group-item">
                                <p><strong>Género:</strong> {{ $Sancionpersonas->persona->genero ? 'Masculino' : 'Femenino' }}</p>
                            </li>
                            <li class="list-group-item">
                                <p><strong>Nacionalidad:</strong> {{ $Sancionpersonas->persona->nacionalidad }}</p>
                            </li>
                        </ul>
                        <p><strong>Fecha de Nacimiento:</strong> {{ $Sancionpersonas->persona->fnacimiento }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <div class="card">
                    <div class="card-header p-2 d-flex justify-content-between align-items-center">
                        <ul class="nav nav-pills flex-grow-1 justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active btn btn-warning" href="{{ route('sancion_personas.edit', $Sancionpersonas) }}">
                                    Editar
                                </a>
                            </li>
                        </ul>
                        <span class="mx-3 font-weight-bold" style="font-size: 1.5rem;">SANCIONES ASIGNADAS A SUMARIANTE</span>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <table id="sancion_table" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nombre Sanción</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Fecha de Sanción Asignado</th>
                                        <th>Fecha de Registro Sancion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Sancionpersonas->persona->sancionpersonas as $sancionPersona)
                                        <tr>
                                            <td>{{ $sancionPersona->nombre }}</td>
                                            <td>{{ $sancionPersona->descripcion }}</td>
                                            <td>{{ $sancionPersona->estado ? 'Activo' : 'Inactivo' }}</td>
                                            <td>{{ $sancionPersona->pivot->fecha }}</td>
                                            <td>{{ $sancionPersona->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        margin: 0 auto;
    }

    /* Espaciado entre columnas */
    .row > div {
        margin-bottom: 15px; /* Espacio en la parte inferior de las columnas */
    }

    /* Evitar que las columnas caigan en pantallas pequeñas */
    @media (max-width: 767px) {
        .col-md-3, .col-md-9 {
            margin-bottom: 0; /* Quitar margen inferior en dispositivos pequeños */
        }

        .card {
            margin-bottom: 15px; /* Espacio entre tarjetas */
        }
    }

    .dataTables_info {
        margin-bottom: 0; /* Elimina margen inferior de la información de la tabla */
    }

    .pagination {
        margin-bottom: 0; /* Elimina margen inferior de la paginación */
    }

    .row {
        margin: 0; /* Asegúrate de que no haya margen no deseado */
    }
</style>
@section('js')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sancion_table').DataTable({
            "pageLength": 3,  // Mostrar 3 registros por página
            "lengthMenu": [[3], [3]], // Especifica que solo se mostrará 3 registros, sin menú de longitud
            "language": {
                "sProcessing": "Procesando...",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            },
        });
    });
</script>
@stop
