@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<form action="{{ route('tipo_casos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label>
        <select class="form-control" name="estado" id="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="gravedad">Gravedad:</label>
        <select class="form-control" name="gravedad" id="gravedad" required>
            <option value="1">Económico</option>
            <option value="2">Días de impedimento</option>
            <option value="3">Destitución</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')
 
@stop
