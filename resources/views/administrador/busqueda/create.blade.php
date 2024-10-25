<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para agregar una nuevo caso</title>
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
                    <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo caso</h1>
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
                <form method="POST" action="{{ route('casos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        {{-- exp_adm --}}
                        <div class="form-group col-md-6 mb-3">
                            <label for="formGroupExampleInput">Exp_adm de la Caso</label>
                            <input type="text" class="form-control" name="exp_adm" value="{{ old('exp_adm') }}"
                                placeholder="Ingrese el exp_adm de la Caso" >
                            @error('exp_adm')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- registro_auxiliar --}}
                        <div class="form-group  col-md-6 mb-3 ">
                            <label for="formGroupExampleInput">Registro_auxiliar</label>
                            <input type="text" class="form-control" name="registro_auxiliar"
                                value="{{ old('registro_auxiliar') }}"
                                placeholder="Ingrese el registro_auxiliarde la persona" >
                            @error('registro_auxiliar')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    {{-- fecha ejecutoria  --}}
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Ejecutoria </label>
                        <input type="date" class="form-control" name="ejecutoria" value="{{ old('ejecutoria') }}">
                        @error('ejecutoria')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- identificcion_caso --}}
                    <label for="formGroupExampleInput">Identificación del caso</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="summernote" class="form-control" name="identificacion_caso"
                        placeholder="Ingrese el contenido del tipo de caso">{{ old('identificacion_caso') }}</textarea>
                    @error('identificacion_caso')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    {{-- apertura_inicial --}}
                    <label for="formGroupExampleInput">Apertura inicial</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="apertura_inicial" class="form-control" name="apertura_inicial" placeholder="Ingrese la apertura inicial">{{ old('apertura_inicial') }}</textarea>
                    @error('apertura_inicial')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    {{-- resolucion_final --}}
                    <label for="formGroupExampleInput">Resolución final</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="resolucion_final" class="form-control" name="resolucion_final" placeholder="Ingrese la resolucion_final">{{ old('resolucion_final') }}</textarea>
                    @error('resolucion_final')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    {{-- recurso_revocatoria --}}
                    <label for="formGroupExampleInput">Recurso revocatoria</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="recurso_revocatoria" class="form-control" name="recurso_revocatoria"
                        placeholder="Ingrese la resolucion_final">{{ old('recurso_revocatoria') }}</textarea>
                    @error('recurso_revocatoria')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    {{-- recurso_jerarquico --}}
                    <label for="formGroupExampleInput">Recurso jerárquico</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="recurso_jerarquico" class="form-control" name="recurso_jerarquico"
                        placeholder="Ingrese la recurso jerarquico">{{ old('recurso_jerarquico') }}</textarea>
                    @error('recurso_jerarquico')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    {{-- antecedentes --}}
                    <label for="formGroupExampleInput">Antecedentes</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="antecedentes" class="form-control" name="antecedentes" placeholder="Ingrese antecedentes">{{ old('antecedentes') }}</textarea>
                    @error('antecedentes')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror




                    <div class="form-row">

                        {{-- MAE --}}
                        <div class="form-group">
                            <label>MAE del Usario</label>
                            <input type="file" class="form-control-file" name="mae" accept=".jpg, image/jpeg"
                                value="{{ old('mae') }}" onchange="previewImage(event)">
                            @error('mae')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Imagen seleccionada:</label>
                            <img id="imagePreview" src="#" alt="Imagen seleccionada"
                                style="max-width: 200px; display: none;">
                        </div>

                        {{-- hoja de ruta --}}
                        <div class="form-group">
                            <label>Hoja de ruta del Usario</label>
                            <input type="file" class="form-control-file" name="hoja_ruta" accept=".jpg, image/jpeg"
                                value="{{ old('hoja_ruta') }}" onchange="previewImage(event)">
                            @error('hoja_ruta')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Imagen seleccionada:</label>
                            <img id="imagePreview" src="#" alt="Imagen seleccionada"
                                style="max-width: 200px; display: none;">
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label style="text-align: center;" for="tipo_persona_ids">Tipos de Persona:</label>
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
                    </div> --}}

            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn btn-success float-center">
                    <i class="fas fa-plus"></i>
                    Agregar caso
                </button>
            </div>
            </form>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
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



        <!-- Incluye Summernote y sus dependencias -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
        <!-- Agrega tu script personalizado para Summernote -->

        <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
        <script>
            $(document).ready(function() {
                // Obtener el nombre del usuario autenticado
                var usuarioNombre = '{{ ucfirst(auth()->user()->name) }}';
                var usuarioApellido = '{{ ucfirst(auth()->user()->apellidopaterno) }}';

                // Inicializar Summernote
                $('#summernote').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });
                // Inicializar Summernote
                $('#apertura_inicial').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });
                // Inicializar Summernote
                $('#resolucion_final').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                      
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });
                $('#recurso_revocatoria').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                       
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });
                $('#recurso_jerarquico').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                       
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });
                $('#antecedentes').summernote({
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']],
                        ['para', ['ul']],
                        ['view', ['fullscreen']],
                    ],
                    icons: {
                        'align': '<i class="custom-icon-align"></i>',
                        'italic': '<i class="custom-icon-italic"></i>',
                    },

                });


            });
        </script>
    @stop
</body>

</html>
