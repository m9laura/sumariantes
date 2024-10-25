@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 mb-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <img src="{{ $relacion->persona && $relacion->persona->foto ? Storage::url($relacion->persona->foto) : asset('default-image.jpg') }}"
                                alt="Foto de la persona" class="custom-img mx-auto">
                            <h3 class="profile-username text-bold mt-2">
                                {{ $relacion->persona ? $relacion->persona->nombre : 'No disponible' }}</h3>
                            <p class="profile-info"><strong>CI:</strong>
                                {{ $relacion->persona ? $relacion->persona->ci : 'No disponible' }}</p>
                            <p class="profile-info"><strong>Fecha de Nacimiento:</strong>
                                {{ $relacion->persona ? $relacion->persona->fnacimiento : 'No disponible' }}</p>
                            <p class="profile-info"><strong>Género:</strong>
                                {{ $relacion->persona && $relacion->persona->genero ? 'Masculino' : 'Femenino' }}</p>
                            <p class="profile-info"><strong>Nacionalidad:</strong>
                                {{ $relacion->persona ? $relacion->persona->nacionalidad : 'No disponible' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-start align-items-center">
                            <h3 class="card-title text-bold" style="font-size: 1.2rem; margin-right: auto;">
                                Tipos de Sumario Asignados
                            </h3>
                            <a class="btn btn-warning btn-sm"
                                href="{{ route('persona_tipo_personas.edit', $relacion->id) }}"
                                style="transition: background-color 0.3s, transform 0.3s; border-radius: 5px;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tabla-personas">
                                    <thead>
                                        <tr>
                                            <th>Nombre Tipo de Sumario</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Fecha Asignación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($tipoPersonas->isNotEmpty())
                                            @foreach ($tipoPersonas as $tipoPersona)
                                                <tr>
                                                    <td>{{ $tipoPersona->nombre }}</td>
                                                    <td>{{ $tipoPersona->descripcion }}</td>
                                                    <td>
                                                        @if ($tipoPersona->estado)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $relacion->fecha }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No hay tipos de Sumario asignados.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Acordeón para más detalles -->
                            <div id="accordion" class="mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapseDetails" aria-expanded="true"
                                                aria-controls="collapseDetails">
                                                Más Detalles
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseDetails" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Aquí puedes añadir más detalles relevantes sobre los tipos de Sumario o
                                            cualquier otra información que desees mostrar.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .custom-img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .custom-img:hover {
            transform: scale(1.05);
        }

        .profile-username {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile-info {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .card-header {
            padding: 10px 15px;
            /* Ajustar el padding */
            background-color: #f8f9fa;
            /* Fondo claro */
            border-bottom: 2px solid #dee2e6;
            /* Línea inferior */
        }

        .card-title {
            margin-bottom: 0;
            /* Quitar margen inferior */
        }
    </style>
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-personas').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('persona_tipo_personas.index') }}",
                columns: [{
                        data: 'tipoPersona.nombre',
                        name: 'tipoPersona.nombre'
                    },
                    {
                        data: 'tipoPersona.descripcion',
                        name: 'tipoPersona.descripcion'
                    },
                    {
                        data: 'tipoPersona.estado',
                        name: 'tipoPersona.estado',
                        render: function(data, type, row) {
                            return data ? '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                        }
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
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
                }
            });

            $('.form-eliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Está seguro?',
                    text: '¡El dato se eliminará!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            @if (session('guardar') == 'ok')
                Swal.fire('Creado!', 'El dato ha sido creado.', 'success');
            @endif
            @if (session('eliminar') == 'ok')
                Swal.fire('Eliminado!', 'El dato ha sido eliminado.', 'success');
            @endif
            @if (session('editar') == 'ok')
                Swal.fire('Actualizado!', 'El dato ha sido actualizado.', 'success');
            @endif
        });
    </script>
@stop
