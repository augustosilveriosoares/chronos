@extends('layouts.app', [
    'parentSection' => 'dashboards',
    'elementName' => 'dashboard'
])

@section('content')
    @component('layouts.headers.auth')


    @endcomponent

    <div class="container-fluid mt--6">

        {{-- Filtro de Datas--}}
        <div class="row">
            <div class="col">


                     <div class="card">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body">

                            <form method="get" action="{{route('dashboard')}}" autocomplete="off">
                                <div class="row">
                                @csrf

                            <div class="col-lg-5 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nome">{{ __('Data Inicial') }}</label>
                                    <input type="date" name="dataincial" value="{{ date('Y-m-d', strtotime($datainicial)) ?? '' }}" class="form-control"  autofocus>

                                </div>

                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nome">{{ __('Data Final') }}</label>
                                    <input type="date" name="datafinal"  value="{{ date('Y-m-d', strtotime($datafinal)) ?? '' }}" class="form-control"  autofocus>


                                </div>

                            </div>


                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success  btn-xl mt-3" style="width: 100% !important;" >{{ __('Filtrar') }}</button>

                                </div>

                            </div>

                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.headers.cards')
        {{--Gráficos--}}
        <div class="row">
            <div class="col-xl-4">
                <!--* Card header *-->
                <!--* Card body *-->
                <!--* Card init *-->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Surtitle -->

                        <!-- Title -->
                        <h5 class="h3 mb-0">Atendimento por Advogado</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-pie" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <!--* Card header *-->
                <!--* Card body *-->
                <!--* Card init *-->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Surtitle -->

                        <!-- Title -->
                        <h5 class="h3 mb-0">Atendimento por Cidade</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="atendimento-cidade" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <!--* Card header *-->
                <!--* Card body *-->
                <!--* Card init *-->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Surtitle -->

                        <!-- Title -->
                        <h5 class="h3 mb-0">Atendimento por Tipo</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="atendimento-tipo" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.headers.advogados')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>


    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>


    <script type="text/javascript">
        var Charts = (function() {

            // Variable

            var $toggle = $('[data-toggle="chart"]');
            var mode = 'light';//(themeMode) ? themeMode : 'light';
            var fonts = {
                base: 'Open Sans'
            }

            // Colors
            var colors = {
                gray: {
                    100: '#f6f9fc',
                    200: '#e9ecef',
                    300: '#dee2e6',
                    400: '#ced4da',
                    500: '#adb5bd',
                    600: '#8898aa',
                    700: '#525f7f',
                    800: '#32325d',
                    900: '#212529'
                },
                theme: {
                    'default': '#172b4d',
                    'primary': '#5e72e4',
                    'secondary': '#f4f5f7',
                    'info': '#11cdef',
                    'success': '#2dce89',
                    'danger': '#f5365c',
                    'warning': '#fb6340'
                },
                black: '#12263F',
                white: '#FFFFFF',
                transparent: 'transparent',
            };


            // Methods

            // Chart.js global options
            function chartOptions() {

                // Options
                var options = {
                    defaults: {
                        global: {
                            responsive: true,
                            maintainAspectRatio: false,
                            defaultColor: (mode == 'dark') ? colors.gray[700] : colors.gray[100],
                            defaultFontColor: (mode == 'dark') ? colors.gray[700] : colors.gray[100],
                            defaultFontFamily: fonts.base,
                            defaultFontSize: 13,
                            layout: {
                                padding: 0
                            },
                            legend: {
                                display: false,
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 16
                                }
                            },
                            elements: {
                                point: {
                                    radius: 0,
                                    backgroundColor: colors.theme['primary']
                                },
                                line: {
                                    tension: .4,
                                    borderWidth: 4,
                                    borderColor: colors.theme['primary'],
                                    backgroundColor: colors.transparent,
                                    borderCapStyle: 'rounded'
                                },
                                rectangle: {
                                    backgroundColor: colors.theme['warning']
                                },
                                arc: {
                                    backgroundColor: colors.theme['primary'],
                                    borderColor: (mode == 'dark') ? colors.gray[800] : colors.white,
                                    borderWidth: 4
                                }
                            },
                            tooltips: {
                                enabled: true,
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        doughnut: {
                            cutoutPercentage: 83,
                            legendCallback: function(chart) {
                                var data = chart.data;
                                var content = '';

                                data.labels.forEach(function(label, index) {
                                    var bgColor = data.datasets[0].backgroundColor[index];

                                    content += '<span class="chart-legend-item">';
                                    content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
                                    content += label;
                                    content += '</span>';
                                });

                                return content;
                            }
                        }
                    }
                }

                // yAxes
                Chart.scaleService.updateScaleDefaults('linear', {
                    gridLines: {
                        borderDash: [2],
                        borderDashOffset: [2],
                        color: (mode == 'dark') ? colors.gray[900] : colors.gray[300],
                        drawBorder: false,
                        drawTicks: false,
                        lineWidth: 0,
                        zeroLineWidth: 0,
                        zeroLineColor: (mode == 'dark') ? colors.gray[900] : colors.gray[300],
                        zeroLineBorderDash: [2],
                        zeroLineBorderDashOffset: [2]
                    },
                    ticks: {
                        beginAtZero: true,
                        padding: 10,
                        callback: function(value) {
                            if (!(value % 10)) {
                                return value
                            }
                        }
                    }
                });

                // xAxes
                Chart.scaleService.updateScaleDefaults('category', {
                    gridLines: {
                        drawBorder: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        padding: 20
                    },
                    maxBarThickness: 10
                });

                return options;

            }

            // Parse global options
            function parseOptions(parent, options) {
                for (var item in options) {
                    if (typeof options[item] !== 'object') {
                        parent[item] = options[item];
                    } else {
                        parseOptions(parent[item], options[item]);
                    }
                }
            }

            // Push options
            function pushOptions(parent, options) {
                for (var item in options) {
                    if (Array.isArray(options[item])) {
                        options[item].forEach(function(data) {
                            parent[item].push(data);
                        });
                    } else {
                        pushOptions(parent[item], options[item]);
                    }
                }
            }

            // Pop options
            function popOptions(parent, options) {
                for (var item in options) {
                    if (Array.isArray(options[item])) {
                        options[item].forEach(function(data) {
                            parent[item].pop();
                        });
                    } else {
                        popOptions(parent[item], options[item]);
                    }
                }
            }

            // Toggle options
            function toggleOptions(elem) {
                var options = elem.data('add');
                var $target = $(elem.data('target'));
                var $chart = $target.data('chart');

                if (elem.is(':checked')) {

                    // Add options
                    pushOptions($chart, options);

                    // Update chart
                    $chart.update();
                } else {

                    // Remove options
                    popOptions($chart, options);

                    // Update chart
                    $chart.update();
                }
            }

            // Update options
            function updateOptions(elem) {
                var options = elem.data('update');
                var $target = $(elem.data('target'));
                var $chart = $target.data('chart');

                // Parse options
                parseOptions($chart, options);

                // Toggle ticks
                toggleTicks(elem, $chart);

                // Update chart
                $chart.update();
            }

            // Toggle ticks
            function toggleTicks(elem, $chart) {

                if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
                    var prefix = elem.data('prefix') ? elem.data('prefix') : '';
                    var suffix = elem.data('suffix') ? elem.data('suffix') : '';

                    // Update ticks
                    $chart.options.scales.yAxes[0].ticks.callback = function(value) {
                        if (!(value % 10)) {
                            return prefix + value + suffix;
                        }
                    }

                    // Update tooltips
                    $chart.options.tooltips.callbacks.label = function(item, data) {
                        var label = data.datasets[item.datasetIndex].label || '';
                        var yLabel = item.yLabel;
                        var content = '';

                        if (data.datasets.length > 1) {
                            content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                        }

                        content += '<span class="popover-body-value">' + prefix + yLabel + suffix + '</span>';
                        return content;
                    }

                }
            }


            // Events

            // Parse global options
            if (window.Chart) {
                parseOptions(Chart, chartOptions());
            }

            // Toggle options
            $toggle.on({
                'change': function() {
                    var $this = $(this);

                    if ($this.is('[data-add]')) {
                        toggleOptions($this);
                    }
                },
                'click': function() {
                    var $this = $(this);

                    if ($this.is('[data-update]')) {
                        updateOptions($this);
                    }
                }
            });


            // Return

            return {
                colors: colors,
                fonts: fonts,
                mode: mode
            };

        })();
    </script>
    <script type="text/javascript">
       'use strict';

       var atendimentoAdvogadosLabel = {!! $atendimentoAdvogadosLabel !!};
       var atendimentoAdvogadosDados =  {!! $atendimentoAdvogadosDados !!};
       var atendimentoAdvogadosColor =  {!! $atendimentoAdvogadosColor !!};

       var PieChart = (function() {

            // Variables

            var $chart = $('#chart-pie');


            // Methods

            function init($this) {
                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var pieChart = new Chart($this, {
                    type: 'pie',
                    data: {
                        labels: atendimentoAdvogadosLabel,
                        datasets: [{
                            data: atendimentoAdvogadosDados,
                            backgroundColor: atendimentoAdvogadosColor,
                            label: 'Advogados'
                        }],
                    },
                    options: {
                        responsive: true,

                        legend: {
                            display: true,
                            position :'bottom',
                            labels: {
                                fontColor: 'rgb(50, 50, 50)'
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },

                    }

          ,
                });

                // Save to jQuery object

                $this.data('chart', pieChart);

            };


            // Events

            if ($chart.length) {
                init($chart);
            }

        })();

    </script>
    <script type="text/javascript">
        'use strict';

        var atendimentoCidadesLabel = {!! $atendimentoCidadesLabel !!};
        var atendimentoCidadesDados =  {!! $atendimentoCidadesDados !!};
        var atendimentoCidadesColor =  {!! $atendimentoCidadesColor !!};

        var PieChart = (function() {

            // Variables

            var $chart = $('#atendimento-cidade');


            // Methods

            function init($this) {
                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var pieChart = new Chart($this, {
                    type: 'pie',
                    data: {
                        labels: atendimentoCidadesLabel,
                        datasets: [{
                            data: atendimentoCidadesDados,
                            backgroundColor: atendimentoCidadesColor,
                            label: 'Cidades'
                        }],
                    },
                    options: {
                        responsive: true,

                        legend: {
                            display: true,
                            position :'bottom',
                            labels: {
                                fontColor: 'rgb(50, 50, 50)'
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },

                    }

                    ,
                });

                // Save to jQuery object

                $this.data('chart', pieChart);

            };


            // Events

            if ($chart.length) {
                init($chart);
            }

        })();

    </script>
    <script type="text/javascript">
        'use strict';


        var atendimentoTipoLabel = {!! $atendimentoTipoLabel !!};
        var atendimentoTipoDados =  {!! $atendimentoTipoDados !!};
        var atendimentoTipoColor =  {!! $atendimentoTipoColor !!};

        var PieChart = (function() {

            // Variables

            var $chart = $('#atendimento-tipo');


            // Methods

            function init($this) {
                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var pieChart = new Chart($this, {
                    type: 'pie',
                    data: {
                        labels: atendimentoTipoLabel,
                        datasets: [{
                            data: atendimentoTipoDados,
                            backgroundColor: atendimentoTipoColor,
                            label: 'Tipo'
                        }],
                    },
                    plugins: {
                        labels: {
                            render: 'percentage',
                            fontColor: function (data) {
                                var rgb = hexToRgb(data.dataset.backgroundColor[data.index]);
                                var threshold = 140;
                                var luminance = 0.299 * rgb.r + 0.587 * rgb.g + 0.114 * rgb.b;
                                return luminance > threshold ? 'black' : 'white';
                            },
                            precision: 2
                        }
                    },
                    options: {
                        responsive: true,

                        legend: {
                            display: true,
                            position :'bottom',
                            labels: {
                                fontColor: 'rgb(50, 50, 50)'
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },

                    }

                    ,
                });

                // Save to jQuery object

                $this.data('chart', pieChart);

            };


            // Events

            if ($chart.length) {
                init($chart);
            }

        })();

    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush


