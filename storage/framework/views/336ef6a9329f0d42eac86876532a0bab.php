<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo usuario</h1>
            </strong>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-9 mx-auto">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos</p>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>


                <div class="form-row">
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Nombre de la Usuario</label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                        placeholder="Ingrese el name del Usuario" pattern="[A-Za-z\s]+"
                        title="Solo se permiten letras y espacios">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Apellido paterno del Usuario</label>
                    <input type="text" class="form-control" name="apellidopaterno" value="<?php echo e(old('apellidopaterno')); ?>"
                        placeholder="Ingrese el apellido paterno del Usuario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios">
                    <?php $__errorArgs = ['apellidopaterno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div></div>
                <div class="form-row">
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Apellido materno del Usuario</label>
                    <input type="text" class="form-control" name="apellidomaterno" value="<?php echo e(old('apellidomaterno')); ?>"
                        placeholder="Ingrese el apellido materno del usuario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios">
                    <?php $__errorArgs = ['apellidomaterno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                        placeholder="Ingrese su correo electrónico">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="ci" value="<?php echo e(old('ci')); ?>"
                        placeholder="Ingrese el Documento nacional de identidad del empleado"
                        pattern="^[0-9]+$" title="Solo se permiten números">
                    <?php $__errorArgs = ['ci'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Expedito del CI</label>
                    <select class="form-control" name="expedito">
                        <option value="LP" <?php if(old('expedito') == 'LP'): ?> selected <?php endif; ?>>La Paz</option>
                        <option value="SC" <?php if(old('expedito') == 'SC'): ?> selected <?php endif; ?>>Santa Cruz</option>
                        <option value="CB" <?php if(old('expedito') == 'CB'): ?> selected <?php endif; ?>>Cochabamba</option>
                        <option value="OR" <?php if(old('expedito') == 'OR'): ?> selected <?php endif; ?>>Oruro</option>
                        <option value="PT" <?php if(old('expedito') == 'PT'): ?> selected <?php endif; ?>>Potosí</option>
                        <option value="TJ" <?php if(old('expedito') == 'TJ'): ?> selected <?php endif; ?>>Tarija</option>
                        <option value="CH" <?php if(old('expedito') == 'CH'): ?> selected <?php endif; ?>>Chuquisaca</option>
                        <option value="BE" <?php if(old('expedito') == 'BE'): ?> selected <?php endif; ?>>Beni</option>
                        <option value="PD" <?php if(old('expedito') == 'PD'): ?> selected <?php endif; ?>>Pando</option>
                    </select>
                    <?php $__errorArgs = ['expedito'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Genero del Usuario</label>
                    <select class="form-control" name="genero">
                        <option value="1" <?php if(old('estado') == '1'): ?> selected <?php endif; ?>>Masculino</option>
                        <option value="0" <?php if(old('estado') == '0'): ?> selected <?php endif; ?>>Femenino</option>
                    </select>
                    <?php $__errorArgs = ['genero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Cargo del Usuario</label>
                    <input type="text" class="form-control" name="cargo" value="<?php echo e(old('cargo')); ?>"
                        placeholder="Ingrese el cargo del usuario"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    <?php $__errorArgs = ['cargo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Unidad del Usuario</label>
                    <input type="text" class="form-control" name="unidad" value="<?php echo e(old('unidad')); ?>"
                        placeholder="Ingrese el unidad del usuario"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    <?php $__errorArgs = ['unidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Fecha de nacimiento del Usuario</label>
                    <input type="date" class="form-control" name="fnacimiento" value="<?php echo e(old('fnacimiento')); ?>">
                    <?php $__errorArgs = ['fnacimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

                
                <div class="form-group">
                    <label for="role">Rol del Usuario</label>
                    <select name="role" class="form-control">
                        <option value="" disabled selected>Selecciona un rol</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>" <?php if(old('role') == $role->id): ?> selected <?php endif; ?>>
                                <?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                

                


                
                <div class="form-group">
                    <label>Foto del Usario</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg"
                        value="<?php echo e(old('foto')); ?>" onchange="previewImage(event)">
                    <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Imagen seleccionada:</label>
                    <img id="imagePreview" src="#" alt="Imagen seleccionada"
                        style="max-width: 200px; display: none;">
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar Usuario
                    </button>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
        var input = document.querySelector("#whatsapp");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Agregado
        });

        input.addEventListener("countrychange", function() {
            var countryCode = iti.getSelectedCountryData().dialCode;
            var phoneNumber = input.value;
            var phoneNumberWithCountryCode = countryCode + phoneNumber;
            input.value = phoneNumberWithCountryCode;
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/users/create.blade.php ENDPATH**/ ?>