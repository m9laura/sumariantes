@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<form action="{{ route('caso_actuas.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="caso_id">Seleccionar Caso</label>
        <select name="caso_id" id="caso_id" class="form-control" required>
            <option value="">Selecciona un caso</option>
            @foreach($casos as $caso)
                <option value="{{ $caso->id }}">{{ $caso->nombre }}</option>
            @endforeach
        </select>
    </div>
    <!-- Agrega el resto de los campos del formulario -->
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>



    <!-- Incluye Summernote y sus dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
    <!-- Agrega tu script personalizado para Summernote -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>


@stop
