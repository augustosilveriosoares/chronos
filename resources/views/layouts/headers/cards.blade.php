<div class="row">
    <div class="col-xl-2 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Pendentes</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->totalpendente ?? ''}}</span>
                    </div>

            </div>


        </div>
    </div>
</div>
    <div class="col-xl-2 col-md-6">
    <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Agendados</h5>
                    <span class="h2 font-weight-bold mb-0">{{$dashboard->totalagendado ?? ''}}</span>
                </div>

            </div>

        </div>
    </div>
</div>
    <div class="col-xl-2 col-md-6">
    <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Concluídos</h5>
                    <span class="h2 font-weight-bold mb-0">{{$dashboard->totalconcluido ?? ''}}</span>
                </div>

            </div>

        </div>
    </div>
</div>
    <div class="col-xl-2 col-md-6">
    <div class=" col card card-stats">
        <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Processos</h5>
                        <span class="h2 font-weight-bold mb-0">{{$dashboard->totalprocesso ?? ''}}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
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
