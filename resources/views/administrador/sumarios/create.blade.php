<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario para agregar sumario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <div class="card" style="font-family: 'Times New Roman', Times, serif;">
            <div class="card-body" style="text-align: center;">
                <strong>
                    <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar  sumario</h1>
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
                <form method="POST" action="{{ route('sumarios.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        {{-- nombre --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Nombre de la sumario</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                                placeholder="Ingrese el nombre del sumario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                                title="Solo se permiten letras y espacios">
                            @error('nombre')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                        </div>
                        {{-- apellido paterno --}}
                        <div class="form-group  col-md-6 mb-3 ">
                            <label for="formGroupExampleInput">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellidop" value="{{ old('apellidop') }}"
                                placeholder="Ingrese el apellido de la sumario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                                title="Solo se permiten letras, sin espacios">
                            @error('apellidop')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- apellido materno --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellidom" value="{{ old('apellidom') }}"
                                placeholder="Ingrese el apellido de la sumario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                                title="Solo se permiten letras, sin espacios">
                            @error('apellidom')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            {{-- ci --}}
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Documento nacional de identidad</label>
                            <input type="text" class="form-control" name="ci" value="{{ old('ci') }}"
                                placeholder="Ingrese el Documento nacional de identidad del sumario" pattern="^\d{7,10}$"
                                title="Solo se permiten números enteros de 7 a 10 dígitos">
                            @error('ci')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- extencion --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput"> Extencion Documento de identidad</label>
                            <input type="text" class="form-control" name="extension" value="{{ old('extension') }}"
                                placeholder="Ingrese la extencion del  sumario" pattern="^\d{0,9}$"
                                title="Solo se permiten números enteros de 7 a 10 dígitos">
                            @error('extension')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            {{-- expedido --}}
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Expedido del CI</label>
                            <select class="form-control" name="expedido">
                                <option value="LP" @if (old('expedido') == 'LP') selected @endif>La Paz
                                </option>
                                <option value="SC" @if (old('expedido') == 'SC') selected @endif>Santa Cruz
                                </option>
                                <option value="CB" @if (old('expedido') == 'CB') selected @endif>Cochabamba
                                </option>
                                <option value="OR" @if (old('expedido') == 'OR') selected @endif>Oruro
                                </option>
                                <option value="PT" @if (old('expedido') == 'PT') selected @endif>Potosí
                                </option>
                                <option value="TJ" @if (old('expedido') == 'TJ') selected @endif>Tarija
                                </option>
                                <option value="CH" @if (old('expedido') == 'CH') selected @endif>Chuquisaca
                                </option>
                                <option value="BE" @if (old('expedido') == 'BE') selected @endif>Beni
                                </option>
                                <option value="PD" @if (old('expedido') == 'PD') selected @endif>Pando
                                </option>
                            </select>
                            @error('expedido')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- genero --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Genero de la sumario</label>
                            <select class="form-control" name="genero">
                                <option value="1" @if (old('genero') == '1') selected @endif>Masculino
                                </option>
                                <option value="0" @if (old('genero') == '0') selected @endif>Femenino
                                </option>
                            </select>
                            @error('genero')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- nacionalidad --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Nacionalidad</label>
                            <input type="text" class="form-control" name="nacionalidad"
                                value="{{ old('nacionalidad') }}" placeholder="Ingrese la nacionalidad de la sumario"
                                pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$" title="Solo se permiten letras, sin espacios">
                            @error('nacionalidad')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- fecha fnacimiento  --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Fecha de nacimiento </label>
                            <input type="date" class="form-control" name="fnacimiento" value="{{ old('fnacimiento') }}">
                            @error('fnacimiento')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- whatsapp --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Whatsapp de la sumario</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                    value="{{ old('whatsapp') }}" placeholder="Ingrese el whatsapp del sumario"
                                    pattern="^[0-9]+$" title="Solo se permiten números">
                                <input type="hidden" id="codigoPais" name="codigoPais">
                            </div>
                            @error('whatsapp')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- fregistro --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Fecha de regitro de sumario</label>
                            <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}">
                            @error('fecha')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- tipo_persona_id --}}
                        {{-- <div class="form-group col-md-6 mb-3">
                            <label for="tipo_persona">Tipo de Persona:</label>
                            <select name="tipo_persona_id" class="form-control">
                                <option value="" selected disabled>Seleccione el tipo de persona</option>
                                @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                                    <option value="{{ $tipo_personaId }}"
                                        {{ old('tipo_persona_id') == $tipo_personaId ? 'selected' : '' }}>
                                        {{ $tipo_personaNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_persona_id')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label style="text-align: center;" for="tipo_persona_ids">Tipos de Persona:</label>
                            <select multiple="multiple" size="10" name="tipo_persona_ids[]"
                                title="tipo_persona_id[]">
                                @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                                    <option value="{{ $tipo_personaId }}"
                                        @if (old('tipo_persona_ids') && in_array($tipo_personaId, old('tipo_persona_ids'))) selected @endif>
                                        {{ $tipo_personaNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_persona_ids')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- institucion --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Institucion de la sumario</label>
                            <input type="text" class="form-control" name="institucion"
                                value="{{ old('institucion') }}"
                                placeholder="Ingrese la institucion del sumario"pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                                title="Solo se permiten letras y espacios">

                            @error('institucion')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- unidad --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Unidad del sumario</label>
                            <input type="text" class="form-control" name="unidad " value="{{ old('unidad') }}"
                                placeholder="Ingrese la unidad  del sumario"pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                                title="Solo se permiten letras y espacios">

                            @error('unidad')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- cargo --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Cargo del sumario</label>
                            <input type="text" class="form-control" name="cargo" value="{{ old('cargo') }}"
                                placeholder="Ingrese el cargo sumario"pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                                title="Solo se permiten letras y espacios">

                            @error('cargo')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- domicilio real --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Domicilio real</label>
                            <input type="text" class="form-control" name="domicilioreal"
                                value="{{ old('domicilioreal') }}" placeholder="Ingrese su domucilio ">
                                 {{-- pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$1818" title="Solo se permiten letras,numeros">  --}}
                            @error('domicilioreal')
                                <span  style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        {{-- domicilio  legal --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Domicilio legal</label>
                            <input type="text" class="form-control" name="domiciliolegal"
                                value="{{ old('domiciliolegal') }}" placeholder="Ingrese su domucilio iodomicilioconvencional ">
                                {{-- pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$1818" title="Solo se permiten letras,numeros"> --}}
                            @error('domiciliolegal')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- domicilio convencional --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Domicilio covencional</label>
                            <input type="text" class="form-control" name="domicilioconvencional"
                                value="{{ old('domicilioconvencional') }}" placeholder="Ingrese su domucilio convencional "
                                {{-- pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$1818" title="Solo se permiten letras,numeros" --}}>
                            @error('domicilioconvencional')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- correo --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Correo Electrónico</label>
                            <input type="gmail" class="form-control" name="gmail" value="{{ old('gmail') }}"
                                placeholder="Ingrese el correo electrónico">
                            @error('gmail')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
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
                            Agregar sumario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @stop
    @section('css')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
    @stop

    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
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
</body>

</html>