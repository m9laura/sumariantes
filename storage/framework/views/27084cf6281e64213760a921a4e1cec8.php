<?php $__env->startSection('title', 'Lista de Sumarios'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <h5 class="text-center"><strong>LISTADO DE SUMARIOS ASOCIADOS A CASOS</strong></h5>
            <div class="d-flex justify-content-center mt-3">
                <a href="<?php echo e(route('caso_personas.create')); ?>" class="btn btn-success mx-2">
                    <i class="fas fa-plus"></i> Agregar Persona a Caso
                </a>
                
                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 style="font-family: 'Times New Roman', Times, serif;"><?php echo e(ucfirst('Tipos de Sumarios')); ?></h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table id="tabla-personas" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Persona</th>
                        <th>Nombre Persona</th>
                        <th>CI Persona</th>
                        <th>Expediente Administrativo</th>
                        <th>Nombre Caso</th>
                        <th>Fecha</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['caso_personas.show', 'caso_personas.edit', 'caso_personas.destroy'])): ?>
                            <th scope="col">Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $casoPersonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $casoPersona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($casoPersona->persona->id); ?></td>
                            <td title="<?php echo e($casoPersona->persona->nombre); ?>">
                                <?php echo e(Str::limit($casoPersona->persona->nombre, 20, '...')); ?></td>
                            <td title="<?php echo e($casoPersona->persona->ci); ?>"><?php echo e($casoPersona->persona->ci); ?></td>
                            <td title="<?php echo e($casoPersona->caso->exp_adm); ?>">
                                <?php echo e(Str::limit($casoPersona->caso->exp_adm, 20, '...')); ?></td>
                            <td title="<?php echo e($casoPersona->caso->identificacion_caso); ?>">
                                <?php echo e(Str::limit($casoPersona->caso->identificacion_caso, 20, '...')); ?></td>
                            <td><?php echo e($casoPersona->fecha); ?></td>
                            <td>
                                <div class="btn-group">
                                    <form action="<?php echo e(route('caso_personas.destroy', $casoPersona->id)); ?>" method="POST"
                                        class="form-eliminar d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <a href="<?php echo e(route('caso_personas.show', $casoPersona->id)); ?>"
                                            class="btn btn-secondary btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('caso_personas.edit')): ?>
                                            <a href="<?php echo e(route('caso_personas.edit', $casoPersona->id)); ?>"
                                                class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('caso_personas.destroy')): ?>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="pagination justify-content-end"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <style>
        /* Estilos para limitar el ancho de las columnas */
        table td {
            max-width: 150px;
            /* Ajusta el ancho máximo según sea necesario */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-personas').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('caso_personas.index')); ?>",
                columns: [{
                        data: 'persona.id',
                        name: 'persona.id'
                    },
                    {
                        data: 'persona.nombre',
                        name: 'persona.nombre'
                    },
                    {
                        data: 'persona.ci',
                        name: 'persona.ci'
                    },
                    {
                        data: 'caso.exp_adm',
                        name: 'caso.exp_adm'
                    },
                    {
                        data: 'caso.identificacion_caso',
                        name: 'caso.identificacion_caso'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
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
                }
            });
        });

        <?php if(session('guardar') == 'ok'): ?>
            Swal.fire('Creado!', 'El dato ha sido creado.', 'success');
        <?php endif; ?>
        <?php if(session('eliminar') == 'ok'): ?>
            Swal.fire('Eliminado!', 'El dato ha sido eliminado.', 'success');
        <?php endif; ?>
        <?php if(session('editar') == 'ok'): ?>
            Swal.fire('Actualizado!', 'El dato ha sido actualizado.', 'success');
        <?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/caso_personas/index.blade.php ENDPATH**/ ?>