<?php $__env->startSection('title', 'CREATESUMRARIADO'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">FORMULARIO PARA AGRGAR UN NUEVO SUMARIADO</h1>
            </strong>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card  " style="font-family: 'Times New Roman', Times, serif;">
        <br>
        <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">Formulario</h4>
        <div class="card-body col-md-9 mx-auto">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos.
                    </p>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('personas.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Nombre del Sumariado</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre')); ?>"
                        placeholder="Ingrese el nombre del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios" required>
                        <?php $__errorArgs = ['nombre'];
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
                    
                    <div class="form-group  col-md-6 mb-3 ">
                        <label for="formGroupExampleInput">Apellido Paterno </label>
                        <input type="text" class="form-control" name="apellidop" value="<?php echo e(old('apellidop')); ?>"
                            placeholder="Ingrese el apellido del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        <?php $__errorArgs = ['apellidop'];
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
                        <label for="formGroupExampleInput">Apellido Materno </label>
                        <input type="text" class="form-control" name="apellidom" value="<?php echo e(old('apellidom')); ?>"
                            placeholder="Ingrese el apellido del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        <?php $__errorArgs = ['apellidom'];
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
                        <label for="formGroupExampleInput">Documento Nacional de Identidad</label>
                        <input type="text" class="form-control" name="ci" value="<?php echo e(old('ci')); ?>"
                            placeholder="Ingrese el Documento nacional de identidad del sumariado" pattern="^\d{7,10}$"
                            title="Solo se permiten números enteros de 7 a 10 dígitos">
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
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput"> Extencion Documento de Identidad</label>
                        <input type="text" class="form-control" name="extension" value="<?php echo e(old('extension')); ?>"
                            placeholder="Ingrese la extensión del sumariado" pattern="^[A-Za-z0-9]{1,2}$"
                            title="Solo se permiten letras y/o números, máximo 2 caracteres">
                        <?php $__errorArgs = ['extension'];
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
                        <label for="formGroupExampleInput">Expedido del CI</label>
                        l<abel for="formGroupExampleInput">Expedido del CI</label>
                            <select class="form-control" id="expedido" name="expedido" onchange="updateNacionalidad()">
                                <option value="" disabled <?php if(old('expedido') == ''): ?> selected <?php endif; ?>>Seleccione el lugar de expedición</option>
                                <option value="LP" <?php if(old('expedido') == 'LP'): ?> selected <?php endif; ?>>La Paz</option>
                                <option value="SC" <?php if(old('expedido') == 'SC'): ?> selected <?php endif; ?>>Santa Cruz</option>
                                <option value="CB" <?php if(old('expedido') == 'CB'): ?> selected <?php endif; ?>>Cochabamba</option>
                                <option value="OR" <?php if(old('expedido') == 'OR'): ?> selected <?php endif; ?>>Oruro</option>
                                <option value="PT" <?php if(old('expedido') == 'PT'): ?> selected <?php endif; ?>>Potosí</option>
                                <option value="TJ" <?php if(old('expedido') == 'TJ'): ?> selected <?php endif; ?>>Tarija</option>
                                <option value="CH" <?php if(old('expedido') == 'CH'): ?> selected <?php endif; ?>>Chuquisaca</option>
                                <option value="BE" <?php if(old('expedido') == 'BE'): ?> selected <?php endif; ?>>Beni</option>
                                <option value="PD" <?php if(old('expedido') == 'PD'): ?> selected <?php endif; ?>>Pando</option>
                            </select>
                            <?php $__errorArgs = ['expedido'];
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
                        <label for="formGroupExampleInput">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad"
                            value="<?php echo e(old('nacionalidad')); ?>" placeholder="Ingrese la nacionalidad del sumariado"
                            pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$" title="Solo se permiten letras y espacios">
                        <?php $__errorArgs = ['nacionalidad'];
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
                        <label for="formGroupExampleInput">Fecha de Nacimiento </label>
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
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Whatsapp del Sumariado</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                value="<?php echo e(old('whatsapp')); ?>" placeholder="Ingrese el whatsapp del sumariado"
                                pattern="^\d{8,15}$" title="Solo se permiten números de 8 a 15 dígitos">
                            <input type="hidden" id="codigoPais" name="codigoPais">
                        </div>
                        <?php $__errorArgs = ['whatsapp'];
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
                    <label style="text-align: center;" for="tipo_persona_ids">Tipos de Sumariados:</label>
                    <select multiple="multiple" size="10" name="tipo_persona_ids[]" title="tipo_persona_id[]">
                        <?php $__currentLoopData = $tipo_personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_personaId => $tipo_personaNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipo_personaId); ?>" <?php if(old('tipo_persona_ids') && in_array($tipo_personaId, old('tipo_persona_ids'))): ?> selected <?php endif; ?>>
                                <?php echo e($tipo_personaNombre); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['tipo_persona_ids'];
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
                <div class="form-row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Género del Sumariado</label>
                        <select class="form-control" name="genero">
                            <option value="1" <?php if(old('genero') == '1'): ?> selected <?php endif; ?>>Masculino</option>
                            <option value="0" <?php if(old('genero') == '0'): ?> selected <?php endif; ?>>Femenino</option>
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
                        <label for="formGroupExampleInput">institución del Sumariado </label>
                        <input type="text" class="form-control" name="institucion" value="<?php echo e(old('institucion')); ?>"
                            placeholder="Ingrese la institución del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        <?php $__errorArgs = ['institucion'];
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
                        <label for="formGroupExampleInput">Unidad del Sumariado</label>
                        <input type="text" class="form-control" name="unidad" value="<?php echo e(old('unidad')); ?>"
                            placeholder="Ingrese la unidad del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
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
                        <label for="formGroupExampleInput">Cargo del Sumariado</label>
                        <input type="text" class="form-control" name="cargo" value="<?php echo e(old('cargo')); ?>"
                            placeholder="Ingrese el cargo del sumario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
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
                        <label for="formGroupExampleInput">Domicilio real</label>
                        <input type="text" class="form-control" name="domicilioreal"
                            value="<?php echo e(old('domicilioreal')); ?>" placeholder="Ingrese su domicilio real"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        <?php $__errorArgs = ['domicilioreal'];
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
                        <label for="formGroupExampleInput">Domicilio legal</label>
                        <input type="text" class="form-control" name="domiciliolegal"
                            value="<?php echo e(old('domiciliolegal')); ?>" placeholder="Ingrese su domicilio legal"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        <?php $__errorArgs = ['domiciliolegal'];
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
                        <label for="formGroupExampleInput">Domicilio convencional</label>
                        <input type="text" class="form-control" name="domicilioconvencional"
                            value="<?php echo e(old('domicilioconvencional')); ?>" placeholder="Ingrese su domicilio convencional"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        <?php $__errorArgs = ['domicilioconvencional'];
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
                        <input type="email" class="form-control" name="gmail" value="<?php echo e(old('gmail')); ?>"
                            placeholder="Ingrese el correo electrónico"
                            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                            title="Ingrese un correo electrónico válido">
                        <?php $__errorArgs = ['gmail'];
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
        </div>
        <div style="text-align: center;">
            <button type="submit" class="btn btn-success float-center">
                <i class="fas fa-plus"></i>
                Agregar Sumariado
            </button>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
    <script>
        // Función para actualizar la nacionalidad automáticamente
        // Función para actualizar la nacionalidad automáticamente
        function updateNacionalidad() {
            var expedido = document.getElementById("expedido").value; // Obtiene el valor del campo 'expedido'
            var nacionalidadField = document.getElementById("nacionalidad"); // Obtiene el campo 'nacionalidad'
            // Si el campo 'expedido' tiene un valor (algo seleccionado), se establece la nacionalidad como "Boliviano"
            if (expedido !== "") {
                nacionalidadField.value = "Boliviano"; // Establece "Boliviano" en el campo de nacionalidad
                nacionalidadField.setAttribute('readonly', 'readonly'); // Hace el campo solo lectura
            } else {
                // Si no se selecciona ninguna opción en 'expedido', se permite la edición de nacionalidad
                nacionalidadField.value = ""; // Limpia el valor
                nacionalidadField.removeAttribute('readonly'); // Permite la entrada manual
            }
        }
        // Llama a la función cuando la página se carga por primera vez
        document.addEventListener('DOMContentLoaded', function() {
            updateNacionalidad();
        });
        // Ejecutar la función al cargar la página para manejar el valor actual
        document.addEventListener("DOMContentLoaded", updateNacionalidad);
    </script>
    <script>
        var input = document.querySelector("#whatsapp");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
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

        function showFields() {
            var categoria = document.getElementById('categoria').value;
            var comunFields = document.getElementById('comun-fields');
            var funcionarioFields = document.getElementById('funcionario-fields');
            var universitarioFields = document.getElementById('universitario-fields');
            var estudianteFields = document.getElementById('estudiante-fields');

            comunFields.classList.add('hidden');
            funcionarioFields.classList.add('hidden');
            universitarioFields.classList.add('hidden');
            estudianteFields.classList.add('hidden');

            if (categoria === 'Comun') {
                comunFields.classList.remove('hidden');
            } else if (categoria === 'Funcionario') {
                funcionarioFields.classList.remove('hidden');
            } else if (categoria === 'Universitario') {
                universitarioFields.classList.remove('hidden');
            } else if (categoria === 'Estudiante') {
                estudianteFields.classList.remove('hidden');
            }
        }
    </script>
    <script
        src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
    </script>
    <script>
        // Inicializar Dual Listbox
        var tipo_persona_duallistbox = $('select[name="tipo_persona_ids[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Tipos de Personas Disponibles',
            selectedListLabel: 'Tipos de Personas Seleccionadas',
            preserveSelectionOnMove: 'moved',
            moveAllLabel: 'Mover todos',
            removeAllLabel: 'Eliminar todos',
            infoText: 'Mostrando todo {0}',
            infoTextFiltered: '<span class="badge badge-warning">Filtrado</span> {0} de {1}',
            infoTextEmpty: 'Lista vacía',
            filterPlaceHolder: 'Filtrar',
            moveSelectedLabel: 'Mover seleccionado',
            removeSelectedLabel: 'Eliminar seleccionado'

        });
        $('.moveall').html('Mover todos <span class="badge badge-secondary"> </span>');
        $('.removeall').html('Eliminar todos <span class="badge badge-secondary"> </span>');

        // Inicializar Dual Listbox

        // Mostrar u ocultar el nuevo formulario según el estado del checkbox
        var checkbox = document.getElementById('generar-formulario');
        var nuevoFormulario = document.getElementById('nuevo-formulario');
        checkbox.addEventListener('change', function() {
            nuevoFormulario.style.display = checkbox.checked ? 'block' : 'none';
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SGCCSV4\resources\views/administrador/personas/create.blade.php ENDPATH**/ ?>