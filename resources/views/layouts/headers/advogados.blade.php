
@php $i = 0; $y =1 ;$maxcolumn = 4; $size = count($dashboardadv); @endphp
<div class="row">
@foreach($dashboardadv as $adv)

    <div class="col-lg-3 col-md -4 col-sm-12 mt-7">
                <div class="card">
                    <div class="row justify-content-center mb-6">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">

                                    <img src="{{$adv->picture}}" class="rounded-circle">

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title mb-3 text-center">{{$adv->name}}</h3>
                        <h4 class="text-muted text-center"><strong class="text-primary">{{$adv->total}}</strong> Atendimentos</h4>

                    </div>
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item"><h4 class="text-muted text-center"><strong class="text-primary">{{$adv->totalagendado?? '0'}}</strong> Agendados</h4></li>
                        <li class="list-group-item"><h4 class="text-muted text-center"><strong class="text-primary">{{$adv->totalconcluido?? '0'}}</strong> Concluídos</h4></li>
                        <li class="list-group-item"><h4 class="text-muted text-center"><strong class="text-primary">{{$adv->totalprocesso?? '0'}}</strong> Processos</h4></li>

                    </ul>
                </div>
    </div>
    {{--SE ARRAY MENOR IGUAL A 4 TERMINA A LINHA--}}
    @if($size <= $maxcolumn && $y === $size)
        </div>
    @endif
    {{-- CHEGOU NO FIM DA LINHA    --}}
    @if($i === $maxcolumn)
        {{--MEU ARRAY DE ADVOGADOS É IGUAL O PONTEIRO?--}}
        @if($size === $y)
            {{--FIM--}}
            </div>
        @endif
        @if($size > $y)
            {{--SE NAO, TEM COISA A IMPRIMIR--}}
            </div>
            <div class="row">
        @endif
        {{--ZERA O PONTEIRO DAS COLUNAS--}}
        @php  $i = 0;  @endphp
    @endif
    {{--INCREMENTA I        --}}
    @php  $i = $i+1;  @endphp
    {{--INCREMENTA O PONTEIRO DAS LINHAS--}}
    @php  $y = $y+1;  @endphp
@endforeach












