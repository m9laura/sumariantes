@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">Formulario Editar Caso </h4>
            </h1>
        </div>
    </div>
@stop
@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-9 mx-auto">
            <form action="{{ route('casos.update', $caso->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exp_adm">Expediente Administrativo:</label>
                            <input type="text" class="form-control" id="exp_adm" name="exp_adm"
                                value="{{ old('exp_adm', $caso->exp_adm) }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="registro_auxiliar">Registro Auxiliar:</label>
                            <input type="text" class="form-control" id="registro_auxiliar" name="registro_auxiliar"
                                value="{{ old('registro_auxiliar', $caso->registro_auxiliar) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <!-- Campo para Identificación del Caso con Summernote -->
                        <div class="form-group">
                            <label for="identificacion_caso">Identificación del Caso:</label>
                            <textarea id="summernote" class="form-control @error('identificacion_caso') is-invalid @enderror"
                                name="identificacion_caso" placeholder="Ingrese el contenido del tipo de caso">{{ old('identificacion_caso', $caso->identificacion_caso) }}</textarea>
                            @error('identificacion_caso')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- Campo para Apertura Inicial con Summernote -->
                        <div class="form-group">
                            <div class="form-group">
                                <label for="apertura_inicial">Apertura Inicial:</label>
                                <textarea id="apertura_inicial" class="form-control @error('apertura_inicial') is-invalid @enderror"
                                    name="apertura_inicial">{{ old('apertura_inicial', $caso->apertura_inicial) }}</textarea>
                                @error('apertura_inicial')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <!-- Campo para Apertura Inicial con Summernote -->
                            <label for="instructivo">Instructivo:</label>
                            <textarea class="form-control" id="instructivo" name="instructivo" required>{{ old('instructivo', $caso->instructivo) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <!-- Campo para Apertura Inicial con Summernote -->
                            <label for="resolucion_final">Resolución Final:</label>
                            <textarea class="form-control" id="resolucion_final" name="resolucion_final">{{ old('resolucion_final', $caso->resolucion_final) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="recurso_revocatoria">Recurso de Revocatoria:</label>
                            <textarea class="form-control" id="recurso_revocatoria" name="recurso_revocatoria">{{ old('recurso_revocatoria', $caso->recurso_revocatoria) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="recurso_jerarquico">Recurso Jerárquico:</label>
                            <textarea class="form-control" id="recurso_jerarquico" name="recurso_jerarquico">{{ old('recurso_jerarquico', $caso->recurso_jerarquico) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="antecedentes">Antecedentes:</label>
                            <textarea class="form-control" id="antecedentes" name="antecedentes">{{ old('antecedentes', $caso->antecedentes) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="estapa">Etapa:</label>
                            <select class="form-control select2" id="estapa" name="estapa" style="width: 100%;">
                                <option value="" disabled selected>Selecciona una etapa</option>
                                <option value="sumarial"
                                    {{ old('estapa', $caso->estapa) == 'sumarial' ? 'selected' : '' }}>Sumarial</option>
                                <option value="impugnacion"
                                    {{ old('estapa', $caso->estapa) == 'impugnacion' ? 'selected' : '' }}>Impugnación
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado_proceso">Estado del Proceso:</label>
                            <select class="form-control select2" id="estado_proceso" name="estado_proceso"
                                style="width: 100%;">
                                <option value="" disabled selected>Selecciona un estado</option>
                                <option value="movimiento"
                                    {{ old('estado_proceso', $caso->estado_proceso) == 'movimiento' ? 'selected' : '' }}>
                                    Movimiento</option>
                                <option value="concluido"
                                    {{ old('estado_proceso', $caso->estado_proceso) == 'concluido' ? 'selected' : '' }}>
                                    Concluido</option>
                                <option value="tramite_final"
                                    {{ old('estado_proceso', $caso->estado_proceso) == 'tramite_final' ? 'selected' : '' }}>
                                    Trámite Final</option>
                                <option value="prearchivo"
                                    {{ old('estado_proceso', $caso->estado_proceso) == 'prearchivo' ? 'selected' : '' }}>
                                    Prearchivo</option>
                            </select>
                        </div>
                        {{-- TIPO-DE-CASO --}}
                        <div class="form-group">
                            <label for="tipo_caso_id">Tipo de Caso:</label>
                            <select class="form-control" id="tipo_caso_id" name="tipo_caso_id">
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tiposCaso as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $caso->tipo_caso_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <!-- Campo Fecha de registro -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fecha">Fecha de registro</label>
                            <input type="text" class="form-control flatpickr" id="fecha" name="fecha"
                                value="{{ old('fecha', $caso->fecha ? $caso->fecha->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                    <!-- Campo Ejecutoria -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ejecutoria">Ejecutoria</label>
                            <input type="text" class="form-control flatpickr" id="ejecutoria" name="ejecutoria"
                                value="{{ old('ejecutoria', $caso->ejecutoria instanceof \Carbon\Carbon ? $caso->ejecutoria->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">MAE</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Seleccionar archivo:</label>
                                    <input type="file" class="form-control-file" name="mae" accept=".pdf"
                                        onchange="previewPDF(event, 'maePreview')">
                                    @error('mae')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>PDF seleccionado:</label>
                                        <iframe id="maePreview"
                                            style="max-width: 100%; height: 400px; display: {{ $caso->mae ? 'block' : 'none' }};"
                                            frameborder="0"
                                            src="{{ $caso->mae ? Storage::url($caso->mae) : '' }}"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Registro Digital</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Seleccionar archivo:</label>
                                    <input type="file" class="form-control-file" name="registro_aux" accept=".pdf"
                                        onchange="previewPDF(event, 'registro_auxPreview')">
                                    @error('registro_aux')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>PDF seleccionado:</label>
                                        <iframe id="registro_auxPreview"
                                            style="max-width: 100%; height: 400px; display: {{ $caso->registro_aux ? 'block' : 'none' }};"
                                            frameborder="0"
                                            src="{{ $caso->registro_aux ? Storage::url($caso->registro_aux) : '' }}"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- LISTA PERSONA A CASO  --}}
                <div class="container">
                    <div class="row">
                        <!-- Columna para Filtrar Personas -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filtro-personas">Filtrar Personas:</label>
                                <input type="text" id="filtro-personas" class="form-control"
                                    placeholder="Buscar por CI o Nombre">
                            </div>
                            <div class="form-group">
                                <label for="personas_ids">Personas Asociadas:</label>
                                <select multiple="multiple" name="personas_ids[]" id="personas_ids"
                                    title="personas_ids[]">
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}"
                                            @if ($caso->personas->contains($persona->id)) selected @endif>
                                            {{ $persona->ci }} - {{ $persona->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Columna para Filtrar Actuados -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filtro-actuados">Filtrar Actuados Solicitudes:</label>
                                <input type="text" id="filtro-actuados" class="form-control"
                                    placeholder="Buscar por Nombre">
                            </div>
                            <div class="form-group">
                                <label for="actuas_ids">ACTUADOS</label>
                                <select multiple="multiple" name="actuas_ids[]" id="actuas_ids" title="actuas_ids[]">
                                    @foreach ($actuas as $actua)
                                        <option value="{{ $actua->id }}"
                                            @if ($caso->actuas->contains($actua->id)) selected @endif>
                                            {{ $actua->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fila 8: Personas Asociadas -->
                <div class="form-row">
                    <!-- Tarjeta de Personas Asociadas -->
                    <div class="col-md-6">
                        <div class="card mb-3" style="height: 100%;">
                            <div class="card-header">
                                <h3 class="card-title">PERSONAS ASOCIADAS AL CASO</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="overflow-y: auto; max-height: 300px;">
                                @foreach ($caso->personas as $persona)
                                    @php
                                        $pivotData = $persona->pivot ?? null; // Obtener datos de la tabla pivote
                                    @endphp
                                    <div class="card bg-light mb-2">
                                        <div class="card-header">
                                            <strong>{{ $persona->nombre }} {{ $persona->apellidop }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::url($persona->foto) }}"
                                                    alt="Foto de {{ $persona->nombre }}" class="img-circle"
                                                    style="width: 50px; height: 50px;">
                                                <div class="ml-2">
                                                    <p><b>C.I.:</b> {{ $persona->ci }} {{ $persona->extension }}
                                                    </p>
                                                    <p><b>Cargo:</b> {{ $persona->cargo }}</p>
                                                    <p><b>Fecha de Nacimiento:</b> {{ $persona->fnacimiento }}</p>
                                                    <p><b>Fecha de Asociación:</b>
                                                        @if (isset($pivotData) && $pivotData->fecha)
                                                            {{ Carbon\Carbon::parse($pivotData->fecha)->format('d/m/Y') }}
                                                        @else
                                                            No disponible
                                                        @endif
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta de Actuados Asociados -->
                    <div class="col-md-6">
                        <div class="card mb-3" style="height: 100%;">
                            <div class="card-header">
                                <h3 class="card-title">ACTUADOS ASOCIADOS AL CASO</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="overflow-y: auto; max-height: 300px;">
                                @foreach ($caso->actuas as $actua)
                                    <div class="card bg-light mb-2">
                                        <div class="card-header">
                                            <strong>{{ $actua->nombre }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="ml-2">
                                                    <p><b>Descripción:</b>
                                                        {{ $actua->descripcion ?? 'No disponible' }}</p>
                                                    </p>
                                                    <p><b>Fecha de Asociación:</b>
                                                        @if (isset($pivotData) && $pivotData->fecha)
                                                            {{ Carbon\Carbon::parse($pivotData->fecha)->format('d/m/Y') }}
                                                        @else
                                                            No disponible
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center;" class="mt-3">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-save"></i> Actualizar Caso
                    </button>
                    <a href="{{ route('casos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

@stop

@section('css')
    <!-- Enlace para importar Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Arial&family=Courier+New&family=Times+New+Roman&family=Verdana&display=swap"
        rel="stylesheet">
    <!-- Incluir CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- calendadio --}}
    <!-- Incluir el CSS de Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        .form-control.flatpickr {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control.flatpickr:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        @media (max-width: 767px) {
            .form-control.flatpickr {
                font-size: 0.9rem;
                padding: 8px;
            }

            .form-group label {
                font-size: 0.9rem;
            }
        }

        @media (min-width: 768px) and (max-width: 1199px) {
            .form-control.flatpickr {
                font-size: 1rem;
                padding: 10px;
            }

            .form-group label {
                font-size: 1rem;
            }
        }

        @media (min-width: 1200px) {
            .form-control.flatpickr {
                font-size: 1.1rem;
                padding: 12px;
            }

            .form-group label {
                font-size: 1.1rem;
            }
        }
    </style>
@stop
@section('js')
    <!-- FECHA Y EJECUTORIAS-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Flatpickr para ambos campos
            function initializeFlatpickr() {
                flatpickr(".flatpickr", {
                    dateFormat: "Y-m-d", // Formato de la fecha
                    altInput: true, // Muestra una entrada de texto alternativa
                    altFormat: "F j, Y", // Formato de la fecha mostrada al usuario
                    locale: "es", // Idioma del calendario
                    disableMobile: true // Forzar el uso del calendario en dispositivos móviles
                });
            }
            // Llamar a la función de inicialización
            initializeFlatpickr();
            // Validación de ambos campos
            function validateDates() {
                let fecha = document.getElementById('fecha').value;
                let ejecutoria = document.getElementById('ejecutoria').value;
                let errors = [];
                // Definir la fecha mínima como 1 de enero de 2018
                const minDate = new Date('2018-01-01');
                // Validar la Fecha de registro
                if (!fecha) {
                    errors.push('La Fecha de registro es requerida.');
                } else if (new Date(fecha) < minDate) {
                    errors.push('La Fecha de registro no puede ser anterior al 1 de enero de 2018.');
                }
                // Validar la Ejecutoria
                if (!ejecutoria) {
                    errors.push('La Ejecutoria es requerida.');
                } else if (new Date(ejecutoria) < minDate) {
                    errors.push('La Ejecutoria no puede ser anterior al 1 de enero de 2018.');
                }
                // Si hay errores, mostrarlos y evitar el envío del formulario
                if (errors.length > 0) {
                    alert(errors.join("\n"));
                    return false;
                }
                return true; // Si no hay errores, permitir el envío del formulario
            }
            // Asociar la validación al formulario
            document.querySelector('form').addEventListener('submit', function(event) {
                if (!validateDates()) {
                    event.preventDefault(); // Evitar el envío del formulario si hay errores
                }
            });
        });
    </script>
    <!-- Incluir jQuery y Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 para ambos selects
            $('.select2').select2({
                placeholder: "Selecciona una opción",
                allowClear: true
            });
        });
    </script>
    <!-- Incluir los scripts y estilos necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
    <script>
        $(document).ready(function() {
            // Función para inicializar Summernote
            function initializeSummernote(selector) {
                $(selector).summernote({
                    tabsize: 2,
                    height: 100, // Altura del editor
                    toolbar: [
                        ['font', ['bold', 'clear']],
                        ['fontname', ['fontname']], // Añadir la selección de fuentes
                        ['fontsize', ['fontsize']], // Añadir el tamaño de fuente
                        ['color', ['color']], // Añadir color de texto y fondo
                        ['para', ['ul']], // Listas y alineación
                        ['view', ['fullscreen']], // Vista completa y vista de código
                    ],
                    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica',
                        'Impact',
                        'Tahoma', 'Times New Roman', 'Verdana'
                    ], // Fuentes disponibles
                    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36',
                        '48'
                    ] // Tamaños de fuente disponibles
                });
            }
            // Inicializar Summernote para los campos
            initializeSummernote('#summernote');
            initializeSummernote('#apertura_inicial');
            initializeSummernote('#instructivo'); // Añadir inicialización para el campo de Instructivo
            initializeSummernote('#resolucion_final'); // Ya está incluido
            initializeSummernote('#recurso_revocatoria'); // Inicializar Summernote para Recurso de Revocatoria
            initializeSummernote('#recurso_jerarquico'); // Inicializar Summernote para Recurso Jerárquico
            initializeSummernote('#antecedentes'); // Inicializar Summernote para Antecedentes
            // Función para limpiar HTML innecesario
            function cleanHTML(content) {
                var cleanedContent = content
                    .replace(/<\/?o:p>/g, '') // Eliminar etiquetas <o:p>
                    .replace(/<\/?span[^>]*>/g, '') // Eliminar etiquetas <span>
                    .replace(/<\/?p[^>]*>/g, '') // Eliminar etiquetas <p>
                    .replace(/<\/?a[^>]*>/g, '') // Eliminar etiquetas <a>
                    .replace(/<!--\[if !supportLists\]-->/g, '') // Eliminar comentarios de listas
                    .replace(/<!--\[endif\]-->/g, '') // Eliminar el final de los comentarios de listas
                    .replace(/&nbsp;/g, ' ') // Reemplazar &nbsp; por espacio normal
                    .replace(/&amp;/g, '&') // Asegurar que los caracteres especiales sean correctos
                    .replace(/\s+/g, ' ') // Reemplazar múltiples espacios por uno solo
                    .trim(); // Eliminar los espacios al principio y al final
                return cleanedContent;
            }
            // Limpiar contenido antes de enviar el formulario
            $('form').on('submit', function() {
                var summernoteContent = $('#summernote').val();
                var aperturaInicialContent = $('#apertura_inicial').val();
                var instructivoContent = $('#instructivo').val();
                var resolucionFinalContent = $('#resolucion_final').val();
                var recursoRevocatoriaContent = $('#recurso_revocatoria')
            .val(); // Obtener el contenido de Recurso de Revocatoria
                var recursoJerarquicoContent = $('#recurso_jerarquico')
            .val(); // Obtener el contenido de Recurso Jerárquico
                var antecedentesContent = $('#antecedentes').val(); // Obtener el contenido de Antecedentes
                $('#summernote').val(cleanHTML(summernoteContent));
                $('#apertura_inicial').val(cleanHTML(aperturaInicialContent));
                $('#instructivo').val(cleanHTML(instructivoContent));
                $('#resolucion_final').val(cleanHTML(resolucionFinalContent));
                $('#recurso_revocatoria').val(cleanHTML(
                recursoRevocatoriaContent)); // Limpiar el contenido de Recurso de Revocatoria
                $('#recurso_jerarquico').val(cleanHTML(
                recursoJerarquicoContent)); // Limpiar el contenido de Recurso Jerárquico
                $('#antecedentes').val(cleanHTML(
                antecedentesContent)); // Limpiar el contenido de Antecedentes
            });
        });
    </script>
    <script>
        // Función para previsualizar PDF
        function previewPDF(event, previewId) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const iframe = document.getElementById(previewId);
                iframe.src = e.target.result;
                iframe.style.display = "block";
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Inicializar Dual Listbox
            $('#personas_ids').bootstrapDualListbox({
                nonSelectedListLabel: 'Personas Disponibles',
                selectedListLabel: 'Personas Asociadas',
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

            // Filtrar personas por CI o nombre
            $('#filtro-personas').on('input', function() {
                var filter = $(this).val().toLowerCase();
                $('#personas_ids option').each(function() {
                    var optionText = $(this).text().toLowerCase();
                    $(this).toggle(optionText.includes(filter));
                });
            });
            // Inicializar Dual Listbox para Actuados
            $('#actuas_ids').bootstrapDualListbox({
                nonSelectedListLabel: 'Solicitudes',
                selectedListLabel: 'Registradas',
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

            // Filtrar actuados por nombre
            $('#filtro-actuados').on('input', function() {
                var filter = $(this).val().toLowerCase();
                $('#actuas_ids option').each(function() {
                    var optionText = $(this).text().toLowerCase();
                    $(this).toggle(optionText.includes(filter));
                });
            });
        });
    </script>

    <script>
        function previewPDF(event, previewId) {
            var file = event.target.files[0];
            var output = document.getElementById(previewId);

            if (file && file.type === 'application/pdf') {
                var fileURL = URL.createObjectURL(file);
                output.src = fileURL;
                output.style.display = 'block'; // Mostrar el iframe para la previsualización
            } else {
                output.style.display = 'none'; // Ocultar si no es un PDF válido
            }
        }
    </script>

    <!-- Dual Listbox & Preview Scripts -->
    <script>
        // Previsualizar imagen
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
    </script>
@stop
