@extends('adminlte::page')

@section('title', 'Lista de sumarios')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de sumarios</strong>
            @can('personas.create')
                <a class="btn btn-success float-right" href="{{ route('sumarios.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar sumario
                </a>
            @endcan
        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('sumario') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table id="tabla-sumarios" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>WhatsApp</th>
                        <th>Ci</th>
                        <th>Institución</th>
                        @if (auth()->user()->can('sumarios.show') ||
                                auth()->user()->can('sumarios.edit') ||
                                auth()->user()->can('sumarios.destroy'))
                            <th scope="col">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán los datos de las sumarios -->
                </tbody>
            </table>
            <div class="pagination justify-content-end"></div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> {{-- esto hace que se amas para celular  --}}
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-sumarios').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('sumarios.index') }}",
                columns: [{
                        data: 'idp',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'apellidop',
                        name: 'apellidop'
                    },
                    {
                        data: 'apellidom',
                        name: 'apellidom'
                    },
                    {
                        data: 'whatsapp',
                        name: 'whatsapp'
                    },
                    {
                        data: 'ci',
                        name: 'ci'
                    },
                    {
                        data: 'institucion',
                        name: 'institucion'
                    },
                    {
                        data: 'idp',
                        name: 'acciones',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var acciones = `
                           <form action="{{ route('sumarios.destroy', ':id') }}" method="POST" class="form-eliminar">
                                 @csrf
                                @method('DELETE')

                                <a href="{{ route('sumarios.show', ':id') }}" class="btn btn-secondary btn-sm">
                                   <i class="fas fa-eye"></i>
                                </a>

                                 @can('personas.edit')
                                 <a href="{{ route('sumarios.edit', ':id') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                             </a>
                                @endcan

                                 @can('personas.destroy')
                                 <button type="submit" class="btn btn-danger btn-sm">
                                     <i class="fas fa-trash-alt"></i>
                                 </button>
                                 @endcan
                            </form>`;
                            return acciones.replace(/:id/g, data);
                        }
                    }
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar MENU registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Registros del START al END de un total de TOTAL registros",
                    "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de MAX registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
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
    <script>
        @if (session('guardar') == 'ok')
            Swal.fire('Creado!', 'El dato ha sido Creado.', 'success');
        @endif
        @if (session('eliminar') == 'ok')
            Swal.fire('Eliminado!', 'El dato ha sido eliminado.', 'success');
        @endif
        @if (session('editar') == 'ok')
            Swal.fire('Actualizado!', 'El dato ha sido actualizado.', 'success');
        @endif

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
    </script>
@stop
