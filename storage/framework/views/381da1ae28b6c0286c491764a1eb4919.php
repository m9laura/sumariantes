<?php $__env->startSection('title', 'Búsqueda Avanzada'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1 style="font-family: 'Times New Roman', Times, serif;">Búsqueda Avanzada</h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <h1 class="m-0 text-primary">Resultados de la Búsqueda</h1>
            <form method="GET" action="<?php echo e(route('busqueda.index')); ?>" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search_persona" placeholder="Buscar por persona..."
                        value="<?php echo e(request()->input('search_persona')); ?>">
                    <input type="text" class="form-control" name="search_sancion" placeholder="Buscar por sanción..."
                        value="<?php echo e(request()->input('search_sancion')); ?>">
                    <input type="text" class="form-control" name="search_caso" placeholder="Buscar por caso..."
                        value="<?php echo e(request()->input('search_caso')); ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </form>
            <!-- Tabla de Personas -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Personas</h3>
                        </div>
                        <div class="card-body">
                            <div class="dt-buttons btn-group flex-wrap mb-3">
                                <button class="btn btn-secondary buttons-copy">Copiar</button>
                                <button class="btn btn-secondary buttons-csv">CSV</button>
                                <button class="btn btn-secondary buttons-print">Imprimir</button>
                            </div>
                            <div class="table-responsive">
                                <table id="personas" class="table table-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>CI</th>
                                            <th>Tipo de Persona</th>
                                            <th>Sanciones</th>
                                            <th>Casos</th>
                                            <th>Tipo de Caso</th>
                                            <th>Actuados del Caso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($persona->nombre); ?></td>
                                                <td><?php echo e($persona->apellidop); ?></td>
                                                <td><?php echo e($persona->apellidom); ?></td>
                                                <td><?php echo e($persona->ci); ?></td>
                                                <td>
                                                    <?php $__currentLoopData = $persona->tipoPersonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoPersona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($tipoPersona->nombre); ?><?php if(!$loop->last): ?>
                                                            ,
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                    <?php if($persona->sancionpersonas->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $persona->sancionpersonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sancionPersona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($sancionPersona->nombre ?? 'Sin sanción'); ?><?php if(!$loop->last): ?>
                                                                ,
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        Sin sanción
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($persona->casos->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $persona->casos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($caso->identificacion_caso); ?><?php if(!$loop->last): ?>
                                                                ,
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        Sin casos
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($persona->casos->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $persona->casos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($caso->tipoCaso->nombre ?? 'Sin tipo de caso'); ?><?php if(!$loop->last): ?>
                                                                ,
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        Sin tipo de caso
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($persona->casos->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $persona->casos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($caso->actuas->isNotEmpty()): ?>
                                                                <?php $__currentLoopData = $caso->actuas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actua): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo e($actua->nombre); ?><?php if(!$loop->last): ?>
                                                                        ,
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                Sin actuados
                                                            <?php endif; ?>
                                                            <?php if(!$loop->last): ?>
                                                                <br>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        Sin actuados
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">No se encontraron resultados para la
                                                        búsqueda de personas.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Sanciones -->
<!-- Tabla de Sanciones -->
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Sanciones</h3>
            </div>
            <div class="card-body">
                <div class="dt-buttons btn-group flex-wrap mb-3">
                    <button class="btn btn-secondary buttons-copy">Copiar</button>
                    <button class="btn btn-secondary buttons-csv">CSV</button>
                    <button class="btn btn-secondary buttons-print">Imprimir</button>
                </div>
                <div class="table-responsive">
                    <table id="sanciones" class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                                <th>Personas Asociadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $sanciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sancion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($sancion->nombre); ?></td>
                                    <td><?php echo e($sancion->descripcion); ?></td>
                                    <td><?php echo e($sancion->estado ? 'Activo' : 'Inactivo'); ?></td>
                                    <td>
                                        <?php
                                            $fechaCreacion = $sancion->fecha ? \Carbon\Carbon::parse($sancion->fecha) : null;
                                        ?>
                                        <?php echo e($fechaCreacion ? $fechaCreacion->format('d/m/Y') : 'N/A'); ?>

                                    </td>
                                    <td>
                                        <?php if($sancion->sancionpersonas->isEmpty()): ?>
                                            Sin personas asociadas
                                        <?php else: ?>
                                            <ul>
                                                <?php $__currentLoopData = $sancion->sancionpersonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sancionPersona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        Persona ID: <?php echo e($sancionPersona->persona_id); ?> - 
                                                        Fecha:
                                                        <?php
                                                            $fechaPersona = $sancionPersona->fecha ? \Carbon\Carbon::parse($sancionPersona->fecha) : null;
                                                        ?>
                                                        <?php echo e($fechaPersona ? $fechaPersona->format('d/m/Y') : 'N/A'); ?>

                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center">No se encontraron resultados para la búsqueda de sanciones.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Tabla de Casos -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Casos</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="casos" class="table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>Identificación</th>
                                                <th>Expediente</th>
                                                <th>Estado</th>
                                                <th>Tipo de Caso</th>
                                                <th>Personas Asociadas</th> <!-- Nueva columna para personas -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $casos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($caso->identificacion_caso); ?></td>
                                                    <td><?php echo e($caso->exp_adm); ?></td>
                                                    <td><?php echo e($caso->estado ? 'Abierto' : 'Cerrado'); ?></td>
                                                    <td><?php echo e($caso->tipoCaso->nombre ?? 'Sin tipo'); ?></td>
                                                    <td>
                                                        <?php if($caso->personas->isNotEmpty()): ?>
                                                            <?php $__currentLoopData = $caso->personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($persona->nombre); ?> <?php echo e($persona->apellidop); ?>

                                                                <?php echo e($persona->apellidom); ?><?php if(!$loop->last): ?>
                                                                    ,
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            Sin personas asociadas
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No se encontraron resultados para la
                                                        búsqueda de casos.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
        <!-- CSS de DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('js'); ?>
        <!-- JS de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- JS de DataTables -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#personas').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });

                $('#sanciones').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });

                $('#casos').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/busqueda/index.blade.php ENDPATH**/ ?>