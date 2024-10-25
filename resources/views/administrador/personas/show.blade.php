@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <!-- Encabezado con estilo y fuente -->
            <h1 class="text-uppercase font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">
                <i class="fas fa-user"></i> Datos del sumariado: {{ $persona->nombre }} {{ $persona->apellidop }}
                ci:{{ $persona->ci }}
            </h1>

            <!-- Espaciado para los botones, usando d-flex y justify-content-center para alinearlos al centro -->
            <div class="d-flex justify-content-center mt-4">

                <!-- Botón Mostrar Sanción -->
                <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#sancionModal">
                    <i class="fas fa-gavel"></i> Mostrar Sanción
                </button>

                <!-- Botón Mostrar Casos -->
                <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#casosModal">
                    <i class="fas fa-briefcase"></i> Mostrar Casos
                </button>

                <!-- Botón Mostrar tipo de Sumarios Gestión -->
                <button type="button" class="btn btn-warning mx-2" data-toggle="modal" data-target="#sumariosgestionModal">
                    <i class="fas fa-cogs"></i> Mostrar tipo de Sumariado por Gestión
                </button>

            </div>
        </div>
    </div>

@stop
@section('content')
    <div class='card'>
        <div class="row container d-flex justify-content-center align-items-center py-5"
            style="font-family: 'Times New Roman', Times, serif;">
            <div class="col-12 col-md-6 col-lg-6 mb-3 text-center">
                <!-- Card que contiene la foto -->
                <div class="card card-widget widget-user">
                    <!-- Header de la card con fondo personalizado -->
                    <div class="widget-user-header text-white"
                        style="background: rgba(0, 0, 0, 0.85) url('{{ Storage::url($persona->foto) }}') center center; background-size: cover;">
                        <!-- Nombre y cargo -->
                        <h1 class="text-uppercase font-weight-bold"
                            style="font-family: 'Times New Roman', Times, serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); margin-bottom: 10px;">
                            <i class="fas fa-user"></i> sumariado: {{ $persona->nombre }} {{ $persona->apellidop }}
                        </h1>
                    </div>

                    <!-- Imagen del usuario con bordes redondeados -->
                    <div class="widget-user-image mb-3">
                        <img class="img-circle shadow-lg" src="{{ Storage::url($persona->foto) }}"
                            alt="Foto de {{ $persona->nombre }}"
                            style="width: 110px; height: 110px; object-fit: cover; border: 3px solid #121212; box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);">
                    </div>

                    <!-- Footer para detalles adicionales -->
                    <!-- Footer para detalles adicionales -->
                    <div class="card-footer p-2 bg-light border-0 rounded-bottom">
                        <div class="row justify-content-center">
                            <!-- Casos Involucrados -->
                            <div class="col-4 col-md-3 text-center mb-3 mb-md-0"
                                onclick="startLoading('Casos Involucrados')">
                                <div class="knob-container">
                                    <canvas width="90" height="90"></canvas>
                                    <input type="text" class="knob" value="{{ $persona->casos->count() }}"
                                        data-width="80" data-height="80" data-fgcolor="#3c8dbc"
                                        style="border: 0px; background: none; font: bold 16px Arial; text-align: center; color: #3c8dbc; appearance: none;"
                                        readonly>
                                </div>
                                <div class="knob-label">
                                    <span class="font-weight-bold">Casos Involucrados</span>
                                </div>
                            </div>

                            <!-- Sanciones Puestas -->
                            <div class="col-4 col-md-3 text-center mb-3 mb-md-0"
                                onclick="startLoading('Sanciones Puestas')">
                                <div class="knob-container">
                                    <canvas width="90" height="90"></canvas>
                                    <input type="text" class="knob" value="{{ $persona->sancionpersonas->count() }}"
                                        data-width="80" data-height="80" data-fgcolor="#f39c12"
                                        style="border: 0px; background: none; font: bold 16px Arial; text-align: center; color: #f39c12; appearance: none;"
                                        readonly>
                                </div>
                                <div class="knob-label">
                                    <span class="font-weight-bold">Sanciones Puestas</span>
                                </div>
                            </div>

                            <!-- Tipos de Persona -->
                            <div class="col-4 col-md-3 text-center mb-3 mb-md-0"
                                onclick="startLoading('Cargos Efectuados')">
                                <div class="knob-container">
                                    <canvas width="90" height="90"></canvas>
                                    <input type="text" class="knob" value="{{ $persona->tipoPersonas->count() }}"
                                        data-width="80" data-height="80" data-fgcolor="#28a745"
                                        style="border: 0px; background: none; font: bold 16px Arial; text-align: center; color: #28a745; appearance: none;"
                                        readonly>
                                </div>
                                <div class="knob-label">
                                    <span class="font-weight-bold">Cargos Efectuados</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Overlay de actualización -->
                    <div class="overlay dark" id="loading-overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- Columna de la información -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="info-box p-4 shadow-lg rounded">
                    <ul class="list-unstyled">
                        <h5 class="text-center mt-0 text-uppercase text-primary"><b>DETALLE DEL SUMARIADO</b></h5>
                        <li><b>Tipos de personas:</b>
                            @foreach ($persona->tipoPersonas as $tipo_persona)
                                {{ ucfirst($tipo_persona->nombre) }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </li>
                        <li><b>Nombre:</b> {{ ucfirst($persona->nombre) }}</li>
                        @if ($persona->apellidop)
                            <li><b>Apellido paterno:</b> {{ ucfirst($persona->apellidop) }}</li>
                        @endif
                        @if ($persona->apellidom)
                            <li><b>Apellido materno:</b> {{ ucfirst($persona->apellidom) }}</li>
                        @endif
                        @if ($persona->ci)
                            <li><b>Celula de identidad:</b> {{ ucfirst($persona->ci) }}</li>
                        @endif
                        <li><b>Nacionalidad:</b> {{ ucfirst($persona->nacionalidad) }}</li>
                        <li><b>Género:</b> {{ $persona->genero == 1 ? 'Masculino' : 'Femenino' }}</li>
                        @if ($persona->unidad)
                            <li><b>Unidad:</b> {{ ucfirst($persona->unidad) }}</li>
                        @endif
                        @if ($persona->cargo)
                            <li><b>Cargo:</b> {{ ucfirst($persona->cargo) }}</li>
                        @endif
                        @if ($persona->institucion)
                            <li><b>Institución:</b> {{ ucfirst($persona->institucion) }}</li>
                        @endif
                        @if ($persona->carrera)
                            <li><b>Carrera:</b> {{ ucfirst($persona->carrera) }}</li>
                        @endif
                        @if ($persona->sede)
                            <li><b>Sede:</b> {{ ucfirst($persona->sede) }}</li>
                        @endif
                        @if ($persona->domicilioreal)
                            <li><b>Domicilio Real:</b>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($persona->domicilioreal) }}"
                                    target="_blank">
                                    {{ ucfirst($persona->domicilioreal) }}
                                </a>
                            </li>
                        @endif
                        @if ($persona->domicilioconvencional)
                            <li><b>Domicilio Convencional:</b>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($persona->domicilioconvencional) }}"
                                    target="_blank">
                                    {{ ucfirst($persona->domicilioconvencional) }}
                                </a>
                            </li>
                        @endif
                        @if ($persona->domiciliolegal)
                            <li><b>Domicilio Legal:</b>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($persona->domiciliolegal) }}"
                                    target="_blank">
                                    {{ ucfirst($persona->domiciliolegal) }}
                                </a>
                            </li>
                        @endif

                        <li><b>Correo Electrónico:</b> {{ $persona->gmail }}</li>
                        <li><b>Fecha de Registro:</b> {{ $persona->fecha }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- Modales para los detalles --}}->
    <!-- Modal para mostrar los detalles de los casos -->
    <div class="modal fade" id="casosModal" tabindex="-1" role="dialog" aria-labelledby="casosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document"> <!-- Modal pequeño -->
            <div class="modal-content border-info shadow-sm rounded">
                <!-- Encabezado del Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="casosModalLabel">
                        <i class="fas fa-gavel"></i> Detalles de los Casos <!-- Ícono de casos -->
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body p-3" style="background: #f9f9f9;">
                    @if ($persona->casos->isNotEmpty())
                        @foreach ($persona->casos as $caso)
                            <!-- Detalle del caso -->
                            <div class="caso-detalle mb-3 p-3 border border-light rounded shadow-sm">
                                <!-- Expediente Administrativo -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-primary">
                                        <i class="fas fa-file-alt"></i> Expediente Administrativo:
                                    </h6>
                                    <p class="mb-2 text-uppercase font-weight-bold"
                                        style="background-color: #e2f3ff; padding: 8px; border-radius: 5px; border: 1px solid #b0d4f1;">
                                        {{ $caso->exp_adm }}
                                </div>
                                <!-- Registro Auxiliar -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-info">
                                        <i class="fas fa-list-alt"></i> Registro Auxiliar:
                                    </h6>
                                    <p class="mb-2 text-muted"
                                        style="background-color: #e2f3ff; padding: 8px; border-radius: 5px; border: 1px solid #b0d4f1;">
                                        {{ $caso->registro_auxiliar }}
                                </div>
                                <!-- Identificación del Caso -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-warning">
                                        <i class="fas fa-id-card"></i> Identificación del Caso:
                                    </h6>
                                    <p class="text-dark">{{ $caso->identificacion_caso }}</p>
                                </div>
                                <!-- MAE -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-success">
                                        <i class="fas fa-users"></i> MAE:
                                    </h6>
                                    <!-- Enlace elegante para ver documento MAE -->
                                    <a href="{{ Storage::url($caso->mae) }}" target="_blank"
                                        class="text-decoration-none d-inline-flex align-items-center"
                                        style="color: #007bff; font-size: 16px; transition: color 0.3s ease-in-out;">
                                        <!-- Icono del documento (se puede cambiar el ícono a otro si lo prefieres) -->
                                        <i class="fas fa-file-alt mr-2" style="font-size: 18px;"></i>
                                        <!-- Texto del enlace -->
                                        <span class="font-weight-bold">Ver documento MAE</span>
                                    </a>
                                </div>
                                <!-- Apertura Inicial -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-danger">
                                        <i class="fas fa-calendar-check"></i> Apertura Inicial:
                                    </h6>
                                    <p class="text-dark">{{ $caso->apertura_inicial }}</p>
                                </div>

                                {{-- <!-- Estado del Proceso -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-primary">
                                        <i class="fas fa-exclamation-triangle"></i> Estado del Proceso:
                                    </h6>
                                    <p class="text-dark">{{ $caso->estado_proceso }}</p>
                                </div> --}}
                                <!-- Fecha creado el caso -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-success">
                                        <i class="fas fa-calendar-day"></i> Fecha:
                                    </h6>
                                    <p class="text-dark">{{ $caso->fecha }}</p>
                                </div>
                                <!-- Fecha  caso asigando ap persona-->
                                <!-- Fecha de Asignación -->
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-success">
                                        <i class="fas fa-calendar-day"></i> Fecha de Asignación:
                                    </h6>
                                    <!-- Accedemos a la fecha de la tabla pivote usando $caso->pivot->fecha -->
                                    <p class="text-dark">
                                        {{ $caso->pivot->fecha ? \Carbon\Carbon::parse($caso->pivot->fecha)->format('d/m/Y') : 'No asignada' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No hay casos registrados para esta persona.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- sanciones-->
    <!-- Modal Structure -->
    <div class="modal fade" id="sancionModal" tabindex="-1" role="dialog" aria-labelledby="sancionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document"> <!-- Modal pequeño -->
            <div class="modal-content border-info shadow-sm rounded">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="sancionModalLabel">
                        <i class="fas fa-gavel"></i> Detalles de las Sanciones <!-- Icono de la sanción -->
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4" style="background: #f9f9f9; border-radius: 10px;"> <!-- Fondo suave -->
                    @if ($persona->sancionpersonas->isNotEmpty())
                        @foreach ($persona->sancionpersonas as $sancionPersona)
                            <div class="sancion-detalle mb-3 p-3 border border-light rounded shadow-sm">
                                <h6 class="font-weight-bold text-primary">
                                    <i class="fas fa-user"></i> Nombre: <!-- Icono de usuario -->
                                </h6>
                                <p class="mb-2 text-uppercase font-weight-bold">{{ $sancionPersona->nombre }}</p>

                                <h6 class="font-weight-bold text-info">
                                    <i class="fas fa-file-alt"></i> Descripción: <!-- Icono de archivo -->
                                </h6>
                                <p class="mb-2 text-muted">{{ $sancionPersona->descripcion }}</p>

                                <h6 class="font-weight-bold text-success">
                                    <i class="fas fa-calendar-day"></i> Fecha de la sanción: <!-- Icono de calendario -->
                                </h6>
                                <p class="mb-2 text-dark">{{ $sancionPersona->fecha }}</p>

                                <h6 class="font-weight-bold text-warning">
                                    <i class="fas fa-calendar-check"></i> Fecha de asignación:
                                    <!-- Icono de fecha de asignación -->
                                </h6>
                                <p class="text-dark">{{ $sancionPersona->pivot->fecha }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No hay sanciones asociadas a esta persona.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para Tipos de Persona por Gestión -->
    <div class="modal fade" id="sumariosgestionModal" tabindex="-1" role="dialog"
        aria-labelledby="sumariosgestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document"> <!-- Modal pequeño -->
            <div class="modal-content border-info shadow-lg rounded">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="sumariosgestionModalLabel">
                        <i class="fas fa-users-cog"></i> Tipos de Persona por Gestión
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4" style="background: #f4f4f4;">
                    @if ($persona->tipoPersonas->isNotEmpty())
                        @foreach ($persona->tipoPersonas as $tipoPersona)
                            <div class="tipo-persona-detalle mb-4 p-4 border border-light rounded-lg shadow-sm bg-white">

                                <!-- Icono y nombre del tipo de persona -->
                                <div class="d-flex align-items-center mb-3">
                                    {{-- <div class="tipo-persona-icon bg-cover" style="background-image: url('{{ asset('images/' . strtolower(str_replace(' ', '_', $tipoPersona->nombre)) . '.png') }}'); width: 50px; height: 50px; background-position: center; background-size: cover; border-radius: 50%; border: 2px solid #ddd;"></div> --}}
                                    <div class="ml-3">
                                        <h6 class="font-weight-bold text-primary mb-1" style="font-size: 1.1rem;">
                                            {{ $tipoPersona->nombre }}</h6>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;"><i
                                                class="fas fa-briefcase"></i> <strong>Cargo:</strong>
                                            {{ $tipoPersona->descripcion }}</p>
                                    </div>
                                </div>

                                <!-- Información sobre la fecha de asignación -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-weight-bold text-success mb-2" style="font-size: 0.9rem;">
                                            <i class="fas fa-calendar-check"></i> Fecha de Asignación
                                        </h6>
                                        <p class="mb-0 text-dark" style="font-size: 0.85rem;">
                                            {{ \Carbon\Carbon::parse($tipoPersona->pivot->fecha)->format('d/m/Y') }}</p>
                                    </div>

                                    <!-- Icono distintivo según el tipo de persona -->
                                    <div class="ml-2">
                                        @switch($tipoPersona->nombre)
                                            @case('Abogado')
                                                <i class="fas fa-gavel fa-lg text-primary"></i>
                                            @break

                                            @case('Fiscal')
                                                <i class="fas fa-balance-scale fa-lg text-success"></i>
                                            @break

                                            @case('Defensor')
                                                <i class="fas fa-user-shield fa-lg text-danger"></i>
                                            @break

                                            @default
                                                <i class="fas fa-id-card fa-lg text-info"></i>
                                        @endswitch
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No hay tipos de personas asociados a esta persona.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <!-- Bootstrap CSS (si no lo has agregado aún) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1VytCvhf+YwcmZy/5KZZO4DguVnsfMz9t1nIO" crossorigin="anonymous">

    <style>
        /* Estilos generales para el cuerpo */
        body {
            background-color: #f8f9fa;
        }


        /* Estilos personalizados para las imágenes */
        .custom-img {
            max-width: 100%;
            height: auto;
            border-width: 5px;
            border-color: #343a40;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        /* Hover en imágenes */
        .custom-img:hover {
            transform: scale(1.05);
            /* Aumenta ligeramente el tamaño al pasar el cursor */
        }

        /* Estilos para los íconos dentro de la modal */
        .modal-body i {
            font-size: 1.3rem;
            /* Tamaño del ícono */
        }

        /* Títulos de cada campo en la modal */
        .modal-body h6 {
            font-size: 1.1rem;
            /* Tamaño ligeramente mayor */
            color: #2c3e50;
            /* Color gris oscuro */
        }

        /* Detalles del caso */
        .caso-detalle {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        /* Caja de información con borde */
        .info-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        /* Modal content */
        .modal-content {
            border-radius: 8px;
        }

        /* Detalles de sanción o tipo de persona */
        .sancion-detalle,
        .tipo-persona-detalle {
            background-color: #f1f3f5;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
@stop

@section('js')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Efecto de animación al hacer scroll
        document.addEventListener("scroll", function() {
            var elements = document.querySelectorAll(".info-box, .custom-img");
            elements.forEach(function(element) {
                var elementPosition = element.getBoundingClientRect().top;
                var screenPosition = window.innerHeight / 1.3;

                if (elementPosition < screenPosition) {
                    element.classList.add("animate");
                }
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery y jQuery Knob -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

    <script>
        $(function() {
            $(".knob").knob({
                'min': 0,
                'max': 100,
                'angleArc': 250,
                'angleOffset': -125,
                'readOnly': true,
                'lineCap': 'round',
                'displayInput': true,
                'thickness': 0.2, // Ajusta el grosor de la aguja del knob
                'rotation': 'clockwise',
            });
        });
    </script>

<!-- JavaScript para el overlay y la función de actualización -->
<script>
    function startLoading(label) {
        // Mostrar el overlay
        document.getElementById("loading-overlay").style.display = "block";

        // Mostrar un mensaje en la consola o hacer algo específico con el label si es necesario
        console.log('Actualizando:', label);

        // Simular actualización de datos (por ejemplo, 3 segundos)
        setTimeout(function() {
            // Ocultar el overlay cuando la actualización termine
            document.getElementById("loading-overlay").style.display = "none";
            alert(label + ' actualizados');
        }, 3000); // Puedes ajustar este tiempo según tu necesidad
    }
</script>

@stop
