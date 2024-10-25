@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="container-fluid">
        <h1>Detalles del Caso</h1>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="col-md-6">
                    <h2>{{ $caso->identificacion_caso }}</h2>
                </div>
                <div class="col-md-6 text-right d-flex justify-content-end align-items-center flex-wrap">
                    <h5 class="mb-0 mr-2">Tipo de Caso:</h5>
                    <p class="mb-0">{{ $caso->tipoCaso ? $caso->tipoCaso->nombre : 'No especificado' }}</p>
                </div>
            </div>
            <div class="card-header p-2">
                <ul class="nav nav-pills flex-wrap">
                    <li class="nav-item"><a class="nav-link active" href="#caso" data-toggle="tab">DETALLE DEL CASO</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#personas" data-toggle="tab">SUMARIOS PARTE DEL CASO</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#actuados" data-toggle="tab">ACTUADOS PARTE DEL CASO</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    {{-- INFORMACION DEL CASO --}}
                    <div class="tab-pane active" id="caso">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Expediente Administrativo:</th>
                                                <td>{{ $caso->exp_adm }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registro Auxiliar:</th>
                                                <td>{{ $caso->registro_auxiliar }}</td>
                                            </tr>
                                            <tr>
                                                <th>MAE:</th>
                                                <td>
                                                    @if ($caso->mae)
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#maeModal">
                                                            <i class="fas fa-file-pdf"></i> Ver MAE
                                                        </button>
                                                    @else
                                                        No hay MAE disponible.
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Modal MAE -->
                                            <div class="modal fade" id="maeModal" tabindex="-1" role="dialog"
                                                aria-labelledby="maeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="maeModalLabel">MAE del Caso</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="{{ Storage::url($caso->mae) }}"
                                                                style="width: 100%; height: 500px;"
                                                                frameborder="0"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <th>Apertura Inicial:</th>
                                                <td>{{ $caso->apertura_inicial }}</td>
                                            </tr>
                                            <tr>
                                                <th>Resolución Final:</th>
                                                <td>{{ $caso->resolucion_final }}</td>
                                            </tr>
                                            <tr>
                                                <th>Hoja de Ruta:</th>
                                                <td>
                                                    @if ($caso->hoja_ruta)
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#hojaRutaModal">
                                                            Ver Hoja de Ruta
                                                        </button>
                                                    @else
                                                        No hay hoja de ruta disponible.
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Modal Hoja de Ruta -->
                                            <div class="modal fade" id="hojaRutaModal" tabindex="-1" role="dialog"
                                                aria-labelledby="hojaRutaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hojaRutaModalLabel">Hoja de Ruta del
                                                                Caso</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="{{ Storage::url($caso->hoja_ruta) }}"
                                                                style="width: 100%; height: 500px;"
                                                                frameborder="0"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <th>Recurso Revocatoria:</th>
                                                <td>{{ $caso->recurso_revocatoria }}</td>
                                            </tr>
                                            <tr>
                                                <th>Recurso Jerárquico:</th>
                                                <td>{{ $caso->recurso_jerarquico }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ejecutoria:</th>
                                                <td>{{ $caso->ejecutoria }}</td>
                                            </tr>
                                            <tr>
                                                <th>Antecedentes:</th>
                                                <td>{{ $caso->antecedentes }}</td>
                                            </tr>
                                            <tr>
                                                <th>Estado del Proceso:</th>
                                                <td>{{ $caso->estado_proceso }}</td>
                                            </tr>
                                            <tr>
                                                <th>Creado en:</th>
                                                <td>{{ $caso->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Actualizado en:</th>
                                                <td>{{ $caso->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PERSONAS ASOCIADAS AL CASO --}}
                    <div class="tab-pane" id="personas">
                        <div class="personas personas-inverse">
                            <div class="card-body pb-0">
                                <div class="row">
                                    @if ($caso->personas->isNotEmpty())
                                        @foreach ($caso->personas as $persona)
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        <strong>Persona Asociada: {{ $persona->nombre }}
                                                            {{ $persona->apellidop }} {{ $persona->apellidom }}</strong>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{ $persona->nombre }}
                                                                        {{ $persona->apellidop }}
                                                                        {{ $persona->apellidom }}</b></h2>
                                                                <p class="text-muted text-sm"><b>Cargo: </b>
                                                                    {{ $persona->cargo ?? 'N/A' }}</p>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-id-card"></i></span>
                                                                        <b>C.I.:</b> {{ $persona->ci }}
                                                                        {{ $persona->expedido }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-venus-mars"></i></span>
                                                                        <b>Género:</b>
                                                                        {{ $persona->genero ? 'Masculino' : 'Femenino' }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-calendar"></i></span>
                                                                        <b>Fecha de Nacimiento:</b>
                                                                        {{ $persona->fnacimiento }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-flag"></i></span>
                                                                        <b>Nacionalidad:</b> {{ $persona->nacionalidad }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-building"></i></span>
                                                                        <b>Institución:</b>
                                                                        {{ $persona->institucion ?? 'N/A' }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-phone"></i></span>
                                                                        <b>WhatsApp:</b> {{ $persona->whatsapp }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-envelope"></i></span>
                                                                        <b>Email:</b> {{ $persona->gmail }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-home"></i></span>
                                                                        <b>Domicilio Real:</b>
                                                                        {{ $persona->domicilioreal ?? 'N/A' }}
                                                                    </li>
                                                                    <li class="small"><span class="fa-li"><i
                                                                                class="fas fa-lg fa-clock"></i></span>
                                                                        <b>Fecha de Asociación:</b>
                                                                        {{ $persona->pivot->fecha }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{ asset('storage/' . $persona->foto) }}"
                                                                    alt="Foto de {{ $persona->nombre }}"
                                                                    class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a href="#" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-user"></i> Ver Perfil
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <li>No hay personas asociadas.</li>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ACTUADOS ASOCIADOS AL CASO --}}
                    <div class="tab-pane" id="actuados">
                        <h3>Actuados Asociados</h3>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Actuados</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="actuadosTable" class="table table-striped projects">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">#</th>
                                                <th style="width: 20%">Nombre del Actuado</th>
                                                <th style="width: 30%">Descripción</th>
                                                <th>Fecha Creación del Actuado</th>
                                                <th>Fecha Asignación al Caso</th>
                                                <th style="width: 8%" class="text-center">Estado</th>
                                                <th style="width: 20%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($caso->actuas->isNotEmpty())
                                                @foreach ($caso->actuas as $actua)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a>{{ $actua->nombre }}</a>
                                                            <br>
                                                            <small>{{ $actua->descripcion ?? 'N/A' }}</small>
                                                        </td>
                                                        <td>{{ $actua->descripcion ?? 'N/A' }}</td>
                                                        <td>{{ $actua->fecha }}</td>
                                                        <td>{{ $actua->pivot->fecha ?? 'N/A' }}</td>
                                                        <td class="project-state">
                                                            <span
                                                                class="badge {{ $actua->estado ? 'badge-success' : 'badge-danger' }}">
                                                                {{ $actua->estado ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">No hay actuados asociados.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
    <!-- Enlazar CSS de AdminLTE -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inicializa DataTable para la tabla de actuados
            $('#actuadosTable').DataTable({
                responsive: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "No hay registros disponibles",
                    "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
            });
        });
    </script>
@stop
