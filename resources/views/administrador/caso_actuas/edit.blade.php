@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('modificar al tipo de caso:') }}&nbsp;{{ ucfirst($actua->nombre) }}</h1>
        </div>
    </div>
@stop

@section('content')


    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body card-body col-md-9 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos y no
                        olvide subir la foto.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('actuas.update', $actua) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')


                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del tipo de mensaje</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $actua->nombre) }}"
                        pattern="^(?!.*([A-Za-záéíóúüñÑ])\1{3})[A-Za-záéíóúüñÑ\s\d¡!¿?]+"
                        title="Solo se permiten letras y espacios, sin repetir 4 veces seguidas">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

               

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Contenido del mensaje</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="summernote" class="form-control" name="descripcion"
                        placeholder="Ingrese el contenido del tipo de mensaje">{{ old('descripcion', $actua->descripcion) }}</textarea>
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- estado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado del tipo de mensaje</label>
                    <select class="form-control" name="estado">
                        <option value="1" @if (old('estado', $actua->estado) == '1') selected @endif>activo</option>
                        <option value="0" @if (old('estado', $actua->estado) == '0') selected @endif>inactivo</option>
                    </select>
                    @error('estado')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 {{-- tipo --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Tipo </label>
                    <select class="form-control" name="tipo">
                        <option value="1" @if (old('tipo', $actua->tipo) == '1') selected @endif>DOCUMENTO
                        </option>
                        <option value="2" @if (old('tipo', $actua->tipo) == '2') selected @endif>IMAGENES
                        </option>
                        <option value="3" @if (old('tipo', $actua->tipo) == '3') selected @endif>VIDEOS
                        </option>
                        <option value="4" @if (old('tipo', $actua->tipo) == '4') selected @endif>AUDIOS
                        </option>
                       
                       
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>




                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar Actuados
                    </button>
                </div>
            </form>

        </div>
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
