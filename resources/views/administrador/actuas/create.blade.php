@extends('adminlte::page')

@section('title', 'Crear Actuados')

@section('content_header')
    <h1 class="text-center" style="font-family: 'Times New Roman', serif;">Crear Solicitud </h1>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-lg-8 col-md-10 col-sm-12 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- form start -->
            <form action="{{ route('actuas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-3">
                    <div class="col-12 col-md-6 mb-3">
                        {{-- nombre --}}
                        <label for="nombre" class="form-label">Nombre de la Solicitud</label>
                        <textarea class="form-control" id="nombre" name="nombre" rows="3" placeholder="Ingrese el nombre"
                            pattern="^[A-Za-z0-9\-\/áéíóúÁÉÍÓÚñÑ]+$"
                            title="Solo se permiten letras (incluyendo acentuadas), números, guiones y barras sin espacios" required>{{ old('nombre') }}</textarea>
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        {{-- fecha --}}
                        <label for="fecha" class="form-label">Fecha de Registro de la Solicitud</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}"
                            required min="2018-01-01">
                        @error('fecha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                   <!-- DESCRIPCION -->
                   <div class="form-group mb-3">
                    <label for="descripcion" class="form-label">Descripción de la Solicitud</label>
                    <textarea id="summernote" class="form-control" name="descripcion" placeholder="Ingrese una descripción" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    {{-- PDF --}}
                    <label for="documentos" class="form-label">Seleccionar archivo PDF:</label>
                    <input type="file" name="documentos" class="form-control" id="documentos" accept=".pdf">
                    @error('documentos')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary d-none" id="previewBtn" data-toggle="modal"
                    data-target="#pdfPreviewModal">
                    Ver Vista Previa del PDF
                </button>
                <!-- Modal para la Vista Previa del PDF -->
                <div class="modal fade" id="pdfPreviewModal" tabindex="-1" role="dialog"
                    aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pdfPreviewModalLabel">Vista Previa del Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Documento:</label>
                                    <iframe id="pdf-frame" style="width: 100%; height: 400px; border: none;"></iframe>
                                    <!-- Ajustada la altura -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Guardar Solicitud
                    </button>
                </div>
            </form> <!-- Cierre del formulario -->
        </div>
    </div>
@stop
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
    <style>
        /* Estilo para mejorar la responsividad */
        @media (max-width: 768px) {
            .form-row {
                display: flex;
                flex-direction: column;
            }
        }

        /* Asegurarse de que el iframe sea responsivo */
        #pdf-frame {
            width: 100%;
            height: calc(100vh - 200px);
            /* Ajustar la altura para que no exceda el viewport */
        }

        /* Mejorar el modal en dispositivos pequeños */
        @media (max-width: 576px) {
            .modal-dialog {
                max-width: 100%;
                /* Asegurarse de que el modal ocupe el 90% del ancho en móviles */
                margin: 0;
                /* Sin margen */
            }
        }

        /* Efectos de transformación para los botones */
        .btn {
            transition: transform 0.2s, background-color 0.2s;
            /* Transiciones suaves */
        }

        .btn:hover {
            transform: scale(1.05);
            /* Crecimiento ligero al pasar el mouse */
        }
    </style>
@stop
@section('js')
    <!-- Script para mostrar la vista previa del PDF -->
    <script>
        $(document).ready(function() {
            // Habilitar el botón de vista previa solo si se selecciona un PDF
            $('#documentos').change(function() {
                const file = this.files[0];
                if (file && file.type === 'application/pdf') {
                    const fileURL = URL.createObjectURL(file);
                    $('#pdf-frame').attr('src', fileURL);
                    $('#pdfPreviewModal').modal('show'); // Mostrar el modal con la vista previa
                    $('#previewBtn').removeClass('d-none'); // Mostrar el botón para volver a ver el modal
                } else {
                    $('#previewBtn').addClass('d-none'); // Ocultar el botón si no es un PDF
                }
            });

            // Abrir el modal al hacer clic en el botón
            $('#previewBtn').click(function() {
                $('#pdfPreviewModal').modal('show');
            });
        });
    </script>
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
                    var clipboardData = (e.originalEvent || e).clipboardData || window.clipboardData;
                    var pastedData = clipboardData.getData('Text'); // Extraer solo texto
    
                    // Limpiar espacios adicionales y etiquetas HTML si las hubiera
                    var cleanText = pastedData.replace(/<\/?[^>]+(>|$)/g, "").trim();
                    cleanText = cleanText.replace(/\s+/g, ' '); // Reemplaza múltiples espacios por uno solo
    
                    // Insertar el texto limpio en el editor de Summernote
                    $('#summernote').summernote('pasteHTML', cleanText);
                }
            }
        });
    
        // Procesar el contenido del textarea antes de enviar el formulario
        $('form').on('submit', function(e) {
            var descripcion = $('#summernote').val();
            // Eliminar etiquetas HTML
            descripcion = descripcion.replace(/<\/?[^>]+(>|$)/g, "");
            // Eliminar espacios en blanco al inicio y al final
            descripcion = descripcion.trim();
            // Reemplazar múltiples espacios en blanco por uno solo
            descripcion = descripcion.replace(/\s+/g, ' '); 
    
            // Verificar si la descripción tiene contenido
            console.log('Descripción limpia antes de enviar:', descripcion);
    
            if (descripcion === '') {
                e.preventDefault(); // Prevenir el envío si está vacía
                alert('Por favor, ingrese una descripción válida.'); // Mostrar mensaje al usuario
            } else {
                $('#summernote').val(descripcion); // Establecer el valor limpio en el textarea
            }
        });
    });
    </script>
    
  
@stop
