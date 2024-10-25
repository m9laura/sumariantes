

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{--COMPLETAR --}}
{{--  --}}
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Editar sanciones para {{ $Sancionpersonas->persona->nombre }}
        </div>
        <div class="card-body">
            <!-- Mostrar mensajes de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario para editar la sanción actual -->
            <form action="{{ route('sancion_personas.update', $Sancionpersonas->id) }}" method="POST" class="form-editar">
                @csrf
                @method('PUT')

                <!-- Campos para editar la sanción actual -->
                <div class="form-group">
                    <label for="sancion_id">Sanción:</label>
                    <select name="sancion_id" id="sancion_id" class="form-control">
                        @foreach ($sanciones as $sancion)
                            <option value="{{ $sancion->id }}" {{ $Sancionpersonas->sancion_id == $sancion->id ? 'selected' : '' }}>
                                {{ $sancion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de la sanción:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $Sancionpersonas->fecha }}">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

            <!-- Formulario para añadir una nueva sanción -->
            <h4 class="mt-4">Añadir nueva sanción:</h4>
            <form action="{{ route('sancion_personas.addSancion', $Sancionpersonas->id) }}" method="POST" class="form-anadir">
                @csrf
                <div class="form-group">
                    <label for="sancion_id">Sanción:</label>
                    <select name="sancion_id" id="sancion_id" class="form-control">
                        @foreach ($sanciones as $sancion)
                            <option value="{{ $sancion->id }}">{{ $sancion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de la nueva sanción:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Añadir Sanción</button>
            </form>

            <!-- Mostrar todas las sanciones de la persona -->
            <h4 class="mt-4">Sanciones previas de {{ $Sancionpersonas->persona->nombre }}:</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de la Sanción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sancionesPersona as $sancion)
                            <tr>
                                <td>{{ $sancion->sancion->nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($sancion->fecha)->format('d-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('sancion_personas.destroy', $sancion->id) }}" method="POST" class="form-eliminar d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire('¡Éxito!', '{{ session('success') }}', 'success');
        @endif

        // Manejo de la confirmación para eliminar
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Está seguro?',
                text: '¡El dato se eliminará!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // Manejo de confirmaciones para formularios de añadir y editar
        $('.form-anadir').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¡Sanción Añadida!',
                text: 'La sanción se ha añadido correctamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                this.submit();
            });
        });

        $('.form-editar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¡Sanción Actualizada!',
                text: 'La sanción se ha actualizado correctamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                this.submit();
            });
        });
    });
</script>
@stop
