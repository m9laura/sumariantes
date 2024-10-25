@extends('adminlte::page')

@section('title', 'sancions')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de Sancionados</strong>
            <a class="btn btn-success float-right" href="{{ route('sancion_personas.create') }}">
                <i class="fas fa-plus"></i>
                Agregar Sanción a Sumarios
            </a>
            
            {{-- <a class="btn btn-success float-right" href="{{ route('SancionesPersonas.') }}">
                <i class="fas fa-plus"></i>
               Sanciónes a Sumarios
            </a> --}}
        </div>
    </div>
@stop
@section('content')
    <div class="container">
            <div class="card" style="font-family: 'Times New Roman', Times, serif;">
            <div class="card-body">
                <table class="table table-responsive" id="sancion_personas_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre Persona</th>
                            <th scope="col">CI Persona</th>
                            <th scope="col">Nombre Sanción</th>
                            <th scope="col">Estado Sanción</th>
                            <th scope="col">Fecha Sanción</th>
                            <th scope="col">Fecha Actual</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Sancionpersonas as $sancionPersona)
                            <tr>
                                <td>{{ $sancionPersona->persona ? $sancionPersona->persona->nombre : 'No disponible' }}</td>
                                <td>{{ $sancionPersona->persona ? $sancionPersona->persona->ci : 'No disponible' }}</td>
                                <td>{{ $sancionPersona->sancion ? $sancionPersona->sancion->nombre : 'No disponible' }}</td>
                                <td
                                    class="{{ $sancionPersona->sancion && $sancionPersona->sancion->estado ? 'estado-activo' : 'estado-inactivo' }}">
                                    {{ $sancionPersona->sancion ? ($sancionPersona->sancion->estado ? 'Activo' : 'Inactivo') : 'No disponible' }}
                                </td>
                                <td>{{ $sancionPersona->sancion ? \Carbon\Carbon::parse($sancionPersona->sancion->fecha)->format('d-m-Y') : 'No disponible' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($sancionPersona->fecha)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('sancion_personas.show', $sancionPersona) }}"
                                        class="btn btn-info btn-sm">Ver</a>
                                    {{-- <a href="{{ route('sancion_personas.edit', $sancionPersona) }}"
                                        class="btn btn-primary btn-sm">Editar</a> --}}
                                        <a href="{{ route('sancion_personas.edit', $sancionPersona) }}" class="btn btn-primary btn-sm">Editar</a>

                                    <form action="{{ route('sancion_personas.destroy', $sancionPersona) }}" method="POST"
                                        class="d-inline form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- DATATABLE y sus relaciones --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

    <style>
        .estado-inactivo {
            background-color: rgba(255, 0, 0, 0.3);
            /* Inactivo: fondo rojo */
        }

        .estado-activo {
            background-color: rgba(255, 255, 0, 0.3);
            /* Activo: fondo amarillo */
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Creado!',
                'El dato ha sido creado.',
                'success'
            );
        </script>
    @endif

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El dato ha sido eliminado.',
                'success'
            );
        </script>
    @endif

    @if (session('editar') == 'ok')
        <script>
            Swal.fire(
                'Actualizado!',
                'El dato ha sido actualizado.',
                'success'
            );
        </script>
    @endif

    <script>
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡El dato se eliminará!",
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

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#sancion_personas_table').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
@stop
