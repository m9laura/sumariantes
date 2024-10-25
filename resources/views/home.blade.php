@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Box 1 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      
                    </a>
                    <!-- Overlay de actualización -->
                    <div class="overlay dark" id="loading-overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- Box 2 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      
                    </a>
                    <!-- Overlay de actualización -->
                    <div class="overlay dark" id="loading-overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- Box 3 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                       
                    </a>
                    <!-- Overlay de actualización -->
                    <div class="overlay dark" id="loading-overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- Box 4 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                        <h3>44</h3>
                        <p>Casos Reportados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      
                    </a>
                    <!-- Overlay de actualización -->
                    <div class="overlay dark" id="loading-overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@stop
@section('content')
<!-- Primer Bloque (Bienvenida y Detalles del Usuario) -->
<div class="card" style="position: relative; color: white;">
    <div style="background-image: url('{{ asset('storage/imagenes/gamea_logo.png') }}'); 
                 background-size: contain; /* Mantiene la relación de aspecto sin estirar */
                 background-position: center; /* Centra la imagen */
                 height: 65vh; /* Ajusta la altura del contenedor */
                 width: 100%; /* Asegura que el contenedor ocupe todo el ancho */
                 background-repeat: no-repeat; /* Evita que la imagen se repita */
                 position: absolute; 
                 top: 0; left: 0; right: 0; bottom: 0;">
    </div>
    <div class="card-body" style="position: relative; font-family: 'Times New Roman', Times, serif; background: rgba(0, 0, 0, 0.5);">
        <div class="row">
            <div class="col-md-12 text-center">
                <strong>
                    @if (auth()->user()->genero == 1)
                        <h1 style="text-transform: uppercase; font-weight: bold;">Bienvenido señor {{ auth()->user()->name }} {{ auth()->user()->apellidopaterno }}</h1>
                    @else
                        <h1 style="text-transform: uppercase; font-weight: bold;">Bienvenida señorita {{ auth()->user()->name }} {{ auth()->user()->apellidopaterno }}</h1>
                    @endif
                </strong>
            </div>

            <div class="col-md-3 text-center">
                <img src="{{ Storage::url(auth()->user()->foto) }}" alt="Foto de usuario" class="img-fluid rounded">
                <br><br>
                <a class="btn btn-success btn-block" data-toggle="modal" data-target="#cambiarContrasenaModal"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                <br><br>
                <a class="btn btn-success btn-block" data-toggle="modal" data-target="#manualModal"><i class="fas fa-book"></i> Ver Manual</a>
            </div>

            <div class="col-md-6">
                <ul>
                    <h5 class="text-center" style="text-transform: uppercase;"><b>Usuario</b></h5>
                    <li><b>Nombre:</b> {{ ucfirst(auth()->user()->name) }}</li>
                    <li><b>Apellido paterno:</b> {{ ucfirst(auth()->user()->apellidopaterno) }}</li>
                    <li><b>Apellido materno:</b> {{ ucfirst(auth()->user()->apellidomaterno) }}</li>
                    <li><b>Documento de identidad:</b> {{ auth()->user()->ci }} {{ auth()->user()->expedito }}</li>
                    <li><b>Estado laboral:</b> {{ auth()->user()->estado == 1 ? 'Trabajando' : 'No trabajado' }}</li>
                    <li><b>Género:</b> {{ auth()->user()->genero == 1 ? 'Masculino' : 'Femenino' }}</li>
                    <li><b>Unidad:</b> {{ ucfirst(auth()->user()->unidad) }}</li>
                    <li><b>Cargo:</b> {{ ucfirst(auth()->user()->cargo) }}</li>
                    <li class="mt-0">
                        <b>Role:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst(auth()->user()->roles->first()->name) }}
                    </li>
                    <li><b>Fecha de nacimiento:</b> {{ auth()->user()->fnacimiento }}</li>
                    <li><b>Fecha de inicio:</b> {{ auth()->user()->finicio }}</li>
                    @if (auth()->user()->estado == 0)
                        <li><b>Fecha de suspensión:</b> {{ auth()->user()->fsuspension }}</li>
                    @endif
                </ul>
            </div>

            <div class="col-md-3 text-center">
                <h5 class="text-center" style="text-transform: uppercase;"><b>Acciones</b></h5>
                @can('roles.index')
                    <a class="btn btn-outline-danger btn-sm btn-block" href="{{ route('roles.index') }}"><i class="fas fa-eye"></i> Listar Roles</a>
                @endcan
                @can('users.index')
                    <a class="btn btn-outline-warning btn-sm btn-block" href="{{ route('admin.users.index') }}"><i class="fas fa-eye"></i> Listar Usuarios</a>
                @endcan
                @can('personas.index')
                    <a class="btn btn-outline-info btn-sm btn-block" href="{{ route('personas.index') }}"><i class="fas fa-eye"></i> Listar Personas</a>
                @endcan
                @can('tipo_personas.index')
                    <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('tipo_personas.index') }}"><i class="fas fa-eye"></i> Listar Tipos Personas</a>
                @endcan
            </div>
        </div>
    </div>
</div>


<!-- Modales -->
<!-- Modal para cambiar contraseña -->
<div class="modal fade" id="cambiarContrasenaModal" tabindex="-1" role="dialog" aria-labelledby="cambiarContrasenaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarContrasenaModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cambiarContrasenaForm" action="{{ route('homes.update', ['home' => auth()->user()->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Contraseña Anterior</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para ver manual -->
<div class="modal fade" id="manualModal" tabindex="-1" role="dialog" aria-labelledby="manualModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualModalLabel">Manual de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="path-to-your-manual.pdf" type="application/pdf" width="100%" height="600px" />
            </div>
        </div>
    </div>
</div>

    @stop

    @section('css')
   <!-- CSS de FullCalendar -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">

   <!-- FontAwesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

   <style>
       /* Estilos personalizados para el calendario */
       .fc-toolbar {
           background-color: #1E90FF; /* Color de fondo para la barra de herramientas */
           color: white; /* Color del texto */
       }

       .fc-header-toolbar h2 {
           font-size: 1rem; /* Tamaño del título del mes */
       }

       .fc-day-header {
           background-color: #FF6347; /* Color de fondo para los encabezados de los días */
           color: white; /* Color del texto en los encabezados de los días */
           font-size: 0.75rem; /* Tamaño reducido para los días de la semana */
           padding: 5px; /* Espacio alrededor del texto en los encabezados */
       }

       .fc-daygrid-day-number {
           font-size: 0.7rem; /* Tamaño reducido para los números del calendario */
           padding: 2px; /* Espacio alrededor de los números */
       }

       .fc-toolbar button {
           font-size: 0.7rem; /* Tamaño reducido para los botones del calendario */
           padding: 2px 5px;  /* Reducir tamaño de los botones */
       }

       .fc-event {
           background-color: #FF6347 !important; /* Color de fondo para eventos */
           border-color: #FF6347 !important; /* Color del borde para eventos */
           font-size: 0.7rem; /* Tamaño reducido para los eventos dentro del calendario */
           line-height: 1.2; /* Ajustar altura de línea para eventos */
       }

       .fc-today {
           background-color: #ADD8E6 !important; /* Color para el día actual */
       }

       /* Ajustar el tamaño del calendario */
       #calendar {
           max-height: 100px; /* Limitar altura total del calendario */
           overflow-y: hidden; /* Eliminar scroll vertical */
       }

       /* Reducir el tamaño de las celdas del calendario */
       .fc-daygrid-day {
           padding: 5px; /* Reducir padding de las celdas */
           height: 10px; /* Altura de las celdas */
           width: 10px;  /* Ancho de las celdas */
       }
   </style>
    @stop

    @section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
        
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es', // Configuración para idioma español
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialView: 'dayGridMonth',
                    editable: true,
                    droppable: true
                });
        
                calendar.render();
            });
        </script>
        <script>
            function startLoading() {
                // Mostrar el overlay
                document.getElementById("loading-overlay").style.display = "block";

                // Simular actualización de datos (por ejemplo, 3 segundos)
                setTimeout(function() {
                    // Ocultar el overlay cuando la actualización termine
                    document.getElementById("loading-overlay").style.display = "none";
                }, 3000); // Puedes ajustar este tiempo según tu necesidad
            }

            // Llama a startLoading cuando quieras iniciar la actualización de datos
            startLoading(); // Esta línea es solo un ejemplo, llámala cuando inicie el proceso real

            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    editable: true, // Permite editar eventos
                    events: [{
                            title: 'Evento de prueba',
                            start: '2024-10-01', // Ajusta la fecha
                            end: '2024-10-02' // Ajusta la fecha
                        },
                        {
                            title: 'Otro evento',
                            start: '2024-10-07',
                            allDay: true
                        }
                    ]
                });
            });

            // Mensajes de advertencia para los estados de sesión
            @if (session('guardar') == 'ok')
                Swal.fire(
                    'Lo sentimos, la contraseña anterior no coincide',
                    'No se pudo modificar la contraseña.',
                    'error'
                );
            @endif

            @if (session('error') == 'ok')
                Swal.fire(
                    'Lo sentimos, la nueva contraseña coincide',
                    'No se pudo modificar la contraseña.',
                    'error'
                );
            @endif

            @if (session('editar') == 'ok')
                Swal.fire(
                    'Perfecto!',
                    'Su contraseña ha sido modificada.',
                    'success'
                );
            @endif
        </script>
    @stop
