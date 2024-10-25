<?php $__env->startSection('title', 'LISTADO DE SUMARIADOS'); ?>

<?php $__env->startSection('content_header'); ?>
<div class="card container-fluid"> 
    <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
        <h5 class="text-center"><strong>LISTAR SUMARIADOS</strong></h5>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-3 my-1">
                <a href="<?php echo e(route('personas.imprimirTodossumarios')); ?>" class="btn btn-danger btn-block btn-sm">
                    <i class="fas fa-file-pdf"></i> Imprimir Todos
                </a>
            </div>
            <div class="col-12 col-md-3 my-1">
                <a href="<?php echo e(route('personas.exportarsumarios')); ?>" class="btn btn-primary btn-block btn-sm">
                    <i class="fas fa-file-excel"></i> Exportar a Excel
                </a>
            </div>
            <div class="col-12 col-md-3 my-1">
                <a class="btn btn-success btn-block btn-sm" href="<?php echo e(route('personas.create')); ?>">
                    <i class="fas fa-plus"></i> Agregar sumariado
                </a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h1 style="font-family: 'Times New Roman', Times, serif;"><?php echo e(ucfirst('Sumariados')); ?></h1>
    <div class="card container-fluid">
        <div class="card-body">
            <div class="table-responsive"> <!-- Se agrega table-responsive para mayor adaptación en móviles -->
                <table id="tabla-personas" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>WhatsApp</th>
                            <th>Ci</th>
                            <th>Institución</th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['personas.show', 'personas.edit', 'personas.destroy', 'personas.pdf'])): ?>
                                <th scope="col">Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán los datos de las personas -->
                    </tbody>
                </table>
            </div>
            <div class="pagination justify-content-end"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <style>
        /* Ajustes generales */
        .btn {
            font-size: 0.95rem;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .card-body h5 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* Ajustes específicos para pantallas pequeñas */
        @media (max-width: 576px) {
            .btn {
                font-size: 0.85rem;
                /* Texto más pequeño en pantallas pequeñas */
                padding: 8px 12px;
            }

            .card-body h5 {
                font-size: 1.1rem;
                /* Reducir el tamaño del título en pantallas pequeñas */
            }
        }

        /* Efecto hover para las filas de la tabla */
        #tabla-personas tbody tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
            /* Transición suave al pasar por una fila */
        }

        /* Estilo de los botones */
        .table .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Animación suave al hacer hover sobre los botones */
        }

        .table .btn:hover {
            transform: scale(1.05);
            /* Aumenta ligeramente el tamaño del botón al hacer hover */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            /* Sombra para el efecto de flotación */
        }

        /* Efecto de transición para los botones cuando se hace clic */
        .table .btn:active {
            transform: scale(0.95);
            /* Reduce ligeramente el tamaño del botón al hacer clic */
        }

        /* Transición suave para las tablas responsivas */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Efecto suave para los botones de paginación */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            /* Botones redondeados */
        }

        /* Sombra suave para el header de la tabla */
        .table thead {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            /* Suaviza la sombra del header */
        }

        /* Efecto en la columna de acciones */
        .table tbody tr td:last-child {
            transition: opacity 0.3s ease;
            /* Efecto de transición en la columna de acciones */
        }

        /* Cambios de color en hover */
        .table tbody tr:hover td:last-child {
            opacity: 1;
            /* Muestra las acciones cuando se hace hover sobre la fila */
        }

        /* Transiciones suaves para los elementos de la tabla */
        #tabla-personas tbody td {
            transition: padding 0.3s ease, color 0.3s ease;
            /* Transición suave en la celda de datos */
        }

        #tabla-personas tbody td:hover {
            padding-left: 10px;
            /* Aumenta el espaciado cuando se pasa el mouse */
            color: #007bff;
            /* Cambia el color del texto */

        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
            // Inicializar DataTable
            $('#tabla-personas').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('personas.index')); ?>",
                lengthMenu: [
                    [6, 10, 20],
                    [6, 10, 20]
                ], // Mostrar primero 6, luego 10 y 20
                pageLength: 6, // Mostrar 6 registros por defecto
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
                            <form action="<?php echo e(route('personas.destroy', ':id')); ?>" method="POST" class="form-eliminar">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <a href="<?php echo e(route('personas.show', ':id')); ?>" class="btn btn-secondary btn-sm">
                                   <i class="fas fa-eye"></i>
                                </a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('personas.edit')): ?>
                                <a href="<?php echo e(route('personas.edit', ':id')); ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('personas.destroy')): ?>
                                <button type="button" class="btn btn-danger btn-sm btn-eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('personas.pdf')): ?>
                                <a href="<?php echo e(route('personas.pdf', ':id')); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('personas.imprimirPorIds', ':id')); ?>" class="btn btn-warning btn-sm">
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
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                }
            });

            // Confirmación y animación suave al eliminar
            $(document).on('click', '.btn-eliminar', function(e) {
                e.preventDefault();

                var form = $(this).closest('form'); // Selecciona el formulario correspondiente
                var row = $(this).closest('tr'); // Selecciona la fila correspondiente

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envía el formulario para eliminar
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Elimina la fila de la tabla con animación
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                });

                                // Mensaje de éxito
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                // Manejo de error
                                Swal.fire(
                                    'Error',
                                    'Hubo un problema al eliminar el registro.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/personas/index.blade.php ENDPATH**/ ?>