@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>
                <h1>
                    {{ ucfirst('Modificar a la persona:') }}{{ ucfirst($persona->nombre) }}
                    {{ ucfirst($persona->apellidop) }}- Cédula de Identidad: {{ ucfirst($persona->ci) }}
                    {{ ucfirst($persona->expedido) }}
                </h1>
            </h1>
        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <br>
        <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">Formulario de edicion</h4>
        <div class="card-body col-md-9 mx-auto">
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
            <form method="POST" action="{{ route('personas.update', $persona) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')
                <div class="form-row">
                    {{-- nombre --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="nombre">Nombre del Sumariado</label>
                        <input type="text" class="form-control" name="nombre"
                            value="{{ old('nombre', $persona->nombre) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios" required>
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- apellidop --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="apellidop">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellidop"
                            value="{{ old('apellidop', $persona->apellidop) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        @error('apellidop')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- apellidom --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="apellidom">Apellido materno</label>
                        <input type="text" class="form-control" name="apellidom"
                            value="{{ old('apellidom', $persona->apellidom) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios" required>
                        @error('apellidom')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- genero --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="genero">Género</label>
                        <select class="form-control" name="genero" required>
                            <option value="1" @if (old('genero', $persona->genero) == '1') selected @endif>Masculino</option>
                            <option value="0" @if (old('genero', $persona->genero) == '0') selected @endif>Femenino</option>
                        </select>
                        @error('genero')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- cédula de identidad --}}
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="ci">Cédula de Identidad</label>
                        <input type="text" class="form-control" name="ci" value="{{ old('ci', $persona->ci) }}"
                            pattern="^[0-9]+$" title="Solo se permiten números">
                        @error('ci')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- expedido --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="expedido">Expedido (lugar)</label>
                        <select class="form-control" name="expedido" required>
                            <option value="LP" @if (old('expedido', $persona->expedido) == 'LP') selected @endif>La Paz</option>
                            <option value="SC" @if (old('expedido', $persona->expedido) == 'SC') selected @endif>Santa Cruz</option>
                            <option value="CB" @if (old('expedido', $persona->expedido) == 'CB') selected @endif>Cochabamba</option>
                            <option value="OR" @if (old('expedido', $persona->expedido) == 'OR') selected @endif>Oruro</option>
                            <option value="PT" @if (old('expedido', $persona->expedido) == 'PT') selected @endif>Potosí</option>
                            <option value="TJ" @if (old('expedido', $persona->expedido) == 'TJ') selected @endif>Tarija</option>
                            <option value="CH" @if (old('expedido', $persona->expedido) == 'CH') selected @endif>Chuquisaca</option>
                            <option value="BE" @if (old('expedido', $persona->expedido) == 'BE') selected @endif>Beni</option>
                            <option value="PD" @if (old('expedido', $persona->expedido) == 'PD') selected @endif>Pando</option>
                        </select>
                        @error('expedido')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- extencion --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="extension">Extensión de la Cédula</label>
                        <input type="text" class="form-control" name="extension"
                            value="{{ old('extension', $persona->extension) }}" pattern="^[A-Z0-9]+$"
                            title="Solo se permiten números y letras mayúsculas">
                        @error('extension')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- institucion --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="institucion">Institución del Sumariado</label>
                        <input type="text" class="form-control" name="institucion"
                            value="{{ old('institucion', $persona->institucion) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios" required>
                        @error('institucion')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- cargo --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="cargo">Cargo del Sumariado</label>
                        <input type="text" class="form-control" name="cargo"
                            value="{{ old('cargo', $persona->cargo) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios" required>
                        @error('cargo')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- whatsapp --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                            value="{{ old('whatsapp', $persona->whatsapp) }}" pattern="^[0-9]+$"
                            title="Solo se permiten números" required>
                        @error('whatsapp')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                    </div>
                    {{-- unidad --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="unidad">Unidad del Sumariado</label>
                        <input type="text" class="form-control" name="unidad"
                            value="{{ old('unidad', $persona->unidad) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios" required>
                        @error('unidad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="nacionalidad">Nacionalidad</label>
                        <input type="text" class="form-control" name="nacionalidad"
                            value="{{ old('nacionalidad', $persona->nacionalidad) }}"
                            pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$" title="Solo se permiten letras y espacios" required>
                        @error('nacionalidad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- sede --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="domicilioreal">Domicilio Real</label>
                        <input type="text" class="form-control" name="domicilioreal"
                            value="{{ old('domicilioreal', $persona->domicilioreal) }}"
                            placeholder="Ingrese su domicilio real" pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones" required>
                        @error('domicilioreal')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="domiciliolegal">Domicilio Legal</label>
                        <input type="text" class="form-control" name="domiciliolegal"
                            value="{{ old('domiciliolegal', $persona->domiciliolegal) }}"
                            placeholder="Ingrese su domicilio legal" pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones" required>
                        @error('domiciliolegal')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="domicilioconvencional">Domicilio Convencional</label>
                        <input type="text" class="form-control" name="domicilioconvencional"
                            value="{{ old('domicilioconvencional', $persona->domicilioconvencional) }}"
                            placeholder="Ingrese su domicilio convencional" pattern="^[A-Za-z0-9\s,.-]+$"
                            title="Solo se permiten letras, números y caracteres como comas, puntos y guiones" required>
                        @error('domicilioconvencional')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="gmail">Correo Electrónico</label>
                        <input type="email" class="form-control" name="gmail"
                            value="{{ old('gmail', $persona->gmail) }}" placeholder="Ingrese el correo electrónico"
                            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                            title="Ingrese un correo electrónico válido" required>
                        @error('gmail')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label style="text-align: center;" for="tipo_persona_ids">Tipos de Sumarios:</label>
                        <select multiple="multiple" size="10" name="tipo_persona_ids[]" title="tipo_persona_ids[]">
                            @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                                <option value="{{ $tipo_personaId }}"
                                    @if (old('tipo_persona_ids') && in_array($tipo_personaId, old('tipo_persona_ids'))) selected
                                @elseif (isset($persona) && $persona->tipoPersonas->contains($tipo_personaId))
                                    selected @endif>
                                    {{ $tipo_personaNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_persona_ids')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label style="text-align: center;" for="sancion_ids">Sanciones:</label>
                        <select multiple="multiple" size="10" name="sancion_ids[]" id="sancion_ids"
                            class="form-control select-right">
                            @foreach ($sancions as $sancionId => $sancionNombre)
                                <option value="{{ $sancionId }}"
                                    @if (old('sancion_ids') && in_array($sancionId, old('sancion_ids'))) selected
                                @elseif (isset($persona) && in_array($sancionId, $persona->getSancionIds()))
                                    selected @endif>
                                    {{ $sancionNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('sancion_ids')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <div class="form-group">
                            <label>Foto actual del Usuario</label>
                            @if ($persona->foto)
                                <img src="{{ asset('storage/' . $persona->foto) }}" alt="Foto del usuario"
                                    style="max-width: 200px;">
                            @else
                                <p>No hay foto disponible.</p>
                            @endif
                        </div>

                        {{-- Subir una nueva foto --}}
                        <div class="form-group">
                            <label>Nueva Foto del Usuario</label>
                            <input type="file" class="form-control-file" name="foto" accept=".jpg, .jpeg, .png"
                                onchange="previewImage(event)">
                            @error('foto')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Imagen seleccionada:</label>
                            <img id="imagePreview" src="#" alt="Imagen seleccionada"
                                style="max-width: 200px; display: none;">
                        </div>

                    </div>
                    {{-- FUNCION Boton  --}}
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar Persona
                    </button>
                </div>

            </form>

        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" href="ruta/a/bootstrap-duallistbox.min.css">

    <link rel="stylesheet"
        type="text/css"href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
    <!-- Incluye los scripts necesarios para Bootstrap Dual Listbox -->
    <link rel="stylesheet" href="{{ asset('path/to/bootstrap-duallistbox.min.css') }}">
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
    <script
        src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
    </script>
    <script>
        // Inicializar Dual Listbox
        var tipo_persona_duallistbox = $('select[name="tipo_persona_ids[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Tipos de Sumarios Disponibles',
            selectedListLabel: 'Tipos de Sumarios Seleccionadas',
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
        $('.moveall').html('Mover todos <span class="badge badge-secondary"> </span>');
        $('.removeall').html('Eliminar todos <span class="badge badge-secondary"> </span>');

        // Inicializar Dual Listbox

        // Mostrar u ocultar el nuevo formulario según el estado del checkbox
        var checkbox = document.getElementById('generar-formulario');
        var nuevoFormulario = document.getElementById('nuevo-formulario');
        checkbox.addEventListener('change', function() {
            nuevoFormulario.style.display = checkbox.checked ? 'block' : 'none';
        });
    </script>

    <script>
        // Inicializar Dual Listbox para Sanciones
        var sancion_duallistbox = $('select[name="sancion_ids[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Sanciones Disponibles',
            selectedListLabel: 'Sanciones Seleccionadas',
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

        $('.moveall').html('Mover todos <span class="badge badge-secondary"> </span>');
        $('.removeall').html('Eliminar todos <span class="badge badge-secondary"> </span>');

        // Mostrar u ocultar el nuevo formulario según el estado del checkbox (ejemplo)
        var checkbox = document.getElementById('generar-formulario');
        var nuevoFormulario = document.getElementById('nuevo-formulario');
        checkbox.addEventListener('change', function() {
            nuevoFormulario.style.display = checkbox.checked ? 'block' : 'none';
        });
    </script>

@stop
