@extends('adminlte::page')

@section('title', 'Lista de Casos')

@section('content_header')
<div class="card">
    <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
        <h5 class="text-center"><strong>LISTADO DE CASOS</strong></h5>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('casos.imprimirTodos') }}" class="btn btn-danger mx-2">
                <i class="fas fa-file-pdf"></i> Imprimir Todos
            </a>
            <a href="{{ route('casos.exportar') }}" class="btn btn-primary mx-2">
                <i class="fas fa-file-excel"></i> Exportar a Excel
            </a>
            <a class="btn btn-success mx-2" href="{{ route('casos.create') }}">
                <i class="fas fa-plus"></i> Agregar caso
            </a>
        </div>
    </div>
</div>
@stop

@section('content')
<h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('CASOS') }}</h1>
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabla-casos" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Exp Adm</th>
                        <th>Reg Aux</th>
                        <th>Identificación de caso</th>
                        <th>Apertura inicial</th>
                        <th>Resolución final</th>
                        @canany(['casos.show', 'casos.edit', 'casos.destroy', 'casos.pdf'])
                            <th scope="col">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán los datos de los casos -->
                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-end"></div>
    </div>
</div>
@stop

@section('css')
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@stop

@section('js')
<!-- JS -->
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
    $('#tabla-casos').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('casos.index') }}",
        columns: [
            { data: 'idc', name: 'id' },
            { data: 'exp_adm', name: 'exp_adm' },
            { data: 'registro_auxiliar', name: 'registro_auxiliar' },
            { data: 'identificacion_caso', name: 'identificacion_caso' },
            { data: 'apertura_inicial', name: 'apertura_inicial' },
            { data: 'resolucion_final', name: 'resolucion_final' },
            {
                data: 'idc',
                name: 'acciones',
                orderable: false,
                searchable: false,
                render: function(data, type, full, meta) {
                    var acciones = `
                    <form action="{{ route('casos.destroy', ':id') }}" method="POST" class="form-eliminar">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('casos.show', ':id') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('casos.edit')
                        <a href="{{ route('casos.edit', ':id') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @can('casos.destroy')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        @endcan
                        @can('casos.pdf')
                        <a href="{{ route('casos.pdf', ':id') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        @endcan
                        <a href="{{ route('casos.imprimirPorId', ':id') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-print"></i>
                        </a>
                    </form>`;
                    return acciones.replace(/:id/g, data);
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
            "sSearch": "Buscar:",
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
