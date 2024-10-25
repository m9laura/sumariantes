@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')

@stop

@section('content')

<div class="container">
   
@stop
@section('css')
   <!-- CSS de Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
   <style>
       .container {
           max-width: 600px; /* Ancho máximo del contenedor */
           margin: 20px auto; /* Centra el contenedor */
           padding: 20px; /* Espaciado interno */
           border-radius: 8px; /* Bordes redondeados */
           box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Sombra sutil */
           background-color: #f8f9fa; /* Fondo gris claro */
       }

       .form-group {
           margin-bottom: 1.5rem; /* Espaciado inferior entre grupos de formulario */
       }

       label {
           font-weight: bold; /* Negrita para las etiquetas */
       }

       .form-control, .select2-container {
           border-radius: 0.25rem; /* Bordes redondeados */
           box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Sombra interna */
       }

       .select2-container--default .select2-selection--single {
           height: calc(2.25rem + 2px); /* Altura del select */
           border: 1px solid #ced4da; /* Borde */
           border-radius: 0.25rem; /* Bordes redondeados */
           display: flex; /* Flexbox para centrar contenido */
           align-items: center; /* Centrar verticalmente el contenido */
           background-color: #ffffff; /* Color de fondo por defecto */
       }

       .select2-container--default .select2-selection--single .select2-selection__rendered {
           line-height: 2.25; /* Alinear verticalmente el texto */
           color: #495057; /* Color del texto por defecto */
       }

       .select2-container--default .select2-selection--single.select2-selection--focused {
           background-color: #e0f7fa; /* Color de fondo cuando está seleccionado */
           border-color: #008cba; /* Color del borde cuando está seleccionado */
       }

       /* Estilo para el texto seleccionado */
       .select2-container--default .select2-selection--single.select2-selection--focused .select2-selection__rendered {
           color: #00695c; /* Cambia el color del texto a un verde oscuro */
           font-weight: bold; /* Negrita */
       }

       /* Estilo para el menú desplegable de opciones */
       .select2-results__option--highlighted {
           background-color: #007bff; /* Color de fondo al pasar el mouse */
           color: white; /* Color del texto */
       }

       /* Ajustes para el spinner */
       #loading-spinner {
           text-align: center; /* Centrar el spinner */
           margin-top: 20px; /* Espaciado superior */
       }

       .btn-success {
           width: 100%; /* Botón de ancho completo */
           padding: 12px; /* Espaciado interno para el botón */
           font-size: 16px; /* Tamaño de fuente del botón */
           border-radius: 5px; /* Bordes redondeados para el botón */
           transition: background-color 0.3s; /* Transición suave para el color de fondo */
       }

       .btn-success:hover {
           background-color: #218838; /* Color al pasar el mouse */
           opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
       }
   </style>
@stop

@section('js')
   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <!-- Bootstrap JS Bundle -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Select2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
   <script>
    $(document).ready(function() {
        // Inicializa Select2 en modo múltiple
        $('#persona_id').select2({
            placeholder: "Seleccione una o más personas",
            allowClear: true
        });

        $('#sancion_id').select2({
            placeholder: "Seleccione una o más sanciones",
            allowClear: true
        });

        // Búsqueda de persona
        $('#buscar_persona').on('input', function() {
            const query = $(this).val().toLowerCase();
            $('#persona_id option').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(query));
            });
            $('#persona_id').select2('open'); // Abre el menú desplegable para mostrar resultados
        });

        // Búsqueda de sanción
        $('#buscar_sancion').on('input', function() {
            const query = $(this).val().toLowerCase();
            $('#sancion_id option').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(query));
            });
            $('#sancion_id').select2('open'); // Abre el menú desplegable para mostrar resultados
        });
    });
</script>
    
@stop

