@extends('layouts.app', [
    'parentSection' => 'dashboards',
    'elementName' => 'dashboard2'
])

@section('content')
    @component('layouts.headers.auth')


    @endcomponent
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form method="get" action="" autocomplete="off">
                    @csrf
                     <div class="card">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row justify-content-center">

                            <div class="col-lg-1 mt-1" >
                                <label class="form-control-label">Período</label>


                            </div>
                            <div class="col-lg-4">
                                <input class="form-control " type="date" value="" id="example-date-input" name="dataini">
                            </div>
                            <div class="col-lg-1 text-lg-center mt-1" >
                                <label class="form-control-label">até</label>

                            </div>
                            <div class="col-lg-4">


                                <input class="form-control" type="date" value="" id="example-date-input" name="datafim">

                            </div>
                            <div class="col-lg-2">


                                <button type="submit" class="btn btn-success  btn-lg">{{ __('Filtrar') }}</button>

                            </div>
                        </div>


                    </div>
                </div>
                </form>

            </div>

        </div>

        <div class="row">
            <div class="col-xl-6">
                <!--* Card header *-->
                <!--* Card body *-->
                <!--* Card init *-->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Surtitle -->

                        <!-- Title -->
                        <h5 class="h3 mb-0">Atendimento por advogados</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.headers.cards')
        @include('layouts.headers.advogados')



        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="mb-0">Painel de Desempenho</h3>
                            </div>
                            <div class="table-responsive py-4">
                                <table class="table align-items-center table-flush"  >
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Advogado</th>
                                        <th scope="col" class="sort" data-sort="total">Total</th>
                                        <th scope="col" class="sort" data-sort="totalagendado">Agendados</th>
                                        <th scope="col" class="sort" data-sort="totalconcluido">Concluídos</th>
                                        <th scope="col" class="sort" data-sort="totalprocesso">Processos</th>

                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($dashboardadv as $adv)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="#" class="avatar avatar-sm rounded-circle mr-3">
                                                        <img alt="Image placeholder" src="{{$adv->picture}}">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$adv->name}}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td><h3>{{$adv->total ?? ''}}</h3></td>
                                            <td><h3>{{$adv->totalagendado ?? ''}}</h3></td>
                                            <td><h3>{{$adv->totalconcluido ?? ''}}</h3></td>
                                            <td><h3>{{$adv->totalprocesso ?? ''}}</td>


                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>



        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
{{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
<!--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>-->

    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        var atendimentoAdvogadosLabel = {!! $atendimentoAdvogadosLabel !!};
        var atendimentoAdvogadosDados =  {!! $atendimentoAdvogadosDados !!};
        var atendimentoAdvogadosColor =  {!! $atendimentoAdvogadosColor !!};

        const labels = atendimentoAdvogadosLabel;

        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: atendimentoAdvogadosDados,
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>


@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush


