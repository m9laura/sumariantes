<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de Usuarios</strong>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.create')): ?>
                <a class="btn btn-success float-right" href="<?php echo e(route('admin.users.create')); ?>">
                    <i class="fas fa-plus"></i>
                    Agregar usuarios
                </a>
            <?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 style="font-family: 'Times New Roman', Times, serif;"><?php echo e(ucfirst('Usuarios')); ?></h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="user">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Role</th>
                        <th scope="col">Estado Laboral</th>
                        <?php if(auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.destroy')): ?>
                            <th scope="col">Acción</th>
                        <?php endif; ?>


                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($user->id); ?></th>
                            <td><?php echo e(ucfirst($user->name)); ?></td>
                            <td><?php echo e(ucfirst($user->apellidopaterno)); ?></td>
                            <td><?php echo e(ucfirst($user->apellidomaterno)); ?></td>
                            <?php if($user->genero == 1): ?>
                                <td>Masculino</td>
                            <?php else: ?>
                                <td>Femenino</td>
                            <?php endif; ?>
                            <td><?php echo e($user->roles->first()->name); ?></td> <!-- Mostrar el primer rol del usuario -->

                            <?php if($user->estado == 1): ?>
                                <td>Trabajando</td>
                            <?php else: ?>
                                <td
                                    style="<?php if($user->estado == 0): ?> background-color: rgba(255, 0, 0, 0.3); <?php endif; ?>">
                                    No trabajando</td>
                            <?php endif; ?>
                            <?php if(auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.destroy')): ?>
                                <td>
                                    
                                    <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST"
                                        class="form-eliminar">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.show')): ?>
                                            <a class="btn btn-secondary btn-sm" href="<?php echo e(route('admin.users.show', $user)); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        <?php endif; ?>


                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.edit')): ?>
                                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.users.edit', $user)); ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.destroy')): ?>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        <?php endif; ?>

                                    </form>
                                    <form action="<?php echo e(route('admin.users.update', ['user' => $user->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="rp" value="505">
                                        <button class=" btn btn-success float-right btn-sm" type="submit "
                                            onclick="return confirm('¿Estás seguro de restablecer la contraseña de este usuario?')">
                                            <i class="fas fa-sync-alt"></i> Restablecer contraseña
                                        </button>
                                    </form>


                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </tbody>
            </table>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if(session('guardar') == 'ok'): ?>
        <script>
            Swal.fire(
                'Creado!',
                'El dato ha sido Creado.',
                'success'
            )
        </script>
    <?php endif; ?>
    
    <?php if(session('eliminar') == 'ok'): ?>
        <script>
            Swal.fire(
                'Eliminado!',
                'El dato ha sido eliminado.',
                'success'
            )
        </script>
    <?php endif; ?>

    <?php if(session('restablecer') == 'ok'): ?>
        <script>
            Swal.fire(
                'Se restablecio correctamente',

            )
        </script>
    <?php endif; ?>

    
    <?php if(session('editar') == 'ok'): ?>
        <script>
            Swal.fire(
                'Actualizado!',
                'El dato ha sido actulizado.',
                'success'
            )
        </script>
    <?php endif; ?>

    <script>
        //llega lo del formulacio de ariba
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Esta seguro?',
                text: "¡El dato se eliminará!",
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>

    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4min.js"></script>
    
    <script>
        $('#user').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página_PAGE_de_PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/users/index.blade.php ENDPATH**/ ?>