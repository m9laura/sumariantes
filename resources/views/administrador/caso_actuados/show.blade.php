@extends('adminlte::page')

@section('title', 'Actuados')
@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Detalles del Actuado</strong>
            {{-- @can('tactuado.create') --}}
            {{-- <a class="btn btn-success float-right" href="{{ route('actuas.create') }}"> --}}
            {{-- <i class="fas fa-plus"></i>
        Agregar actuados
        </a> --}}
            {{-- @endcan --}}
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <!-- Información del Actuado -->
                <div class="col-md-3 col-12 mb-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- Puedes agregar una imagen aquí si es necesario -->
                            </div>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <p><strong>Nombre Actuado:</strong>
                                        {{ $caso_actuado->actua->nombre ?? 'No disponible' }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Descripción del Actuado:</strong>
                                        {{ $caso_actuado->actua->descripcion ?? 'No disponible' }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Estado del Actuado:</strong>
                                        {{ $caso_actuado->actua->estado ? 'Activo' : 'Inactivo' }}</p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Fecha del Actuado:</strong>
                                        {{ \Carbon\Carbon::parse($caso_actuado->actua->fecha)->format('d-m-Y') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Información del Caso -->
                <div class="col-md-9 col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header p-2 d-flex justify-content-between align-items-center">
                            <ul class="nav nav-pills flex-grow-1 justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active btn btn-warning"
                                        href="{{ route('caso_actuados.edit', $caso_actuado) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </li>
                            </ul>
                            <span class="mx-3 font-weight-bold" style="font-size: 1.5rem;">DETALLES DEL CASO</span>
                        </div>
                        <div class="tab-content">
                            <table id="caso_table" class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr class="text-center">
                                        <th>Identificación del Caso</th>
                                        <th>Expediente Administrativo</th>
                                        <th>Estado del Proceso</th>
                                        <th>Fecha de Registro</th>
                                        <th>Acciones</th> <!-- Nueva columna para el botón -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Iteramos sobre los casos relacionados con el actuado -->
                                    @foreach ($caso_actuado->actua->casos as $caso)
                                        <tr>
                                            <td>{{ $caso->identificacion_caso ?? 'Sin identificación' }}</td>
                                            <td>{{ $caso->exp_adm ?? 'Sin expediente' }}</td>
                                            <td>{{ $caso->estado_proceso ?? 'Sin estado' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($caso->pivot->fecha)->format('d-m-Y') ?? 'Sin fecha' }}
                                            </td>
                                            <td>
                                                <div class="timeline-footer">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#modalDetalles{{ $caso->id }}">Ver
                                                        Detalles</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal para mostrar detalles del caso -->
                                        <div class="modal fade" id="modalDetalles{{ $caso->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalDetallesLabel{{ $caso->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalDetallesLabel{{ $caso->id }}">
                                                            Detalles del Caso: {{ $caso->identificacion_caso }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Expediente Administrativo:</strong> {{ $caso->exp_adm }}
                                                        </p>
                                                        <p><strong>Registro Auxiliar:</strong>
                                                            {{ $caso->registro_auxiliar ?? 'No disponible' }}</p>
                                                        <p><strong>Tipo de Caso:</strong>
                                                            {{ $caso->tipoCaso->nombre ?? 'No disponible' }}</p>
                                                        <p><strong>Documentación:</strong> {{ $caso->mae }}</p>
                                                        <p><strong>Apertura Inicial:</strong> {{ $caso->apertura_inicial }}
                                                        </p>
                                                        <p><strong>Resolución Final:</strong>
                                                            {{ $caso->resolucion_final ?? 'No disponible' }}</p>
                                                        <p><strong>Hoja de Ruta:</strong>
                                                            {{ $caso->hoja_ruta ?? 'No disponible' }}</p>
                                                        <p><strong>Recurso Revocatoria:</strong>
                                                            {{ $caso->recurso_revocatoria ?? 'No disponible' }}</p>
                                                        <p><strong>Recurso Jerárquico:</strong>
                                                            {{ $caso->recurso_jerarquico ?? 'No disponible' }}</p>
                                                        <p><strong>Ejecutoria:</strong>
                                                            {{ $caso->ejecutoria ?? 'No disponible' }}</p>
                                                        <p><strong>Antecedentes:</strong>
                                                            {{ $caso->antecedentes ?? 'No disponible' }}</p>
                                                        <p><strong>Estado del Proceso:</strong>
                                                            {{ $caso->estado_proceso ?? 'Sin estado' }}</p>
                                                        <p><strong>Fecha:</strong>
                                                            {{ \Carbon\Carbon::parse($caso->fecha)->format('d-m-Y') ?? 'Sin fecha' }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Estilo personalizado */
    .card-header {
        background-color: #17a2b8; /* Cambia el color de fondo del encabezado */
        color: white; /* Cambia el color del texto */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1; /* Cambia el color al pasar el ratón sobre la fila */
        transition: background-color 0.3s; /* Transición suave */
    }

    .list-group-item {
        background-color: transparent; /* Fondo transparente para una mejor integración */
        transition: background-color 0.3s; /* Transición suave */
    }

    .list-group-item:hover {
        background-color: rgba(23, 162, 184, 0.1); /* Color al pasar el ratón */
    }

    /* Centro de los cuadros en la página */
    .content {
        padding-top: 20px; /* Espacio en la parte superior */
    }
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#caso_table').DataTable({
            "pageLength": 3,
            "lengthMenu": [
                [3, 5, 10, -1],
                [3, 5, 10, "Todo"]
            ],
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