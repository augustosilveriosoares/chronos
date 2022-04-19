<div class="row">
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">  Pendentes</h5>
                        <span class="h2 font-weight-bold mb-0"> {{$dashboard->pendente ?? ''}}</span>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Agendados</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->agendado ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Em Análise</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->analise ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Processos</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->processo ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Infrutiferos</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->infrutifero ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-3">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->total ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>


</div>
