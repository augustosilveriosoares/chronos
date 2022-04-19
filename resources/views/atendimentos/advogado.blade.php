@extends('layouts.app', [
    'title' => __('Atendimentos Management'),
    'parentSection' => 'laravel',
    'elementName' => 'atendimentos-management'
])

@section('content')
    @component('layouts.headers.auth')

    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span><h4>{{$atendimento->nome ?? ''}}  </h4></span>

                            </div>

                        </div>
                    </div>
                    <div class="card-body bg-secondary">

                        <div class="row">
                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Tipo Atendimento</h6>
                                <h4>{{$atendimento->tipoatendimento->descricao ?? ''}}</h4>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Necessidade</h6>
                                <h4>{{$atendimento->necessidade->descricao?? ''}}</h4>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Atuação</h6>
                                <h4>{{$atendimento->atuacao->descricao?? ''}}</h4>
                            </div>

                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Idade</h6>
                                <h4>{{$atendimento->idade ?? ''}}</h4>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Contribuição</h6>
                                <h4>{{$atendimento->anoscontribuicao ?? ''}}</h4>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <h6 class="text-gray">Forma</h6>
                                <h4>{{$atendimento->isOnline() ? 'Online':'Presencial'}}</h4>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="row">

            <div class="col-lg-12 col-md-12 col-xl-12  col-sm-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><h4>Encaminhar para </h4></span>

                            </div>

                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <form method="post" action="{{route('updateByAdvogado',$atendimento)}}" autocomplete="off">
                            @csrf
                            @method('put')
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('situacao_id') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="id" value="{{$atendimento->id}}">
                                    <label class="form-control-label" for="input-situacao">{{ __('Situação') }}</label>
                                    <select name="situacao_id" id="input-situacao" class="form-control{{ $errors->has('situacao_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Situação') }}" >
                                        @foreach ($situacoes as $sit)
                                            <option value="{{ $sit->id }}" {{ $sit->id == old('situacao_id',$atendimento->situacao_id) ? 'selected' : '' }}>{{ $sit->descricao }}</option>
                                        @endforeach

                                    </select>
                                    @include('alerts.feedback', ['field' => 'idade'])
                                </div>
                            </div>
                            <div class="col-lg-4 mt-lg-4 ">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-warning btn-lg btn-block">{{ __('Salvar') }}</button>
                                </div>
                            </div>

                        </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 mt-2">
                @include('alerts.success')
                @include('alerts.errors')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Obeservações') }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-1">
                                    @foreach($atendimento->observacoes as $obs)
                                        <div class="media media-comment mb-3">
                                            <img alt="Image placeholder" class="avatar avatar-sm media-comment-avatar rounded-circle" src="{{$obs->user->picture ?? ''}}">
                                            <div class="media-body">
                                                <div class="media-comment-text">
                                                    <h6 class="h5 mt-0">{{$obs->user->name}} - <span class="text-muted small">{{$obs->data}}</span> </h6>
                                                    <p class="text-sm lh-160">{{$obs->descricao}}</p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($atendimento->id)

                                        <form method="POST" action="{{route('observacao.store')}}" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                             <div class="row">
                                                 <div class="col-lg-11 col-md-10">
                                                     <div class="media align-items-center">
                                                         <img alt="Image placeholder" class="avatar avatar-xs rounded-circle mr-4" src="{{ auth()->user()->picture}}">
                                                         <div class="media-body">

                                                             <input type="hidden" name="atendimento_id" id="input-id" class="form-control"  value="{{$atendimento->id??''}}"  >
                                                             <input type="hidden" name="user_id" id="input-id" class="form-control"  value="{{auth()->user()->id ??''}}"  >
                                                             <textarea name="descricao" class="form-control" placeholder="Escreva sua observação" rows="1"></textarea>


                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-1 col-md-2 mt-sm-3 mt-lg-1 mt-2 ">
                                                     <div class="col text-center">
                                                         <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Salvar') }}</button>

                                                     </div>
                                                 </div>

                                             </div>




                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>




                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>






@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <script type="text/javascript">


        var switchStatus = false;
        $("#isonline").on('change', function() {
            if ($(this).is(':checked')) {
                document.getElementById('cidade_id').value = 0;
                $("#cidade_id").prop('disabled',true);
            }
            else {
                switchStatus = $(this).is(':checked');
                document.getElementById('cidade_id').value = 1;
                $("#cidade_id").prop('disabled',false);
            }
        });


    </script>
    <script>
        window.onload = function () {
            if ( $("#isonline").is(':checked')) {
                document.getElementById('cidade_id').value = 0;
                $("#cidade_id").prop('disabled',true);
            }
            // else {
            //     switchStatus = $(this).is(':checked');
            //     document.getElementById('cidade_id').value = 1;
            //     $("#cidade_id").prop('disabled',false);
            // }
        }
    </script>

@endpush

