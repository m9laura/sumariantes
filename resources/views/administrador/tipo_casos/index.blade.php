@extends('adminlte::page')

@section('title', 'Tipo de mensajes')

@section('content_header')
<div class="card">
    <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
        <strong>Lista de los tipos de casos</strong>
        <a class="btn btn-success float-right" href="{{ route('tipo_casos.create') }}">
            <i class="fas fa-plus"></i>
            Agregar tipo de casos
        </a>
    </div>
</div>
@stop
@section('content')
<h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('tipos de casos') }}</h1>
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <div class="table-responsive"> {{-- Clase para hacer la tabla responsive --}}
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="tipo_caso">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Gravedad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipo_casos as $tipo_caso)
                        <tr>
                            <th scope="row">{{ $tipo_caso->id }}</th>
                            <td>{{ ucfirst($tipo_caso->nombre) }}</td>
                            <td>{{ ucfirst(strip_tags($tipo_caso->descripcion)) }}</td>
                            <td>{{ $tipo_caso->estado == 1 ? 'Activo' : 'Inhabilitado' }}</td>
                            <td>
                                @switch($tipo_caso->gravedad)
                                    @case(1)
                                        Económico
                                    @break
                                    @case(2)
                                        Días de impedimento
                                    @break
                                    @default
                                        Destitución
                                @endswitch
                            </td>
                            <td>{{ ucfirst($tipo_caso->fecha) }}</td>
                            <td>
                                <form action="{{ route('tipo_casos.destroy', $tipo_caso) }}" method="POST" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-sm" href="{{ route('tipo_casos.edit', $tipo_caso) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('tipo_casos.show', $tipo_caso) }}">
                                        <i class="fas fa-edit"></i> vista 
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> {{-- Fin de table-responsive --}}
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
<style>
    /* Aquí puedes agregar estilos personalizados */
    #tipo_caso tbody tr[data-estado="0"] {
        background-color: rgba(255, 0, 0, 0.3);
    }
    .custom-modal-content {
        margin-left: 20px;
        background-color: rgba(0, 255, 0, 0.3);
        padding: 10px;
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

{{-- Mensajes de advertencia --}}
@if (session('guardar') == 'ok')
    <script>
        Swal.fire('Creado!', 'El dato ha sido Creado.', 'success');
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

    $('#tipo_caso').DataTable({
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