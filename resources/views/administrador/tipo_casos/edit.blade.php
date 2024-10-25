@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop
@section('content')
   <!-- Formulario para editar un tipo de caso -->
   <form action="{{ route('tipo_casos.update', $tipoCaso->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Método PUT para actualizar el recurso -->

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $tipoCaso->nombre) }}" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" name="descripcion" id="descripcion" required>{{ old('descripcion', $tipoCaso->descripcion) }}</textarea>
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label>
        <select class="form-control" name="estado" id="estado">
            <option value="1" {{ old('estado', $tipoCaso->estado) == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('estado', $tipoCaso->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="gravedad">Gravedad:</label>
        <select class="form-control" name="gravedad" id="gravedad" required>
            <option value="1" {{ old('gravedad', $tipoCaso->gravedad) == 1 ? 'selected' : '' }}>Económico</option>
            <option value="2" {{ old('gravedad', $tipoCaso->gravedad) == 2 ? 'selected' : '' }}>Días de impedimento</option>
            <option value="3" {{ old('gravedad', $tipoCaso->gravedad) == 3 ? 'selected' : '' }}>Destitución</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('tipo_casos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')
 
@stop
