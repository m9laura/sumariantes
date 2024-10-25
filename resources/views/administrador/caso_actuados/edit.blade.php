@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            {{-- <h1>{{ ucfirst('modificar al tipo de caso:') }}&nbsp;{{ ucfirst($actua->nombre) }}</h1> --}}
        </div>
    </div>
@stop

@section('content')
<div class="container">
    <h1>Editar Caso Actuado</h1>

    <form action="{{ route('caso_actuados.update', $caso_actuado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Select para Casos -->
        <div class="form-group">
            <label for="caso_id">Seleccionar Caso</label>
            <select name="caso_id" id="caso_id" class="form-control" required>
                @foreach($casos as $caso)
                    <option value="{{ $caso->id }}" {{ $caso_actuado->caso_id == $caso->id ? 'selected' : '' }}>
                        {{ $caso->identificacion_caso }} <!-- Ajusta el campo que se mostrará según lo que prefieras -->
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select para Actuas -->
        <div class="form-group">
            <label for="actua_id">Seleccionar Actuado</label>
            <select name="actua_id" id="actua_id" class="form-control" required>
                @foreach($actuas as $actua)
                    <option value="{{ $actua->id }}" {{ $caso_actuado->actua_id == $actua->id ? 'selected' : '' }}>
                        {{ $actua->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo para Fecha -->
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $caso_actuado->fecha }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
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
                    //['fontname', ['fontname']],
                    ['para', ['ul']],
                    //['insert', ['link']],
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
