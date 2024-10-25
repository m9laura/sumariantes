    @extends('adminlte::page')

    @section('title', 'Dapersona')

    @section('content_header')

    @stop

    @section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('caso_personas.store') }}" method="POST" id="casoPersonaForm">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="personas" class="form-label">Seleccionar Personas</label>
                        <select multiple id="personas" name="persona_id[]" class="form-control select2" required>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}">{{ $persona->nombre }} - {{ $persona->ci }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="personaSearch" class="form-control mt-2" placeholder="Buscar por CI o Nombre" />
                        <ul id="personaResults" class="list-group mt-2" style="display:none;"></ul>
                    </div>

                    <div class="form-group mb-3">
                        <label for="casos" class="form-label">Seleccionar Casos</label>
                        <select multiple id="casos" name="caso_id[]" class="form-control select2" required>
                            @foreach ($casos as $caso)
                                <option value="{{ $caso->id }}">{{ $caso->exp_adm }} - {{ $caso->registro_auxiliar }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="casoSearch" class="form-control mt-2" placeholder="Buscar por Exp. Adm o Registro Auxiliar" />
                        <ul id="casoResults" class="list-group mt-2" style="display:none;"></ul>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Asignar Personas a Caso</button>
                </form>
            </div>
        </div>
    </div>
    @stop
    @section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 5px rgba(111, 66, 193, 0.5);
            transition: box-shadow 0.3s ease;
        }

        .select2-container--bootstrap4 .select2-selection--multiple {
            border: 1px solid #6f42c1;
            transition: border-color 0.3s ease;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            background-color: #6f42c1;
            color: #fff;
            border-radius: 3px;
            padding: 3px;
            margin: 3px;
            transition: background-color 0.3s ease;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice:hover {
            background-color: #5a2d91;
        }

        .list-group {
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }

        .list-group-item {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group-item.selected {
            background-color: #6f42c1;
            color: white;
            border-radius: 5px;
        }

        .fade-out {
            animation: fadeOut 0.3s forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                height: 0;
                padding: 0;
                margin: 0;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                placeholder: "Seleccione",
                allowClear: true
            });

            // Búsqueda de personas
            $('#personaSearch').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('caso_personas.searchPersonas') }}",
                    method: "GET",
                    data: { persona: query },
                    success: function(data) {
                        $('#personaResults').empty();
                        if (data.length > 0) {
                            $.each(data, function(index, persona) {
                                $('#personaResults').append(`<li class="list-group-item persona-item" data-id="${persona.id}">${persona.ci} - ${persona.nombre}</li>`);
                            });
                            $('#personaResults').show();
                        } else {
                            $('#personaResults').hide();
                        }
                    }
                });
            });

            // Seleccionar una persona de los resultados
            $(document).on('click', '.persona-item', function() {
                let id = $(this).data('id');
                let optionExists = $(`#personas option[value="${id}"]`).length;

                if (!optionExists) {
                    let option = `<option value="${id}">${$(this).text()}</option>`;
                    $('#personas').append(option).trigger('change');
                    $(this).addClass('selected');
                }

                $('#personaResults').empty().hide();
                $('#personaSearch').val('');
            });

            // Búsqueda de casos
            $('#casoSearch').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('caso_personas.searchCasos') }}",
                    method: "GET",
                    data: { caso: query },
                    success: function(data) {
                        $('#casoResults').empty();
                        if (data.length > 0) {
                            $.each(data, function(index, caso) {
                                $('#casoResults').append(`<li class="list-group-item caso-item" data-id="${caso.id}">Exp. Adm: ${caso.exp_adm} - Registro Auxiliar: ${caso.registro_auxiliar}</li>`);
                            });
                            $('#casoResults').show();
                        } else {
                            $('#casoResults').hide();
                        }
                    }
                });
            });

            // Seleccionar o eliminar un caso de los resultados
            $(document).on('click', '.caso-item', function() {
                let id = $(this).data('id');
                let optionExists = $(`#casos option[value="${id}"]`).length;

                if (optionExists) {
                    $(`#casos option[value="${id}"]`).remove().trigger('change');
                    $(this).addClass('fade-out');
                } else {
                    let option = `<option value="${id}">${$(this).text()}</option>`;
                    $('#casos').append(option).trigger('change');
                    $(this).addClass('selected');
                }

                setTimeout(() => {
                    $('#casoResults').empty().hide();
                    $('#casoSearch').val('');
                }, 300);
            });
        });
    </script>
@stop