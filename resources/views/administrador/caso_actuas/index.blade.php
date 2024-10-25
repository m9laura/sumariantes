@extends('adminlte::page')

@section('title', 'Actuados')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los actuados</strong>
            {{-- @can('tactuado.create') --}}
            <a class="btn btn-success float-right" href="{{ route('actuas.create') }}">
                <i class="fas fa-plus"></i>
                Agregar actuados
            </a>
            {{-- @endcan --}}

        </div>
    </div>
@stop

@section('content')
<h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('actuados') }}</h1>
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="actua">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Actuado</th>
                    <th scope="col">Estado Actuado</th>
                    <th scope="col">Fecha Actuado</th>
                    <th scope="col">Nombre Caso</th>
                    {{-- <th scope="col">Estado Caso</th>
                    <th scope="col">Fecha Caso</th> --}}
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actuas as $actua)
                    <tr>
                        {{-- Información del Actuado --}}
                        <th scope="row">{{ $actua->id }}</th>
                        <td>{{ ucfirst($actua->nombre) }}</td>
                        @if ($actua->estado == 1)
                            <td>Activo</td>
                        @else
                            <td>Inhabilitado</td>
                        @endif
                        <td>{{ ucfirst($actua->fecha) }}</td>

                        {{-- Información del Caso relacionado (puede haber más de un caso) --}}
                        @foreach ($actua->casos as $caso)
                            <tr>
                                <td></td> <!-- celda vacía para mantener la estructura -->
                                <td></td> <!-- celda vacía para mantener la estructura -->
                                <td></td> <!-- celda vacía para mantener la estructura -->
                                <td></td> <!-- celda vacía para mantener la estructura -->
                                <td>{{ ucfirst($caso->exp_adm) }}</td>
                                <td>{{ ucfirst($caso->estado_proceso ?? 'Desconocido') }}</td>
                                <td>{{ ucfirst($caso->pivot->fecha) }}</td>

                                {{-- Acción --}}
                                <td>
                                    <form action="{{ route('actuas.destroy', $actua) }}" method="POST" class="form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-primary btn-sm" href="{{ route('actuas.edit', $actua) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">

    {{-- DATATABLEy sus ralaciones 2
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css"> --}}
    {{-- marca en rolo lo inavilitado --}}
    <style>
        #tipo_persona tbody tr[data-estado="0"] {
            background-color: rgba(255, 0, 0, 0.3);
        }
    </style>
    <style>
        .custom-modal-content {
            margin-left: 20px;
            background-color: rgba(0, 255, 0, 0.3);
            /* Color verde con opacidad del 30% */
            padding: 10px;
            /* Ajusta el relleno según sea necesario */
        }
    </style>


@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- linea de importaciode para usar sweet alert --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js "></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    {{-- mensaje de advertencia para guardar --}}
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Creado!',
                'El dato ha sido Creado.',
                'success'
            )
        </script>
    @endif
    {{-- mensaje de advertencia para eliminar --}}
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El dato ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    {{-- mensaje de advertencia para editar --}}
    @if (session('editar') == 'ok')
        <script>
            Swal.fire(
                'Actualizado!',
                'El dato ha sido actulizado.',
                'success'
            )
        </script>
    @endif
<script>
    $(document).ready(function() {
        $('#actua').DataTable({
            "paging": true,      // Habilitar paginación
            "searching": true,   // Habilitar búsqueda
            "ordering": true,    // Habilitar ordenamiento
            "info": true,        // Mostrar información sobre las filas
            "autoWidth": false,  // Ajuste automático del ancho de las columnas
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            }
        });
    });
</script>
    <script>
        //llega lo del formulacio de ariba
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Esta seguro?',
                text: "¡El dato se eliminará!",
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>
    <script>
    $(document).ready(function() {
        $('#actua').DataTable({
            "paging": true,      // Habilitar paginación
            "searching": true,   // Habilitar búsqueda
            "ordering": true,    // Habilitar ordenamiento
            "info": true,        // Mostrar información sobre las filas
            "autoWidth": false,  // Ajuste automático del ancho de las columnas
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            }
        });
    });

    </script>

@stop
