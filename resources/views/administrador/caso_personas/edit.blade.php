@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1><h1>
              {{-- COMPLETAR  --}}
            </h1>
            </h1>
        </div>
    </div>
@stop

@section('content')

<div class="container">
    <h1>Editar Persona en Caso</h1>
    <form action="{{ route('administrador.caso_personas.update', $casoPersona->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="caso_id">Caso ID:</label>
            <input type="number" class="form-control" name="caso_id" value="{{ $casoPersona->caso_id }}" required>
        </div>
        <div class="form-group">
            <label for="persona_id">Persona ID:</label>
            <input type="number" class="form-control" name="persona_id" value="{{ $casoPersona->persona_id }}" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" name="fecha" value="{{ $casoPersona->fecha }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" type="text/css"
            href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
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

    // Mostrar u ocultar el nuevo formulario según el estado del checkbox
    var checkbox = document.getElementById('generar-formulario');
    var nuevoFormulario = document.getElementById('nuevo-formulario');
    checkbox.addEventListener('change', function() {
        nuevoFormulario.style.display = checkbox.checked ? 'block' : 'none';
    });
</script>
@stop
