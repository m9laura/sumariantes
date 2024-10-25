@extends('adminlte::page')
@section('title', 'Búsqueda Avanzada')
@section('content_header')
    <h1 style="font-family: 'Times New Roman', Times, serif;">Búsqueda Avanzada</h1>
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <h1 class="m-0 text-primary">Resultados de la Búsqueda</h1>
            <form method="GET" action="{{ route('busqueda.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search_persona" placeholder="Buscar por persona..."
                        value="{{ request()->input('search_persona') }}">
                    <input type="text" class="form-control" name="search_sancion" placeholder="Buscar por sanción..."
                        value="{{ request()->input('search_sancion') }}">
                    <input type="text" class="form-control" name="search_caso" placeholder="Buscar por caso..."
                        value="{{ request()->input('search_caso') }}">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </form>
            <!-- Tabla de Personas -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Personas</h3>
                        </div>
                        <div class="card-body">
                            <div class="dt-buttons btn-group flex-wrap mb-3">
                                <button class="btn btn-secondary buttons-copy">Copiar</button>
                                <button class="btn btn-secondary buttons-csv">CSV</button>
                                <button class="btn btn-secondary buttons-print">Imprimir</button>
                            </div>
                            <div class="table-responsive">
                                <table id="personas" class="table table-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>CI</th>
                                            <th>Tipo de Persona</th>
                                            <th>Sanciones</th>
                                            <th>Casos</th>
                                            <th>Tipo de Caso</th>
                                            <th>Actuados del Caso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($personas as $persona)
                                            <tr>
                                                <td>{{ $persona->nombre }}</td>
                                                <td>{{ $persona->apellidop }}</td>
                                                <td>{{ $persona->apellidom }}</td>
                                                <td>{{ $persona->ci }}</td>
                                                <td>
                                                    @foreach ($persona->tipoPersonas as $tipoPersona)
                                                        {{ $tipoPersona->nombre }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($persona->sancionpersonas->isNotEmpty())
                                                        @foreach ($persona->sancionpersonas as $sancionPersona)
                                                            {{ $sancionPersona->nombre ?? 'Sin sanción' }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        Sin sanción
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($persona->casos->isNotEmpty())
                                                        @foreach ($persona->casos as $caso)
                                                            {{ $caso->identificacion_caso }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        Sin casos
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($persona->casos->isNotEmpty())
                                                        @foreach ($persona->casos as $caso)
                                                            {{ $caso->tipoCaso->nombre ?? 'Sin tipo de caso' }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        Sin tipo de caso
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($persona->casos->isNotEmpty())
                                                        @foreach ($persona->casos as $caso)
                                                            @if ($caso->actuas->isNotEmpty())
                                                                @foreach ($caso->actuas as $actua)
                                                                    {{ $actua->nombre }}@if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                Sin actuados
                                                            @endif
                                                            @if (!$loop->last)
                                                                <br>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        Sin actuados
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">No se encontraron resultados para la
                                                        búsqueda de personas.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Sanciones -->
<!-- Tabla de Sanciones -->
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Sanciones</h3>
            </div>
            <div class="card-body">
                <div class="dt-buttons btn-group flex-wrap mb-3">
                    <button class="btn btn-secondary buttons-copy">Copiar</button>
                    <button class="btn btn-secondary buttons-csv">CSV</button>
                    <button class="btn btn-secondary buttons-print">Imprimir</button>
                </div>
                <div class="table-responsive">
                    <table id="sanciones" class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                                <th>Personas Asociadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sanciones as $sancion)
                                <tr>
                                    <td>{{ $sancion->nombre }}</td>
                                    <td>{{ $sancion->descripcion }}</td>
                                    <td>{{ $sancion->estado ? 'Activo' : 'Inactivo' }}</td>
                                    <td>
                                        @php
                                            $fechaCreacion = $sancion->fecha ? \Carbon\Carbon::parse($sancion->fecha) : null;
                                        @endphp
                                        {{ $fechaCreacion ? $fechaCreacion->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($sancion->sancionpersonas->isEmpty())
                                            Sin personas asociadas
                                        @else
                                            <ul>
                                                @foreach ($sancion->sancionpersonas as $sancionPersona)
                                                    <li>
                                                        Persona ID: {{ $sancionPersona->persona_id }} - 
                                                        Fecha:
                                                        @php
                                                            $fechaPersona = $sancionPersona->fecha ? \Carbon\Carbon::parse($sancionPersona->fecha) : null;
                                                        @endphp
                                                        {{ $fechaPersona ? $fechaPersona->format('d/m/Y') : 'N/A' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No se encontraron resultados para la búsqueda de sanciones.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Tabla de Casos -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Casos</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="casos" class="table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>Identificación</th>
                                                <th>Expediente</th>
                                                <th>Estado</th>
                                                <th>Tipo de Caso</th>
                                                <th>Personas Asociadas</th> <!-- Nueva columna para personas -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($casos as $caso)
                                                <tr>
                                                    <td>{{ $caso->identificacion_caso }}</td>
                                                    <td>{{ $caso->exp_adm }}</td>
                                                    <td>{{ $caso->estado ? 'Abierto' : 'Cerrado' }}</td>
                                                    <td>{{ $caso->tipoCaso->nombre ?? 'Sin tipo' }}</td>
                                                    <td>
                                                        @if ($caso->personas->isNotEmpty())
                                                            @foreach ($caso->personas as $persona)
                                                                {{ $persona->nombre }} {{ $persona->apellidop }}
                                                                {{ $persona->apellidom }}@if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            Sin personas asociadas
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No se encontraron resultados para la
                                                        búsqueda de casos.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @stop
    @section('css')
        <!-- CSS de DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">

    @stop
    @section('js')
        <!-- JS de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- JS de DataTables -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#personas').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });

                $('#sanciones').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });

                $('#casos').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es_es.json'
                    }
                });
            });
        </script>
    @stop
