@extends('layouts.app', [
    'title' => __('Category Management'),
    'parentSection' => 'laravel',
    'elementName' => 'category-management'
])

@section('content')
    @component('layouts.headers.auth')


    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <p>
                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filtros
                </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="{{ route('atendimentos.index', [$cidadeid,$userid,$situacaoid]) }}" method="get" >
                            @csrf
                        <div class="row">
                                <div class=" col-sm-12 col-lg">
                                    <div class="form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                                        <h6 class="text-gray small">Advogado</h6>
                                        <select name="userid" id="input-user" class="form-control-sm" placeholder="{{ __('Advogado') }}"  style="width: 100% !important">
                                            <option value="0" selected>Todos</option>
                                            @foreach ($advogados as $adv)

                                                <option value="{{ $adv->id }}" {{ $adv->id == old('userid',$userid) ? 'selected' : '' }}>{{ $adv->name }}</option>
                                            @endforeach

                                        </select>
                                        @include('alerts.feedback', ['field' => 'idade'])
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg">
                                    <div class="form-group{{ $errors->has('situacao_id') ? ' has-danger' : '' }}">
                                        <h6 class="text-gray small">Situação</h6>

                                        <select name="situacaoid" id="input-situacao" class="form-control-sm" placeholder="{{ __('Situação') }}" style="width: 100% !important" >
                                            <option value="0">Todos</option>
                                            @foreach ($situacoes as $sit)

                                                <option value="{{ $sit->id }}" {{ $sit->id == old('situacaoid',$situacaoid) ? 'selected' : '' }}>{{ $sit->descricao }}</option>
                                            @endforeach

                                        </select>
                                        @include('alerts.feedback', ['field' => 'idade'])
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg">
                                    <div class="form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                                        <h6 class="text-gray small">Cidade</h6>
                                        <select name="cidadeid" id="input-cidade" class="form-control-sm" placeholder="{{ __('Cidade') }}"  style="width: 100% !important">
                                            <option value="0">Todos</option>
                                            @foreach ($cidades as $sit)

                                                <option value="{{ $sit->id }}" {{ $sit->id == old('cidadeid',$cidadeid) ? 'selected' : '' }}>{{ $sit->nome }}</option>
                                            @endforeach

                                        </select>
                                        @include('alerts.feedback', ['field' => 'idade'])
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-1 text-center">
                                    <button type="submit" class="btn btn-lg btn-block btn-outline mt-3 mr-3" >
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="card">

            </div>




            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Atendimentos') }}</h3>

                            </div>
                            {{--                            @if (auth()->user()->can('create', App\Atendimento::class))--}}
                            <div class="col-4 text-right">
                                <a href="{{route('atendimentos.create')}}" class="btn btn-sm btn-primary">{{ __('Adicionar') }}</a>
                            </div>
                            {{--                            @endif--}}
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>

                    <div class="table-responsive py-4">
                        <table class="table align-items-center table-flush"  id="datatable-basic">
                            <thead class="thead-light">
                            <tr>

                                <th scope="col">{{ __('Cliente') }}</th>
                                <th scope="col">{{ __('Necessidade') }}</th>
                                <th scope="col">{{ __('Tipo') }}</th>
                                <th scope="col">{{ __('Advogado') }}</th>
                                <th scope="col">{{ __('Agendado') }}</th>
                                <th scope="col">{{ __('Cidade') }}</th>
                                <th scope="col">{{ __('Situação') }}</th>
                                <th scope="col">{{ __('Ação') }}</th>








                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($atendimentos as $atendimento)
                                <tr>

                                    <td> {{ $atendimento->nome ?? ''}}</td>
                                    <td>{{ $atendimento->necessidade->descricao ?? ''}}</td>

                                    <td>
                                        {{$atendimento->tipoatendimento->descricao ?? ''}}
                                    </td>
                                    <td>

                                        {{$atendimento->user->name ?? ''}}
                                    </td>

                                    @if($atendimento->dataagendamento != null)
                                        <td>{{ date('d-m-y H:i', strtotime($atendimento->dataagendamento))}}</td>
                                    @else
                                        <td></td>
                                    @endif



                                    <td>{{$atendimento->cidade->nome ?? ''}}</td>
                                    <td><span class="badge badge-default" style="background-color:{{ $atendimento->situacao->cor}}">{{ $atendimento->situacao->descricao ?? ''}}</span></td>

                                    <td>
                                        <a href="{{ route('atendimentos.show', $atendimento) }}">
                                            <button type="button" class="btn  btn-icon-only">
                                                <span class="btn-inner--icon"><i class="far fa-edit"></i></span>
                                            </button>
                                        </a>
                                        <form action="{{ route('atendimentos.destroy', $atendimento) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn  btn-icon-only"  onclick="confirm('{{ __("Confirma a exclusão?") }}') ? this.parentElement.submit() : ''">
                                                <span class="btn-inner--icon"><i class="far fa-trash-alt"></i></span>
                                            </button>
                                        </form>
                                    </td>

                                    {{--                                        @endcan--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
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
@endpush
