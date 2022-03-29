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
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3>{{ __('Atendimento') }}  </h3>
                                <span class="text-muted small">Criado em {{date('d-m-Y', strtotime($atendimento->datacadastro))}} </span>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('atendimentos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($atendimento->id)
                            <form method="post" action="{{ route('atendimentos.update', $atendimento) }}" autocomplete="off">
                                @method('put')
                        @else
                            <form method="post" action="{{ route('atendimentos.store', $atendimento) }}" autocomplete="off">
                        @endif
                            @csrf
                                <div class="row">

                                            <div class="form-group{{ $errors->has('datacadastro') ? ' has-danger' : '' }}">
                                                <input type="hidden" name="datacadastro" id="" class="form-control{{ $errors->has('datacadastro') ? ' is-invalid' : '' }}" placeholder="{{ __('Data') }}" value="{{date('Y-m-d\TH:i', strtotime($atendimento->datacadastro))}}"  >
                                                @include('alerts.feedback', ['field' => 'datacadastro'])
                                            </div>


                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-nome">{{ __('Nome') }}</label>
                                                    <input type="text" name="nome" id="input-nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('nome', $atendimento->nome??'') }}" required autofocus>
                                                    @include('alerts.feedback', ['field' => 'name'])
                                                </div>

                                            </div>
                                            <div class="col-lg-1 col-sm-6">
                                                <div class="form-group{{ $errors->has('idade') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-idade">{{ __('Idade') }}</label>
                                                    <input type="text" name="idade" id="input-idade" class="form-control{{ $errors->has('idade') ? ' is-invalid' : '' }}" placeholder="{{ __('Idade') }}" value="{{ old('nome', $atendimento->idade??'') }}" required autofocus>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>

                                            </div>
                                            <div class="col-lg-1 col-sm-6">
                                                <div class="form-group{{ $errors->has('contribuicao') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-contribuicao">{{ __('Contribuição') }}</label>
                                                    <input type="text" name="anoscontribuicao" id="input-anoscontribuicao" class="form-control{{ $errors->has('anoscontribuicao') ? ' is-invalid' : '' }}" placeholder="{{ __('Contribuição') }}" value="{{ old('anoscontribuicao', $atendimento->anoscontribuicao ??'') }}" required autofocus>
                                                    @include('alerts.feedback', ['field' => 'anoscontribuicao'])
                                                </div>

                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="form-group{{ $errors->has('sexo_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-idade">{{ __('Sexo') }}</label>
                                                    <select name="sexo_id" id="input-sexo" class="form-control{{ $errors->has('sexo_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Sexo') }}" required>
                                                        <option value="">-</option>
                                                        @foreach ($sexos as $sex)
                                                            <option value="{{ $sex->id }}" {{ $sex->id == old('sexo_id',$atendimento->sexo_id) ? 'selected' : '' }}>{{ $sex->descricao }}</option>
                                                        @endforeach
                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>

                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <div class="form-group{{ $errors->has('online') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-online">{{ __('Online') }}</label><br>
                                                    <label class="custom-toggle mt-1">

                                                         @if($atendimento->isOnline())
                                                            <input type="hidden" name="online" value="1">
                                                        @else
                                                            <input type="hidden" name="online" value="0">
                                                        @endif
                                                        <input type="checkbox"  name="isonline" id="isonline"  {{$atendimento->isOnline() ? 'checked' : ''}} >
                                                        <span class="custom-toggle-slider rounded-circle"  data-label-off="Não" data-label-on="Sim" ></span>

                                                    </label>

                                                    @include('alerts.feedback', ['field' => 'online'])
                                                </div>

                                            </div>
                                            <div class="col-lg-1 col-sm-12">

                                        <div class="form-group{{ $errors->has('online') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-online">{{ __('Retorno') }}</label><br>
                                            <label class="custom-toggle mt-1">

                                                @if($atendimento->isOnline())
                                                    <input type="hidden" name="online" value="1">
                                                @else
                                                    <input type="hidden" name="online" value="0">
                                                @endif
                                                <input type="checkbox"  name="isonline" id="isonline"  {{$atendimento->isOnline() ? 'checked' : ''}} >
                                                <span class="custom-toggle-slider rounded-circle"  data-label-off="Não" data-label-on="Sim" ></span>

                                            </label>

                                            @include('alerts.feedback', ['field' => 'online'])
                                        </div>

                                    </div>

                                        </div>
                                <div class="row">

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group{{ $errors->has('whats') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-nome">{{ __('Whats') }}</label>
                                                    <input type="text" name="whats" id="input-whats" class="form-control{{ $errors->has('whats') ? ' is-invalid' : '' }}" placeholder="{{ __('Whats') }}" value="{{ old('whats', $atendimento->whats??'') }}" required autofocus>
                                                    @include('alerts.feedback', ['field' => 'whats'])
                                                </div>

                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-idade">{{ __('E-mail') }}</label>
                                                    <input type="text" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $atendimento->email??'') }}" required autofocus>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>

                                            </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <div class="form-group{{ $errors->has('necessidade_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-idade">{{ __('Necessidade') }}</label>
                                            <select name="necessidade_id" id="input-necessidade" class="form-control{{ $errors->has('necessidade_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Necessidade') }}" required>
                                                <option value="">-</option>
                                                @foreach ($necessidades as $nec)
                                                    <option value="{{ $nec->id }}" {{ $nec->id == old('necessidade_id',$atendimento->necessidade_id) ? 'selected' : '' }}>{{ $nec->descricao }}</option>
                                                @endforeach

                                            </select>
                                            @include('alerts.feedback', ['field' => 'idade'])
                                        </div>

                                    </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group{{ $errors->has('atuacao_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-atuacao">{{ __('Atuação') }}</label>
                                                    <select name="atuacao_id" id="input-atuacao" class="form-control{{ $errors->has('atuacao_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Atuação') }}" required>
                                                        @foreach ($atuacoes as $atu)
                                                            <option value="{{ $atu->id }}" {{ $atu->id == old('atuacao_id',$atendimento->atuacao_id) ? 'selected' : '' }}>{{ $atu->descricao }}</option>
                                                        @endforeach

                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>

                                            </div>

                                        </div>
                                <div class="row">
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('situacao_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-situacao">{{ __('Situação') }}</label>
                                                    <select name="situacao_id" id="input-situacao" class="form-control{{ $errors->has('situacao_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Situação') }}" required>
                                                        @foreach ($situacoes as $sit)
                                                            <option value="{{ $sit->id }}" {{ $sit->id == old('situacao_id',$atendimento->situacao_id) ? 'selected' : '' }}>{{ $sit->descricao }}</option>
                                                        @endforeach

                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-user_id">{{ __('Advogado') }}</label>
                                                    <select name="user_id" id="input-user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Advogado') }}" required>
                                                        @foreach ($advogados as $adv)
                                                            <option value="{{ $adv->id }}" {{ $adv->id == old('user_id',$atendimento->user_id) ? 'selected' : '' }}>{{ $adv->name }}</option>
                                                        @endforeach

                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('dataagendamento') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-user_id">{{ __('Data da Consulta') }}</label>

                                                    @if(empty($atendimento->dataagendamento))
                                                        <input type="datetime-local" id="input-data" class="form-control" name="dataagendamento" value="" >
                                                    @else
                                                        <input type="datetime-local" id="input-data" class="form-control" name="dataagendamento" value="{{ date('Y-m-d\TH:i', strtotime($atendimento->dataagendamento)) ?? '' }}" >
                                                    @endif

                                                    @include('alerts.feedback', ['field' => 'dataagendamento'])
                                                </div>
                                            </div>

                                        </div>
                                <div class="row">
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('cidade_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-cidade">{{ __('Cidade') }}</label>
                                                    <select name="cidade_id" id="cidade_id" class="form-control{{ $errors->has('cidade_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" >
                                                        <option value="">Selecione</option>
                                                        @foreach ($cidades as $cid)
                                                            <option value="{{ $cid->id }}" {{ $cid->id == old('cidade_id',$atendimento->cidade_id) ? 'selected' : '' }}>{{ $cid->nome }}</option>
                                                        @endforeach

                                                    </select>
                                                    @include('alerts.feedback', ['field' => 'idade'])
                                                </div>
                                            </div>


                                        </div>
                                <div class="row">
                                            <div class="col text-center">
                                                <button type="submit" class="btn btn-success  btn-lg">{{ __('Salvar') }}</button>

                                            </div>
                                        </div>
                            </form>
                    </div>
                </div>
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
                                            <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="{{$obs->user->picture ?? ''}}">
                                            <div class="media-body">
                                                <div class="media-comment-text">
                                                    <h6 class="h5 mt-0">{{$obs->user->name}}</h6>
                                                    <p class="text-sm lh-160">{{$obs->descricao}}</p>
                                                    <div class="icon-actions">
                                                        <a href="#" class="like active">

                                                            <span class="text-muted small">{{$obs->data}}</span>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($atendimento->id)

                                        <form method="POST" action="{{route('observacao.store')}}" autocomplete="off">
                                            @csrf
                                            @method('POST')


                                            <div class="media align-items-center">
                                                <img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4" src="{{ auth()->user()->picture}}">
                                                <div class="media-body">

                                                    <input type="hidden" name="atendimento_id" id="input-id" class="form-control"  value="{{$atendimento->id??''}}"  >
                                                    <input type="hidden" name="user_id" id="input-id" class="form-control"  value="{{auth()->user()->id ??''}}"  >
                                                    <textarea name="descricao" class="form-control" placeholder="Escreva sua observação" rows="1"></textarea>

                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-success  btn-lg">{{ __('Salvar') }}</button>

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
