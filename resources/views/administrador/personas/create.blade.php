@extends('adminlte::page')

@section('title', 'CREATESUMRARIADO')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">FORMULARIO PARA AGRGAR UN NUEVO SUMARIADO</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card  " style="font-family: 'Times New Roman', Times, serif;">
        <br>
        <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">Formulario</h4>
        <div class="card-body col-md-9 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos.
                    </p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('personas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    {{-- nombre --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Nombre del Sumariado</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios" required>
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- apellidop --}}
                    <div class="form-group  col-md-6 mb-3 ">
                        <label for="formGroupExampleInput">Apellido Paterno </label>
                        <input type="text" class="form-control" name="apellidop" value="{{ old('apellidop') }}"
                            placeholder="Ingrese el apellido del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        @error('apellidop')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- apellidom --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Apellido Materno </label>
                        <input type="text" class="form-control" name="apellidom" value="{{ old('apellidom') }}"
                            placeholder="Ingrese el apellido del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        @error('apellidom')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- ci --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Documento Nacional de Identidad</label>
                        <input type="text" class="form-control" name="ci" value="{{ old('ci') }}"
                            placeholder="Ingrese el Documento nacional de identidad del sumariado" pattern="^\d{7,10}$"
                            title="Solo se permiten números enteros de 7 a 10 dígitos">
                        @error('ci')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- extencion --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput"> Extencion Documento de Identidad</label>
                        <input type="text" class="form-control" name="extension" value="{{ old('extension') }}"
                            placeholder="Ingrese la extensión del sumariado" pattern="^[A-Za-z0-9]{1,2}$"
                            title="Solo se permiten letras y/o números, máximo 2 caracteres">
                        @error('extension')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        {{-- expedido --}}
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Expedido del CI</label>
                        l<abel for="formGroupExampleInput">Expedido del CI</label>
                            <select class="form-control" id="expedido" name="expedido" onchange="updateNacionalidad()">
                                <option value="" disabled @if (old('expedido') == '') selected @endif>Seleccione el lugar de expedición</option>
                                <option value="LP" @if (old('expedido') == 'LP') selected @endif>La Paz</option>
                                <option value="SC" @if (old('expedido') == 'SC') selected @endif>Santa Cruz</option>
                                <option value="CB" @if (old('expedido') == 'CB') selected @endif>Cochabamba</option>
                                <option value="OR" @if (old('expedido') == 'OR') selected @endif>Oruro</option>
                                <option value="PT" @if (old('expedido') == 'PT') selected @endif>Potosí</option>
                                <option value="TJ" @if (old('expedido') == 'TJ') selected @endif>Tarija</option>
                                <option value="CH" @if (old('expedido') == 'CH') selected @endif>Chuquisaca</option>
                                <option value="BE" @if (old('expedido') == 'BE') selected @endif>Beni</option>
                                <option value="PD" @if (old('expedido') == 'PD') selected @endif>Pando</option>
                            </select>
                            @error('expedido')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- nacionalidad --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad"
                            value="{{ old('nacionalidad') }}" placeholder="Ingrese la nacionalidad del sumariado"
                            pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$" title="Solo se permiten letras y espacios">
                        @error('nacionalidad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- fecha fnacimiento  --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Fecha de Nacimiento </label>
                        <input type="date" class="form-control" name="fnacimiento" value="{{ old('fnacimiento') }}">
                        @error('fnacimiento')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- whatsapp --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Whatsapp del Sumariado</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                value="{{ old('whatsapp') }}" placeholder="Ingrese el whatsapp del sumariado"
                                pattern="^\d{8,15}$" title="Solo se permiten números de 8 a 15 dígitos">
                            <input type="hidden" id="codigoPais" name="codigoPais">
                        </div>
                        @error('whatsapp')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label style="text-align: center;" for="tipo_persona_ids">Tipos de Sumariados:</label>
                    <select multiple="multiple" size="10" name="tipo_persona_ids[]" title="tipo_persona_id[]">
                        @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                            <option value="{{ $tipo_personaId }}" @if (old('tipo_persona_ids') && in_array($tipo_personaId, old('tipo_persona_ids'))) selected @endif>
                                {{ $tipo_personaNombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_persona_ids')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-row">
                    {{-- genero --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Género del Sumariado</label>
                        <select class="form-control" name="genero">
                            <option value="1" @if (old('genero') == '1') selected @endif>Masculino</option>
                            <option value="0" @if (old('genero') == '0') selected @endif>Femenino</option>
                        </select>
                        @error('genero')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- institucion --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">institución del Sumariado </label>
                        <input type="text" class="form-control" name="institucion" value="{{ old('institucion') }}"
                            placeholder="Ingrese la institución del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('institucion')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- unidad --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Unidad del Sumariado</label>
                        <input type="text" class="form-control" name="unidad" value="{{ old('unidad') }}"
                            placeholder="Ingrese la unidad del sumariado" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('unidad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- cargo --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Cargo del Sumariado</label>
                        <input type="text" class="form-control" name="cargo" value="{{ old('cargo') }}"
                            placeholder="Ingrese el cargo del sumario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('cargo')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- domicilio real --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Domicilio real</label>
                        <input type="text" class="form-control" name="domicilioreal"
                            value="{{ old('domicilioreal') }}" placeholder="Ingrese su domicilio real"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        @error('domicilioreal')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- domicilio  legal --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Domicilio legal</label>
                        <input type="text" class="form-control" name="domiciliolegal"
                            value="{{ old('domiciliolegal') }}" placeholder="Ingrese su domicilio legal"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        @error('domiciliolegal')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- domicilio convencional --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Domicilio convencional</label>
                        <input type="text" class="form-control" name="domicilioconvencional"
                            value="{{ old('domicilioconvencional') }}" placeholder="Ingrese su domicilio convencional"
                            pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones">
                        @error('domicilioconvencional')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- correo --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Correo Electrónico</label>
                        <input type="email" class="form-control" name="gmail" value="{{ old('gmail') }}"
                            placeholder="Ingrese el correo electrónico"
                            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                            title="Ingrese un correo electrónico válido">
                        @error('gmail')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- foto --}}
                <div class="form-group">
                    <label>Foto del Usario</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg"
                        value="{{ old('foto') }}" onchange="previewImage(event)">
                    @error('foto')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
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
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
@stop
@section('js')
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
@stop
