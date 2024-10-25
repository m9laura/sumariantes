@extends('adminlte::page')

@section('title', 'Actuados')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>LISTADO DE CASOS CON ACTUADOS</strong>
            {{-- @can('tactuado.create') --}}
            <a class="btn btn-success float-right" href="{{ route('caso_actuados.create') }}">
                <i class="fas fa-plus"></i>
                Agregar Caso Actuados
            </a>
            {{-- @endcan --}}
        </div>
    </div>
@stop

@section('content')
    <h1 class="mb-4" style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('Listado de Casos Actuados') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <div class="table-responsive"> <!-- Agregar div para hacer la tabla responsive -->
                <table class="table table-bordered" id="caso_actuados_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre del Caso</th>
                            <th scope="col">Expediente Administrativo</th>
                            <th scope="col">Nombre del Actuado</th>
                            <th scope="col">Estado del Actuado</th>
                            <th scope="col">Fecha del Actuado</th>
                            <th scope="col">Fecha del Caso Actuado (Fecha Registrado)</th>
                            @if (auth()->user()->can('actuas.show') || auth()->user()->can('actuas.edit') || auth()->user()->can('actuas.destroy'))
                                <th scope="col">Acción</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($caso_actuados as $caso_actuado)
                            <tr>
                                <td>{{ $caso_actuado->caso->identificacion_caso }}</td>
                                <td>{{ $caso_actuado->caso->exp_adm }}</td>
                                <td>{{ $caso_actuado->actua->nombre }}</td>
                                <td class="{{ !$caso_actuado->actua->estado ? 'bg-danger text-white' : '' }}">
                                    {{ $caso_actuado->actua->estado ? 'Activo' : 'Inactivo' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($caso_actuado->actua->fecha)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($caso_actuado->fecha)->format('d-m-Y') }}</td>
                                <!-- Fecha de la tabla pivote -->
                                <td>
                                    <!-- Botón de Mostrar con ícono AdminLTE -->
                                    <a class="btn btn-info btn-sm" href="{{ route('caso_actuados.show', $caso_actuado) }}">
                                        <i class="nav-icon fas fa-eye"></i>
                                    </a>
                                    <!-- Botón de Editar con ícono AdminLTE -->
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('caso_actuados.edit', $caso_actuado) }}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    <!-- Botón de Eliminar con ícono AdminLTE -->
                                    <form action="{{ route('caso_actuados.destroy', $caso_actuado) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="nav-icon fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Mostrar cuántos registros se muestran por página -->
                <div class="mt-2">
                    Mostrar <strong>10</strong> registros por página
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Estilos de DataTables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<!-- Incluye SweetAlert2 desde CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Marca en rojo lo inhabilitado */
        .bg-danger {
            background-color: rgba(255, 0, 0, 0.3) !important;
        }

        /* Estilo de la card */
        .custom-modal-content {
            margin-left: 20px;
            background-color: rgba(0, 255, 0, 0.3);
            padding: 10px;
        }
            /* Efecto de sombra al pasar el mouse por encima de las filas */
            .table tbody tr:hover {
                background-color: #f5f5f5;
                /* Color de fondo al hacer hover */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                /* Sombra sutil */
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
                /* Transición suave */
            }

            /* Efecto de escala en los botones al pasar el mouse */
            .btn {
                transition: transform 0.3s ease;
                /* Transición suave para el botón */
            }

            .btn:hover {
                transform: scale(1.05);
                /* Escala del botón al hacer hover */
            }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire('Creado!', 'El dato ha sido creado.', 'success');
        </script>
    @endif
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire('Eliminado!', 'El dato ha sido eliminado.', 'success');
        </script>
    @endif
    @if (session('editar') == 'ok')
        <script>
            Swal.fire('Actualizado!', 'El dato ha sido actualizado.', 'success');
        </script>
    @endif
    {{-- DataTables --}}
    <script>
        $(document).ready(function() {
            // Inicializa DataTable
            $('#caso_actuados_table').DataTable({
                responsive: true,
                autoWidth: false,
                lengthMenu: [5, 25, 50, 75, 100],
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "Lo sentimos, pero no hay datos para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "Lo sentimos, pero no hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar:",
                    paginate: {
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }
            });
    
            // Maneja la confirmación de eliminación
            $('form').on('submit', function(e) {
                e.preventDefault(); // Previene el envío del formulario
                const form = this; // Guarda el formulario
    
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás recuperar este registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Envía el formulario si se confirma
                    }
                });
            });
        });
    </script>
@stop
