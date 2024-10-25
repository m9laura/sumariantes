@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body text-center">
            <h1 class="font-weight-bold" style="text-transform: uppercase;">Formulario para agregar una sanción</h1>
        </div>
    </div>
@stop

@section('content')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body col-md-6 mx-auto">
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

        <form method="POST" action="{{ route('sancions.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Nombre --}}
            <div class="form-group">
                <label for="nombre">Nombre de la sanción</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
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
                    placeholder="Ingrese el contenido de la sanción">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha --}}
            <div class="form-group">
                <label for="fecha">Fecha de registro</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                @error('fecha')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus"></i> Agregar sanción
                </button>
            </div>
        </form>
    </div>
</div>

@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'clear']],
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
