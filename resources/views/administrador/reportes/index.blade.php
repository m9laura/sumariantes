@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">GRÁFICO SUMARIOS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <!-- Controles para seleccionar el tipo de gráfico -->
                                <div class="form-group">
                                    <label for="periodo-personas">SELECCIONA EL PERÍODO PARA SUMARIOS:</label>
                                    <select id="periodo-personas" onchange="updateChart('personas')">
                                        <option value="dia">Día</option>
                                        <option value="semana">Semana</option>
                                        <option value="mes">Mes</option>
                                        <option value="año">Año</option>
                                    </select>
                                </div>
                                {{-- ID PERSONA --}}
                                <canvas id="chart-personas"
                                    style="min-height: 250px; height: 250px;
                             max-height: 250px; max-width: 100%; display: block; width: 551px;"
                                    height="500" width="1102" class="chartjs-render-monitor"></canvas>
                               
                            </div>
                        </div>
                    </div>


                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <h3 class="card-title">GRÁFICO ESTADISTICO CASOS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            {{-- VALORES   --}}
                            <div class="form-group">
                                <label for="periodo-casos">SELECCIONA EL PERÍODO PARA CASOS:</label>
                                <select id="periodo-casos" onchange="updateChart('casos')">
                                    <option value="dia">Día</option>
                                    <option value="semana">Semana</option>
                                    <option value="mes">Mes</option>
                                    <option value="año">Año</option> <!-- Añade esta opción -->
                                </select>
                            </div>
                         
                            {{-- ID caso --}}
                             <canvas id="chart-casos"
                                style="min-height: 250px; height:
                     250px; max-height: 250px; max-width: 100%; display: block; width: 423px;"
                                width="846" height="500" class="chartjs-render-monitor"></canvas> 
                           
                        </div>
                    </div>
                </div>
                {{-- OFF OTRO --}}
                <div class="col-md-6">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">GRÁFICO ESTADISTICO CASOS CONCLUIDOS E INCONCLUSO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="periodo-estado-casos">SELECCIONA EL PERÍODO PARA ESTADO DE CASOS:</label>
                                    <select id="periodo-estado-casos" onchange="updateChart('estado-casos')">
                                        class="form-control">
                                        <option value="dia">Día</option>
                                        <option value="semana">Semana</option>
                                        <option value="mes">Mes</option>
                                        <option value="año">Año</option>
                                    </select>
                                </div>
                                {{-- <canvas id="chart-estado-casos" width="800" height="400"></canvas> --}}
                                <canvas id="chart-estado-casos"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 412px;"
                                    width="515" height="312" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- SEPARACION <<,,>>>>>>>>>>>>> --}}
                     {{-- <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 517px;"
                                        width="1034" height="500" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>

                        </div>  --}}
                </div>

            </div>

        </div>

    </section>
@stop
{{-- <canvas id="registrosdiarios"> </canvas> --}}
@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    {{-- DATATABLEy sus ralaciones 2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

@stop

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap 4 JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- ChartJS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AdminLTE JS desde CDN (si está disponible) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes (si está disponible) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/demo.js"></script>
    <!-- Script específico de la página -->

    {{-- DATATABLE y sus ralaciones 1 --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxPersonas = document.getElementById('chart-personas').getContext('2d');
            const ctxCasos = document.getElementById('chart-casos').getContext('2d');
            const ctxEstadoCasos = document.getElementById('chart-estado-casos').getContext('2d');

            // Obtener datos desde el backend
            const datos = {
                personas: {
                    dia: {
                        labels: @json($resultadosPorDiaPersona->pluck('fecha')),
                        data: @json($resultadosPorDiaPersona->pluck('total'))
                    },
                    semana: {
                        labels: @json($resultadosPorSemanaPersona->pluck('semana')),
                        data: @json($resultadosPorSemanaPersona->pluck('total'))
                    },
                    mes: {
                        labels: @json($resultadosPorMesPersona->pluck('fecha')),
                        data: @json($resultadosPorMesPersona->pluck('total'))
                    },
                    año: {
                        labels: @json($resultadosPorAnioPersona->pluck('año')),
                        data: @json($resultadosPorAnioPersona->pluck('total'))
                    }
                },
                casos: {
                    dia: {
                        labels: @json($resultadosPorDiaCaso->pluck('fecha')),
                        data: @json($resultadosPorDiaCaso->pluck('total'))
                    },
                    semana: {
                        labels: @json($resultadosPorSemanaCaso->pluck('semana')),
                        data: @json($resultadosPorSemanaCaso->pluck('total'))
                    },
                    mes: {
                        labels: @json($resultadosPorMesCaso->pluck('fecha')),
                        data: @json($resultadosPorMesCaso->pluck('total'))
                    },
                    año: { // Datos por año para casos
                        labels: @json($resultadosPorAnioCaso->pluck('año')),
                        data: @json($resultadosPorAnioCaso->pluck('total'))
                    }
                },
                estadoCasos: {
                    dia: {
                        labels: @json($resultadosPorDiaCasoConEstado->pluck('fecha')),
                        dataConcluido: @json(collect($resultadosPorDiaCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Concluido';
                                })->pluck('total')),
                        dataInconcluso: @json(collect($resultadosPorDiaCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Inconcluso';
                                })->pluck('total'))
                    },
                    semana: {
                        labels: @json($resultadosPorSemanaCasoConEstado->pluck('semana')),
                        dataConcluido: @json(collect($resultadosPorSemanaCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Concluido';
                                })->pluck('total')),
                        dataInconcluso: @json(collect($resultadosPorSemanaCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Inconcluso';
                                })->pluck('total'))
                    },
                    mes: {
                        labels: @json($resultadosPorMesCasoConEstado->pluck('fecha')),
                        dataConcluido: @json(collect($resultadosPorMesCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Concluido';
                                })->pluck('total')),
                        dataInconcluso: @json(collect($resultadosPorMesCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Inconcluso';
                                })->pluck('total'))
                    },
                    año: { // Agregado para datos por año del estado de casos
                        labels: @json($resultadosPorAnioCasoConEstado->pluck('año')),
                        dataConcluido: @json(collect($resultadosPorAnioCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Concluido';
                                })->pluck('total')),
                        dataInconcluso: @json(collect($resultadosPorAnioCasoConEstado)->filter(function ($item) {
                                    return $item['estado'] === 'Inconcluso';
                                })->pluck('total'))
                    }
                }
            };

            // Función para crear un gráfico de barras
            function createChart(ctx, labels, data, label) {
                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: data,
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Periodo'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Total'
                                }
                            }
                        }
                    }
                });
            }

            // Función para crear un gráfico de barras con múltiples conjuntos de datos (estado de casos)
            function createEstadoCasosChart(ctx, labels, dataConcluido, dataInconcluso) {
                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Concluido',
                            data: dataConcluido,
                            backgroundColor: 'rgba(76,175,80,0.9)',
                            borderColor: 'rgba(76,175,80,0.8)',
                            borderWidth: 1
                        }, {
                            label: 'Inconcluso',
                            data: dataInconcluso,
                            backgroundColor: 'rgba(255,87,34,0.9)',
                            borderColor: 'rgba(255,87,34,0.8)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Periodo'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Total'
                                }
                            }
                        }
                    }
                });
            }

            // Inicializar gráficos con datos por día
            let chartPersonas = createChart(ctxPersonas, datos.personas.dia.labels, datos.personas.dia.data,
                'Total Personas');
            let chartCasos = createChart(ctxCasos, datos.casos.dia.labels, datos.casos.dia.data, 'Total Casos');
            let chartEstadoCasos = createEstadoCasosChart(ctxEstadoCasos, datos.estadoCasos.dia.labels, datos
                .estadoCasos.dia.dataConcluido, datos.estadoCasos.dia.dataInconcluso);

            // Función para actualizar los gráficos según el periodo seleccionado
            window.updateChart = function(tipo) {
                const periodo = document.getElementById(`periodo-${tipo}`).value;

                if (tipo === 'personas') {
                    chartPersonas.destroy();
                    chartPersonas = createChart(ctxPersonas, datos.personas[periodo].labels, datos.personas[
                        periodo].data, 'Total Personas');
                } else if (tipo === 'casos') {
                    chartCasos.destroy();
                    chartCasos = createChart(ctxCasos, datos.casos[periodo].labels, datos.casos[periodo].data,
                        'Total Casos');
                } else if (tipo === 'estado-casos') {
                    chartEstadoCasos.destroy();
                    chartEstadoCasos = createEstadoCasosChart(ctxEstadoCasos, datos.estadoCasos[periodo].labels,
                        datos.estadoCasos[periodo].dataConcluido, datos.estadoCasos[periodo].dataInconcluso);
                }
            };
        });
    </script>



@stop
