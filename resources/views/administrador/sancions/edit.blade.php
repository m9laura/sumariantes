@extends('adminlte::page')

@section('title', 'Modificar Sanción')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('Modificar Sanción:') }}&nbsp;{{ ucfirst($sancion->nombre) }}</h1>
        </div>
    </div>
@stop

@section('content')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body col-md-9 mx-auto">
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

        <form method="POST" action="{{ route('sancions.update', $sancion) }}" enctype="multipart/form-data">
            @csrf {{-- evita sql inyection --}}
            @method('PUT')

            {{-- Nombre --}}
            <div class="form-group">
                <label for="nombre">Nombre de la sanción</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', $sancion->nombre) }}"
                    placeholder="Ingrese el nombre de la sanción" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                    title="Solo se permiten letras y espacios" required>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="form-group">
                <label for="descripcion">Descripción de la sanción</label>
                <textarea id="summernote" class="form-control" name="descripcion"
                    placeholder="Ingrese el contenido de la sanción" required>{{ old('descripcion', $sancion->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="form-group">
                <label for="estado">Estado de la sanción</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="" disabled selected>Seleccione un estado</option>
                    <option value="1" @if (old('estado', $sancion->estado) == '1') selected @endif>Activo</option>
                    <option value="0" @if (old('estado', $sancion->estado) == '0') selected @endif>Inactivo</option>
                </select>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha --}}
            <div class="form-group">
                <label for="fecha">Fecha de la sanción</label>
                <input type="date" class="form-control" id="fecha" name="fecha"
                    value="{{ old('fecha', $sancion->fecha) }}" required min="2018-01-01">
                @error('fecha')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Actualizar sanción
                </button>
            </div>
        </form>
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
            $('form').on('submit', function() {
                var descripcion = $('#summernote').val();
                // Eliminar todas las etiquetas HTML
                descripcion = descripcion.replace(/<\/?[^>]+(>|$)/g, "");
                // Limpiar espacios adicionales
                descripcion = descripcion.trim(); // Elimina espacios al inicio y al final
                // Reemplazar múltiples espacios en blanco con uno solo
                descripcion = descripcion.replace(/\s+/g, ' '); // Esto asegura que se guardan solo espacios simples entre palabras
                // Establecer el valor procesado de nuevo en el textarea
                $('#summernote').val(descripcion);
            });
        });
    </script>
@stop
