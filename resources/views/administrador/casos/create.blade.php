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
    <!-- Mensajes de éxito usando SweetAlert2 -->
    @if (session('guardar') == 'ok')
        <script>
            // Mostrar el modal con el mensaje correspondiente
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('mensaje') }}", // El mensaje que pasaste desde el controlador
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif
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
                    {{-- exp_adm --}}<!-- Expediente Administrativo -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="exp_adm">Expediente Administrativo</label>
                        <input type="text" class="form-control @error('exp_adm') is-invalid @enderror" name="exp_adm"
                            value="{{ old('exp_adm') }}" placeholder="Ingrese el expediente administrativo" maxlength="10"
                            pattern="[A-Za-z0-9-/]*"
                            title="Ingrese un expediente administrativo válido: solo se permiten letras, números, y los símbolos - /"
                            id="exp_adm" required oninput="validateExpAdm(this)">
                        @error('exp_adm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <!-- Mensaje de advertencia si supera los 10 caracteres -->
                        <div id="warning-message-exp-adm" style="color: red; display: none;">
                            ¡Advertencia! El expediente administrativo no puede superar los 10 caracteres y solo permite
                            letras, números, guiones (-), y barras (/).
                        </div>
                    </div>
                    <!-- Registro Auxiliar -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="registro_auxiliar">Registro Auxiliar</label>
                        <input type="text" class="form-control @error('registro_auxiliar') is-invalid @enderror"
                            name="registro_auxiliar" value="{{ old('registro_auxiliar') }}"
                            placeholder="Ingrese el registro auxiliar" maxlength="10" pattern="[A-Za-z0-9-/]*"
                            title="Ingrese un registro auxiliar válido: solo se permiten letras, números, y los símbolos - /"
                            id="registro_auxiliar" required oninput="validateRegistroAuxiliar(this)">
                        @error('registro_auxiliar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <!-- Mensaje de advertencia si supera los 10 caracteres -->
                        <div id="warning-message-registro-auxiliar" style="color: red; display: none;">
                            ¡Advertencia! El registro auxiliar no puede superar los 10 caracteres y solo permite letras,
                            números, guiones (-), y barras (/).
                        </div>
                    </div>
                </div>
                {{-- Fecha Ejecutoria --}}
                <div class="form-group">
                    <label for="ejecutoria">Fecha de Ejecutoria</label>
                    <input type="date" class="form-control @error('ejecutoria') is-invalid @enderror" name="ejecutoria"
                        value="{{ old('ejecutoria') }}" required>
                    @error('ejecutoria')
                        <span style="color: red;">Debe ingresar una fecha válida para la ejecutoria.</span>
                    @enderror
                </div>
                {{-- Identificación del Caso --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Identificación del caso</label>
                    <textarea id="summernote" class="form-control @error('identificacion_caso') is-invalid @enderror"
                        name="identificacion_caso" placeholder="Ingrese el contenido del tipo de caso">{{ old('identificacion_caso') }}</textarea>
                    @error('identificacion_caso')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Apertura Inicial --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apertura inicial</label>
                    <textarea id="apertura_inicial" class="form-control @error('apertura_inicial') is-invalid @enderror"
                        name="apertura_inicial" placeholder="Ingrese los detalles de la apertura inicial">{{ old('apertura_inicial') }}</textarea>
                    @error('apertura_inicial')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-row">
                    {{-- MAE --}}
                    <div class="form-group col-md-6 mb-3">
                        <label>MAE del Usuario</label>
                        <input type="file" class="form-control-file" name="mae" accept=".pdf"
                            value="{{ old('mae') }}" onchange="previewPDF(event, 'maePreview')">
                        @error('mae')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="pdf-preview-container">
                            <label>PDF seleccionado:</label>
                            <iframe id="maePreview" style="max-width: 100%; height: 400px; display: none;"
                                frameborder="0"></iframe>
                            <img src="ruta/a/tu-imagen.jpg" alt="Vista previa" class="pdf-preview-image"
                                style="display:none;" />
                        </div>
                    </div>
                    {{-- Registro Aux --}}
                    <div class="form-group col-md-6 mb-3">
                        <label>Registro Auxiliar Documento</label>
                        <input type="file" class="form-control-file" name="registro_aux" accept=".pdf"
                            value="{{ old('registro_aux') }}" onchange="previewPDF(event, 'registroAuxPreview')">
                        @error('registro_aux')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="pdf-preview-container">
                            <label>PDF seleccionado:</label>
                            <iframe id="registroAuxPreview" style="max-width: 100%; height: 400px; display: none;"
                                frameborder="0"></iframe>
                            <img src="ruta/a/tu-imagen.jpg" alt="Vista previa" class="pdf-preview-image"
                                style="display:none;" />
                        </div>
                    </div>
                </div>

                <input type="hidden" id="personasField" name="personas">
                <div class="form-group">
                    <label>Sumariado Registrados</label>
                    <ul id="listaPersonas">
                        <!-- La lista de personas se actualizará aquí -->
                    </ul>
                </div>
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#registrarPersonasModal">
                    <i class="fas fa-user-plus"></i> Registrar Sumariado 
                </button>
                <!-- Aquí mostramos el mensaje de error si no se registraron personas -->
                @if (session('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i> Agregar Caso
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para registrar personas -->
    <div class="modal fade" id="registrarPersonasModal" tabindex="-1" role="dialog"
        aria-labelledby="registrarPersonasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6e07e2; color: white;">
                    <h5 class="modal-title" id="registrarPersonasModalLabel">Registrar Sumariado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="registrarPersonaForm">
                        <div class="form-group">
                            <label for="ci">CI</label>
                            <input type="text" class="form-control" id="ci" name="ci"
                                placeholder="Ingrese el CI" onkeyup="validarCI()" required minlength="7" maxlength="8"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)">
                            <small class="form-text text-muted">Ingrese un CI válido (7-8 dígitos, entre 5,000,000 y
                                15,000,000).</small>
                            <div id="ciError" class="text-danger" style="display:none;"></div>
                            <!-- Contenedor para error de CI -->
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="nombre">Nombre del Sumariado</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingrese el nombre" required minlength="2" maxlength="60"
                                    pattern="^[A-Za-zñÑáéíóúÁÉÍÓÚ]+$"
                                    title="Solo se permiten letras, sin espacios ni números."
                                    oninput="validarCampo('nombre')">
                                <small id="nombreHelp" class="form-text text-muted">Ingrese solo letras, sin espacios ni
                                    números.</small>
                                <div id="nombreError" class="text-danger" style="display:none;"></div>
                                <!-- Contenedor para error de nombre -->
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="apellidop">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidop" name="apellidop"
                                    placeholder="Ingrese el apellido paterno" required minlength="2" maxlength="30"
                                    pattern="^[A-Za-zñÑáéíóúÁÉÍÓÚ]+$"
                                    title="Solo se permiten letras, sin espacios ni números."
                                    oninput="validarCampo('apellidop')">
                                <small id="apellidopHelp" class="form-text text-muted">Ingrese solo letras, sin espacios
                                    ni números.</small>
                                <div id="apellidopError" class="text-danger" style="display:none;"></div>
                                <!-- Contenedor para error de apellido paterno -->
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="apellidom">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidom" name="apellidom"
                                    placeholder="Ingrese el apellido materno" required minlength="2" maxlength="30"
                                    pattern="^[A-Za-zñÑáéíóúÁÉÍÓÚ]+$"
                                    title="Solo se permiten letras, sin espacios ni números."
                                    oninput="validarCampo('apellidom')">
                                <small id="apellidomHelp" class="form-text text-muted">Ingrese solo letras, sin espacios
                                    ni números.</small>
                                <div id="apellidomError" class="text-danger" style="display:none;"></div>
                                <!-- Contenedor para error de apellido materno -->
                            </div>
                        </div>
                        <div id="ciErrorMsg" class="alert alert-danger" style="display:none;">Error: Ya existe una
                            persona registrada con este CI.</div>
                        <div id="nombreErrorMsg" class="alert alert-danger" style="display:none;">Error: Solo se permiten
                            letras sin espacios ni números.</div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="guardarPersonaBtn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet"
        type="text/css"href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .is-valid {
            border-color: #28a745;
            /* Verde */
        }

        .is-invalid {
            border-color: #dc3545;
            /* Rojo */
        }

        .text-muted {
            color: #6c757d;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 2px solid #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .text-danger {
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-text {
            font-size: 0.85rem;
        }

        /* BOTONES  */
        /* Estilo para los botones */
        .btn {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
            /* Cambia el color al pasar el mouse */
            transform: scale(1.05);
            /* Efecto de aumento */
        }

        /* Estilo para el modal */
        .modal-header {
            background-color: #007bff;
            /* Color de fondo */
            color: white;
            /* Color del texto */
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            /* Línea superior */
        }

        /* Efecto para la alerta */
        .alert {
            transition: opacity 0.5s;
        }

        .alert-danger {
            opacity: 1;
            /* Asegura que se vea */
        }

        /* ESTILOS PDF BOTON  */
        .pdf-preview-container {
            border: 2px solid #007bff;
            /* Bordes color azul */
            border-radius: 8px;
            /* Bordes redondeados */
            padding: 10px;
            /* Espaciado interno */
            background-color: #f8f9fa;
            /* Color de fondo claro */
            position: relative;
            /* Posicionamiento relativo para el contenido */
            overflow: hidden;
            /* Para evitar que el contenido desborde */
            margin-top: 10px;
            /* Espacio entre la entrada y la vista previa */
        }

        .pdf-preview-container label {
            font-weight: bold;
            /* Texto en negrita */
            color: #343a40;
            /* Color del texto */
        }

        .pdf-preview-image {
            max-width: 100%;
            /* Imagen responsive */
            height: auto;
            /* Mantener proporciones */
            position: absolute;
            /* Posicionamiento absoluto */
            top: 10px;
            /* Distancia desde la parte superior */
            left: 10px;
            /* Distancia desde la izquierda */
            z-index: -1;
            /* Envuelve el iframe */
            opacity: 0.2;
            /* Transparente para no distraer */
        }

        iframe {
            z-index: 1;
            /* Aseguramos que el iframe esté por encima de la imagen */
        }
    </style>

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
            // Inicializar Summernote para el campo de Identificación del Caso
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'clear']],
                    ['fontname', ['fontname']],
                    ['para', ['ul']],
                    ['view', ['fullscreen']],
                ],
            });
            // Inicializar Summernote para el campo de Apertura Inicial
            $('#apertura_inicial').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'clear']],
                    ['fontname', ['fontname']],
                    ['para', ['ul']],
                    ['view', ['fullscreen']],
                ],
            });
            // Función para limpiar HTML innecesario
            function cleanHTML(content) {
                // Eliminar etiquetas <o:p>, <p>, <span>, <a> y comentarios de listas
                var cleanedContent = content
                    .replace(/<\/?o:p>/g, '') // Elimina etiquetas <o:p>
                    .replace(/<\/?span[^>]*>/g, '') // Elimina etiquetas <span>
                    .replace(/<\/?p[^>]*>/g, '') // Elimina etiquetas <p> y <p class=...>
                    .replace(/<\/?a[^>]*>/g, '') // Elimina etiquetas <a>
                    .replace(/<!--\[if !supportLists\]-->/g, '') // Elimina comentarios de listas
                    .replace(/<!--\[endif\]-->/g, '') // Elimina el final de los comentarios de listas
                    .replace(/&nbsp;/g, ' ') // Reemplaza &nbsp; por espacio normal
                    .replace(/&amp;/g, '&') // Asegura que los caracteres especiales sean correctos
                    .replace(/\s+/g, ' ') // Reemplaza múltiples espacios por uno solo
                    .trim(); // Elimina los espacios al principio y al final
                return cleanedContent;
            }
            // Limpiar contenido antes de enviar el formulario
            $('form').on('submit', function(e) {
                // Obtener el contenido de Summernote y de Apertura Inicial
                var summernoteContent = $('#summernote').val();
                var aperturaInicialContent = $('#apertura_inicial').val();
                // Limpiar el contenido usando la función de limpieza
                $('#summernote').val(cleanHTML(summernoteContent));
                $('#apertura_inicial').val(cleanHTML(aperturaInicialContent));
            });
        });
    </script>
    {{-- para los pdfd --}}
    <script>
        function previewPDF(event, previewId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const iframe = document.getElementById(previewId);
                iframe.src = e.target.result;
                iframe.style.display = "block"; // Muestra el iframe cuando hay un archivo
            };

            if (file) {
                reader.readAsDataURL(file); // Leer el archivo como una URL de datos
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener referencia a los elementos necesarios
            const personasField = document.getElementById('personasField');
            const registrarPersonaForm = document.getElementById('registrarPersonaForm');
            const listaPersonas = document.getElementById('listaPersonas');
            const ciInput = document.getElementById('ci');
            const ciErrorMsg = document.getElementById('ciErrorMsg');
            const nombreErrorMsg = document.getElementById('nombreErrorMsg');
            // Inicializar el array de personas desde el campo oculto o como un array vacío
            let personas = JSON.parse(personasField.value || '[]');
            // Event listener para el botón de guardar persona
            document.getElementById('guardarPersonaBtn').addEventListener('click', function() {
                guardarPersona();
            });
            // Función para buscar persona por CI
            function buscarPersona() {
                const ci = ciInput.value.trim();
                if (ci.length > 0) {
                    $.ajax({
                        url: '/buscar-persona/' + ci,
                        method: 'GET',
                        success: function(response) {
                            if (response.existe) {
                                // Si la persona existe, autocompletar los campos
                                document.getElementById('nombre').value = response.persona.nombre;
                                document.getElementById('apellidop').value = response.persona.apellidop;
                                document.getElementById('apellidom').value = response.persona.apellidom;
                                // Deshabilitar los campos para evitar cambios
                                deshabilitarCampos();
                            } else {
                                limpiarCampos();
                                habilitarCampos();
                            }
                        },
                        error: function() {
                            alert('Error al buscar la persona');
                        }
                    });
                }
            }
            // Función para deshabilitar campos
            function deshabilitarCampos() {
                document.getElementById('nombre').disabled = true;
                document.getElementById('apellidop').disabled = true;
                document.getElementById('apellidom').disabled = true;
            }

            // Función para habilitar campos
            function habilitarCampos() {
                document.getElementById('nombre').disabled = false;
                document.getElementById('apellidop').disabled = false;
                document.getElementById('apellidom').disabled = false;
            }

            // Función para limpiar los campos
            function limpiarCampos() {
                document.getElementById('nombre').value = '';
                document.getElementById('apellidop').value = '';
                document.getElementById('apellidom').value = '';
            }

            // Función para guardar persona en el array
            function guardarPersona() {
                const nombre = registrarPersonaForm.nombre.value.trim();
                const apellidop = registrarPersonaForm.apellidop.value.trim();
                const apellidom = registrarPersonaForm.apellidom.value.trim();
                const ci = ciInput.value.trim();

                // Verificar si ya existe una persona con el mismo CI
                if (personas.some(persona => persona.ci === ci)) {
                    ciErrorMsg.style.display = 'block';
                    return;
                }

                // Si todos los campos están completos, agregar persona
                if (nombre && apellidop && ci) {
                    personas.push({
                        nombre,
                        apellidop,
                        apellidom,
                        ci
                    });
                    personasField.value = JSON.stringify(personas); // Actualizar el campo oculto
                    actualizarVistaPersonas(); // Actualizar la vista
                    $('#registrarPersonasModal').modal('hide'); // Cerrar el modal
                    registrarPersonaForm.reset(); // Limpiar el formulario
                    habilitarCampos();
                    ciErrorMsg.style.display = 'none'; // Ocultar el mensaje de error
                } else {
                    alert('Por favor, complete todos los campos.');
                }
            }

            // Función para actualizar la vista con la lista de personas
            function actualizarVistaPersonas() {
                listaPersonas.innerHTML = personas.map(persona =>
                    `<li>${persona.nombre} ${persona.apellidop} - ${persona.ci}</li>`).join('');
            }

            // Llamar a la función al cargar la página para mostrar las personas existentes (si las hay)
            actualizarVistaPersonas();

            // Event listener para buscar persona cuando se ingresa el CI
            ciInput.addEventListener('input', buscarPersona);
        });
        // Script de validación
        // Función para validar CI
        function validarCI() {
            const ciInput = document.getElementById('ci');
            const ciValue = ciInput.value;
            // Verifica que el CI no sea demasiado largo
            if (ciValue.length > 8) {
                alert('El CI no puede tener más de 8 dígitos.');
                ciInput.value = ''; // Limpia el campo
                ciInput.focus();
                return;
            }
            // Verifica que el CI esté en el rango permitido
            const ciNumber = parseInt(ciValue);
            if (ciValue.length === 8 && (ciNumber < 5000000 || ciNumber > 15000000)) {
                alert('El CI debe estar entre 5,000,000 y 15,000,000.');
                ciInput.value = ''; // Limpia el campo
                ciInput.focus();
            }
        }

        // Función para validar los campos de texto
        function validarCampo(campoId) {
            const campoInput = document.getElementById(campoId);
            const valor = campoInput.value.trim(); // Remover espacios al inicio y final
            const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ]+$/; // Solo letras, sin espacios

            if (regex.test(valor)) {
                campoInput.classList.remove('is-invalid');
                campoInput.classList.add('is-valid');
                document.getElementById(campoId + 'Help').textContent = ''; // Limpiar mensaje de error
                nombreErrorMsg.style.display = 'none'; // Ocultar mensaje de error
            } else {
                campoInput.classList.remove('is-valid');
                campoInput.classList.add('is-invalid');
                document.getElementById(campoId + 'Help').textContent =
                    'Ingrese un valor válido: solo letras, sin espacios ni números.';
                nombreErrorMsg.style.display = 'block'; // Mostrar mensaje de error
            }
        }
    </script>


    {{-- VALIDACION DE CASOS CAMPOS  --}}
    <script>
        // Función para manejar el mensaje de advertencia si se excede el límite de caracteres
        function handleWarning(inputField, warningMessage, maxLength) {
            inputField.addEventListener('input', function() {
                // Elimina espacios en blanco automáticamente
                this.value = this.value.replace(/\s/g, '');

                // Mostrar el mensaje de advertencia si excede el límite
                if (this.value.length > maxLength) {
                    warningMessage.style.display = 'block';
                } else {
                    warningMessage.style.display = 'none';
                }
            });
        }
        // Elementos para registro auxiliar
        const inputFieldRegistro = document.getElementById('registro_auxiliar');
        const warningMessageRegistro = document.getElementById('warning-message-registro-auxiliar');
        handleWarning(inputFieldRegistro, warningMessageRegistro, 10); // Límite de 10 caracteres
        // Elementos para expediente administrativo
        const inputFieldExpAdm = document.getElementById('exp_adm');
        const warningMessageExpAdm = document.getElementById('warning-message-exp-adm');
        handleWarning(inputFieldExpAdm, warningMessageExpAdm, 10); // Límite de 10 caracteres
        // Elementos para identificación del caso
        const inputFieldIdentificacionCaso = document.getElementById('identificacion_caso');
        const warningMessageIdentificacionCaso = document.getElementById('warning-message-identificacion-caso');
        handleWarning(inputFieldIdentificacionCaso, warningMessageIdentificacionCaso,
            255); // Límite de 255 caracteres (ajustar según necesites)
        // Elementos para apertura inicial
        const inputFieldApertura = document.getElementById('apertura_inicial');
        const warningMessageApertura = document.getElementById('warning-message-apertura-inicial');
        handleWarning(inputFieldApertura, warningMessageApertura,
            255); // Límite de 255 caracteres (ajustar según necesites)
    </script>
@stop
