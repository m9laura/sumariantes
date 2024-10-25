@extends('adminlte::page')

@section('title', 'Detalles del Actuado')

@section('content_header')
    <h1 class="text-center" style="font-family: 'Georgia', serif; color: #3c8dbc; letter-spacing: 1px;">
        <i class="fas fa-file-alt"></i> Detalles de la Sanción
    </h1>
@stop

@section('content')
    <div class="card shadow-lg animated fadeInUp" style="border: none; position: relative;">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="card-title mb-0 w-100 text-center text-md-left" style="font-size: 1.5rem; font-weight: bold;">
                <i class="fas fa-file-alt"></i> {{ $actua->nombre }}
            </h3>
        </div>
        <div class="card-body" style="font-family: 'Arial', sans-serif; background: #f9f9f9;">
            <div class="row">
                <!-- Descripción -->
                <div class="col-md-6 mb-4">
                    <p><strong>Descripción:</strong></p>
                    <p class="text-muted border p-2 rounded" style="font-size: 1rem;">{{ $actua->descripcion }}</p>
                </div>

                <!-- Documentos -->
                <div class="col-md-6 mb-4">
                    <p><strong>Documentos Relacionados:</strong></p>
                    @if ($actua->documentos)
                        <embed src="{{ url('storage/' . $actua->documentos) }}" type="application/pdf" width="100%" height="400px" class="border rounded"/>
                    @else
                        <p class="text-muted">No hay documentos disponibles.</p>
                    @endif
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <!-- Fecha -->
                <div class="col-md-6 mb-4">
                    <p><strong>Fecha de Registro:</strong></p>
                    <p class="text-muted"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($actua->fecha)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Botones en la esquina inferior derecha -->
        <div class="button-group" style="position: absolute; bottom: 20px; right: 20px;">
            <a href="{{ route('actuas.edit', $actua->id) }}" class="btn btn-warning btn-custom">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('actuas.index') }}" class="btn btn-primary btn-custom">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .card {
            margin-top: 20px;
            border-radius: 12px;
            background-color: #ffffff;
        }

        .card-header {
            border-bottom: 3px solid #f0f0f0;
        }

        .btn {
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        /* Efecto de crecimiento en hover */
        .btn-custom:hover {
            transform: scale(1.1); /* Crece ligeramente al pasar el mouse */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Añade una sombra suave */
        }

        .btn-warning {
            background-color: #f0ad4e;
            color: white;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: #ec971f;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .button-group a {
            margin-left: 10px;
        }

        .card-body {
            background: linear-gradient(135deg, #e3e3e3 0%, #ffffff 100%);
        }

        hr {
            border-top: 1px solid #cccccc;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .card-header {
                text-align: center;
            }

            .card-title {
                font-size: 1.25rem;
            }

            .btn {
                width: 100%; /* Botones ocupan el 100% en pantallas pequeñas */
                margin-bottom: 10px;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('.btn-warning').on('click', function (e) {
                e.preventDefault(); // Evita que el botón redirija inmediatamente
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Quieres editar este registro",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, editarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href'); // Redirige si el usuario confirma
                    }
                });
            });

            $('.btn-primary').on('click', function (e) {
                e.preventDefault(); // Evita que el botón redirija inmediatamente
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Quieres volver a la lista de registros",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, volver!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href'); // Redirige si el usuario confirma
                    }
                });
            });
        });
    </script>
@stop
