@extends('adminlte::page')

@section('title', 'Actuados')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los tipos de Actuados</strong>
            <a class="btn btn-success float-right" href="{{ route('actuas.create') }}">
                <i class="fas fa-plus"></i>
                Agregar Actuados
            </a>
        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('Listado de Actuados') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="actas_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 20%;">Nombre</th>
                            <th scope="col" style="width: 30%;">Descripción</th>
                            <th scope="col" style="width: 15%;">Fecha de Registro</th>
                            <th scope="col" style="width: 20%;">Documentos</th>
                            <th scope="col" style="width: 10%;">Acción</th>
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
        #actas_table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        /* Estilos para truncar texto en las celdas */
        .truncate {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px; /* Ajusta el ancho máximo según sea necesario */
        }

        .more {
            display: none;
        }

        /* Tamaño de botones */
        .btn-action {
            width: 35%; /* Botones ocuparán el 45% de la columna */
        }

        /* Ajuste del ancho máximo de las celdas */
        .table td, .table th {
            max-width: 90px; /* Ancho máximo de las celdas */
            word-wrap: break-word; /* Permite que las palabras largas se ajusten a la siguiente línea */
        }

        /* Limita la altura máxima de las celdas para evitar que se estiren */
        .table td {
            max-height: 40px; /* Altura máxima de las celdas */
            overflow: hidden; /* Oculta el contenido que sobrepasa la altura */
            text-overflow: ellipsis; /* Agrega puntos suspensivos si el texto es muy largo */
            vertical-align: middle; /* Alinea verticalmente el contenido */
        }

        /* Ajusta el tamaño de la columna "Documentos" para que sea más pequeña */
        th:nth-child(5), td:nth-child(5) {
            width: 10%; /* Reduce el ancho de la columna Documentos */
        }

        /* Alinea dos botones por fila */
        .d-flex {
            flex-wrap: wrap;
        }

        .btn-action {
            width: 35%; /* Cada botón ocupará el 48% del ancho para alinearse 2 por fila */
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
            // Inicializa la tabla DataTable
            const table = $('#actas_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('actuas.index') }}",
                
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nombre', name: 'nombre' },
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
                    { data: 'fecha', name: 'fecha' },
                    {
                        data: 'documentos',
                        render: function(data) {
                            return data && data.trim() !== '' ? 
                                '<a href="{{ url('storage') }}/' + data + '" target="_blank" class="btn btn-info btn-sm">Ver Documento</a>' : 
                                ''; // Si está vacío, no muestra nada
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex flex-wrap justify-content-between">
                                    <a href="/actuas/${row.id}/pdf" class="btn btn-primary btn-action mb-1">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="/actuas/${row.id}" class="btn btn-secondary btn-action mb-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/actuas/${row.id}/edit" class="btn btn-warning btn-action mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/actuas/${row.id}" method="POST" class="d-inline form-eliminar mb-1">
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
                ]
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
                                    Swal.fire('Advertencia!', response.warning, 'warning');
                                } else {
                                    Swal.fire('¡Eliminado!', response.success, 'success');
                                    table.ajax.reload(); // Recarga la tabla
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.error || 'Ocurrió un error al eliminar.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
