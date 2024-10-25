@extends('adminlte::page')

@section('title', 'Sanciones')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de Sanciones</strong>
            <a class="btn btn-success float-right" href="{{ route('sancions.create') }}">
                <i class="fas fa-plus"></i>
                Agregar Sanción
            </a>
        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('Listado de Sanciones') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="sanciones_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 20%;">Nombre</th>
                            <th scope="col" style="width: 30%;">Descripción</th>
                            <th scope="col" style="width: 10%;">Estado</th>
                            <th scope="col" style="width: 15%;">Fecha de Registro</th>
                            <th scope="col" style="width: 20%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los datos se llenarán a través de DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <style>
        /* Efecto de hover en la tabla */
        #sanciones_table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        /* Estilos para truncar texto en las celdas */
        .truncate {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px;
            /* Ajusta el ancho máximo según sea necesario */
        }

        .more {
            display: none;
        }

        /* Tamaño de botones */
        .btn-action {
            width: 35%;
            /* Los botones ocuparán el 35% de la columna */
        }

        /* Ajuste del ancho máximo de las celdas */
        .table td,
        .table th {
            max-width: 90px;
            /* Ancho máximo de las celdas */
            word-wrap: break-word;
            /* Permite que las palabras largas se ajusten a la siguiente línea */
        }

        /* Limita la altura máxima de las celdas para evitar que se estiren */
        .table td {
            max-height: 40px;
            /* Altura máxima de las celdas */
            overflow: hidden;
            /* Oculta el contenido que sobrepasa la altura */
            text-overflow: ellipsis;
            /* Agrega puntos suspensivos si el texto es muy largo */
            vertical-align: middle;
            /* Alinea verticalmente el contenido */
        }

        /* Alinea dos botones por fila */
        .d-flex {
            flex-wrap: wrap;
        }

        .btn-action {
            width: 35%;
            /* Cada botón ocupará el 35% del ancho para alinearse 2 por fila */
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const table = $('#sanciones_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sancions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data) {
                            return `
                                <span class="truncate">${data}</span>
                                <span class="more">${data}</span>
                                <a href="#" class="btn btn-link btn-sm toggle-more">Ver más</a>
                            `;
                        }
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        render: function(data) {
                            return data ? '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                        }
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex flex-wrap justify-content-between">
                                    <a href="/sancions/${row.id}" class="btn btn-secondary btn-action mb-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/sancions/${row.id}/edit" class="btn btn-warning btn-action mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/sancions/${row.id}" method="POST" class="d-inline form-eliminar mb-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            `;
                        }
                    }
                ],
                language: {
                    processing: "Procesando...",
                    lengthMenu: "Mostrar {_MENU_} registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando registros del {_START_} al {_END_} de un total de {_TOTAL_} registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de {_MAX_} registros)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }
            });

            // Mostrar u ocultar el texto completo al hacer clic en "Ver más"
            $(document).on('click', '.toggle-more', function(e) {
                e.preventDefault();
                const $this = $(this);
                $this.prev('.more').toggle();
                $this.prev('.truncate').toggle();
                $this.text($this.text() === 'Ver más' ? 'Ver menos' : 'Ver más');
            });

            // Mensaje de éxito si existe
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK'
                });
            @endif

            $(document).on('submit', '.form-eliminar', function(e) {
                e.preventDefault(); // Previene el envío normal del formulario
                const form = this;

                Swal.fire({
                    title: '¿Está seguro?',
                    text: "¡El dato se eliminará de manera lógica!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.action, // La URL del formulario
                            type: 'POST', // Utiliza POST para el método DELETE
                            data: $(form).serialize(), // Serializa los datos del formulario
                            success: function(response) {
                                if (response.warning) {
                                    Swal.fire('Advertencia!', response.warning,
                                        'warning');
                                } else {
                                    Swal.fire('¡Eliminado!', response.success,
                                        'success');
                                    table.ajax.reload(); // Recarga la tabla
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.error ||
                                    'Ocurrió un error al eliminar.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
