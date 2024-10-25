@extends('adminlte::page')

@section('title', 'Resultados de la búsqueda')

@section('content_header')
    <h1 style="font-family: 'Times New Roman', Times, serif;">Resultados de la Búsqueda</h1>
@endsection

@section('content')
    <div class="container">
        @if ($noResults)
            <div class="alert alert-warning">
                No se encontraron resultados.
            </div>
        @else
            <div class="table-responsive" style="font-family: 'Times New Roman', Times, serif;">
                <table id="resultados-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            @if ($results->first() instanceof \App\Models\Persona)
                            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('sumario') }}</h1>
                            <div class="card" style="font-family: 'Times New Roman', Times, serif;">
                                <div class="card-body">
                                    <table class="table" id="persona">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Apellido Paterno</th>
                                                <th scope="col">Apellido Materno</th>
                                                <th scope="col">WhatsApp</th>
                                                <th scope="col">CI</th>
                                                <th scope="col">Institucion</th>
                                                
                                                @if (auth()->user()->can('busquedas.show') ||
                                                        auth()->user()->can('busquedas.pdf') )
                                                    <th scope="col">Acción</th>
                                                @endif 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $result)
                                                <tr >
                                                    <th scope="row">{{ $result->id }}</th>
                                                    <td>{{ ucfirst($result->nombre) }}</td>
                                                    <td>{{ ucfirst($result->apellidop) }}</td>
                                                    <td>{{ ucfirst($result->apellidom) }}</td>
                                                    <td>{{ ucfirst($result->whatsapp) }}</td>
                                                    <td>{{ ucfirst($result->ci) }}</td>
                                                    <td>{{ ucfirst($result->institucion) }}</td>
                                                    @if (auth()->user()->can('busquedas.show') ||
                                                        auth()->user()->can('busquedas.pdf') )
                                                        <td> 
                                                         
                        
                                                                {{-- @can('busquedas.show')
                                                                    <a class="btn btn-primary btn-sm" href="{{ route('busquedas.show', $result) }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endcan --}}
                        
                                                                @can('busquedas.pdf')
                                                                    <a class="btn btn-primary btn-sm" href="{{ route('busquedas.pdf', $result) }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endcan
        
                                                        </td> 
                                                     @endif
                                                </tr>
                                            @endforeach
                        
                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @elseif ($results->first() instanceof \App\Models\Caso)
                                <th>Exp. Adm</th>
                                <th>Estado del Proceso</th>
                            @elseif ($results->first() instanceof \App\Models\TipoCaso)
                                <th>Nombre</th>
                                <th>Descripción</th>
                            @elseif ($results->first() instanceof \App\Models\Actua)
                                <th>Nombre</th>
                                <th>Descripción</th>
                            @endif
                        </tr>
                    </thead>
                   
                </table>
            </div>
        @endif
    </div>
@endsection

@section('css')
    <!-- Aquí puedes agregar estilos adicionales si los necesitas -->
    {{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('js')
    {{-- <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#resultados-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script> --}}
    {{-- DATATABLE y sus ralaciones 1 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> {{-- esto hace que se amas para celular  --}}
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    {{-- esto cambia el idioma de ingles a español --}}
    <script>
        $('#persona').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página_PAGE_de_PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
@endsection
