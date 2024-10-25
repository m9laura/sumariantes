@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los Sumarios Tipos Sumarios</strong>
            @can('tipo_personas.create')
                <a class="btn btn-success float-right" href="{{ route('persona_tipo_personas.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar Nueva Relación
                </a>
            @endcan
        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('Tipos de Sumarios') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table id="tabla-personas" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Ci</th>
                        <th>Tipo de Persona Actual</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relaciones as $relacion)
                        <tr>
                            <td>{{ $relacion->id }}</td>
                            <td>{{ $relacion->persona->nombre }}</td>
                            <td>{{ $relacion->persona->apellidop }}</td>
                            <td>{{ $relacion->persona->apellidom }}</td>
                            <td>{{ $relacion->persona->ci }}</td>
                            <td>{{ $relacion->tipoPersona->nombre }}</td>
                            <td>
                                <a href="/persona_tipo_personas/{id}" class="btn btn-secondary btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- <a href="{{ route('persona_tipo_personas.edit', $relacion->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('persona_tipo_personas.pdf', $relacion->id) }}" class="btn btn-info btn-sm" title="PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a> --}}
                            </td>
                        </tr>
                    @endforeach
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
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-personas').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('persona_tipo_personas.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'persona.nombre',
                        name: 'personas.nombre'
                    },
                    {
                        data: 'persona.apellidop',
                        name: 'personas.apellidop'
                    },
                    {
                        data: 'persona.apellidom',
                        name: 'personas.apellidom'
                    },
                    {
                        data: 'persona.ci',
                        name: 'personas.ci'
                    },
                    {
                        data: 'tipo_persona_actual',
                        name: 'tipo_personas.nombre'
                    },
                    {
                        data: null,
                        name: 'acciones',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                             <a href="/persona_tipo_personas/${row.id}" class="btn btn-secondary btn-sm" title="Ver">
                             <i class="fas fa-eye"></i>
                             </a>
                            <a href="{{ route('persona_tipo_personas.edit', 'row.id') }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>`;
                        }
                    }
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
                },
            });
        });

        @if (session('guardar') == 'ok')
            Swal.fire('Creado!', 'El dato ha sido Creado.', 'success');
        @endif
        @if (session('eliminar') == 'ok')
            Swal.fire('Eliminado!', 'El dato ha sido eliminado.', 'success');
        @endif
        @if (session('editar') == 'ok')
            Swal.fire('Actualizado!', 'El dato ha sido actualizado.', 'success');
        @endif
    </script>
@stop
