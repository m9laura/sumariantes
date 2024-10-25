@extends('adminlte::page')

@section('title', 'Editar Actuado')

@section('content_header')
    <h1 class="text-center" style="font-family: 'Times New Roman', serif;">
        Modificar Actuado: {{ ucfirst($actua->nombre) }}
    </h1>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-lg-8 col-md-10 col-sm-12 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('actuas.update', $actua) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 mb-3">
                        {{-- Nombre --}}
                        <label for="nombre" class="form-label">Nombre de la solicitud</label>
                        <textarea class="form-control" id="nombre" name="nombre" rows="3" placeholder="Ingrese el nombre del acta"
                            style="height: 92px;" pattern="^[A-Za-z0-9\-\/áéíóúÁÉÍÓÚñÑ]+$"
                            title="Solo se permiten letras (incluyendo acentuadas), números, guiones y barras sin espacios" required>{{ old('nombre', $actua->nombre) }}</textarea>
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        {{-- Fecha de Registro --}}
                        <label for="fecha" class="form-label">Fecha de Registro de la Solicitud</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                            value="{{ old('fecha', $actua->fecha) }}" required min="2018-01-01">
                        @error('fecha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Descripción --}}
                <div class="form-group mb-3">
                    <label for="descripcion" class="form-label">Descripción de la Solicitud</label>
                    <textarea id="summernote" class="form-control" name="descripcion" placeholder="Ingrese la descripción de la solicitud"
                        required>{{ old('descripcion', $actua->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="documentos">Seleccionar archivo PDF:</label>
                                <input type="file" class="form-control-file" name="documentos" accept=".pdf"
                                    onchange="previewPDF(event)">
                                @error('documentos')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group mt-3 d-flex justify-content-between">
                                    <div style="width: 48%;">
                                        <label>PDF Antiguo:</label>
                                        <iframe id="documentosAntiguo"
                                            style="width: 100%; height: 400px; display: {{ $actua->documentos ? 'block' : 'none' }};"
                                            frameborder="0"
                                            src="{{ $actua->documentos ? Storage::url($actua->documentos) : '' }}">
                                        </iframe>
                                    </div>
                                    <div style="width: 48%;">
                                        <label>PDF Nuevo:</label>
                                        <iframe id="documentosNuevo" style="width: 100%; height: 400px; display: none;"
                                            frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Actualizar Solicitud 
                    </button>
                </div>
            </form> <!-- Cierre del formulario -->
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css">
    <style>
        /* Estilo para mejorar la responsividad */
        @media (max-width: 768px) {
            .form-row {
                display: flex;
                flex-direction: column;
            }
        }

        /* Estilo para los iframes */
        #documentosAntiguo,
        #documentosNuevo {
            border: 1px solid #1877d6;
            border-radius: 0.25rem;
            margin-right: 10px;
        }
    </style>
@stop

@section('js')
    {{-- Script para previsualización de PDF --}}
    <script>
        function previewPDF(event) {
            const file = event.target.files[0];
            if (file && file.type === 'application/pdf') {
                const fileURL = URL.createObjectURL(file);
                document.getElementById('documentosNuevo').src = fileURL;
                document.getElementById('documentosNuevo').style.display = 'block';
                document.getElementById('documentosAntiguo').style.display = 'block';
            } else {
                alert("Por favor, seleccione un archivo PDF válido.");
            }
        }
    </script>
    {{-- Script para Summernote --}}
    {{-- Script para Summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializamos Summernote en el textarea con id "summernote"
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'clear']], // Solo permitir negrita y borrar formato
                    ['para', ['ul']], // Solo permitir listas
                    ['view', ['fullscreen']], // Permitir vista completa
                ],
                callbacks: {
                    onPaste: function(e) {
                        // Prevenir el pegado predeterminado
                        e.preventDefault();

                        // Obtener el contenido del portapapeles
                        var clipboardData = (e.originalEvent || e).clipboardData || window
                        .clipboardData;
                        var pastedData = clipboardData.getData('Text'); // Extraer solo texto

                        // Limpiar espacios adicionales y etiquetas HTML si las hubiera
                        var cleanText = pastedData.replace(/<\/?[^>]+(>|$)/g, "").trim();
                        cleanText = cleanText.replace(/\s+/g,
                        ' '); // Reemplaza múltiples espacios por uno solo

                        // Insertar el texto limpio en el editor de Summernote
                        $('#summernote').summernote('pasteHTML', cleanText);
                    }
                }
            });

            // Procesar el contenido del textarea antes de enviar el formulario
            $('form').on('submit', function() {
                var descripcion = $('#summernote').val();
                // Eliminar todas las etiquetas HTML
                descripcion = descripcion.replace(/<\/?[^>]+(>|$)/g, "");
                // Limpiar espacios adicionales
                descripcion = descripcion.trim(); // Elimina espacios al inicio y al final
                // Reemplazar múltiples espacios en blanco con uno solo
                descripcion = descripcion.replace(/\s+/g,
                ' '); // Esto asegura que se guardan solo espacios simples entre palabras
                // Establecer el valor procesado de nuevo en el textarea
                // Establecer el valor procesado de nuevo en el textarea
                $('#summernote').val(descripcion);
            });
        });
    </script>

@stop
