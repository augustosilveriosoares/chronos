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
                                <th scope="col-1"></th>
                                <th scope="col-3">{{ __('Advogado') }}</th>
                                <th scope="col-1">{{ __('Cadastro') }}</th>
                                <th scope="col-1">{{ __('Agendamento') }}</th>



                                <th scope="col">{{ __('Nome') }}</th>
                                <th scope="col">{{ __('Necessidade') }}</th>
                                <th scope="col">{{ __('Situação') }}</th>

                                @can('manage-items', App\User::class)
                                    <th scope="col"></th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($atendimentos as $atendimento)
                                <tr>
                                    <td >
                                            <span class="avatar avatar-sm rounded-circle mr-1 ">
                                                <img src="{{$atendimento->user->picture}}" alt="" style="max-width: 100px; border-radiu: 25px">

                                            </span>

                                    </td>
                                    <td> {{ $atendimento->user->name ?? ''}}</td>
                                    <td>{{ date('d-m-Y', strtotime($atendimento->datacadastro)) ?? '' }}</td>
                                    <td>{{ date('d-m-Y', strtotime($atendimento->dataagendamento)) ?? '' }}</td>

                                    <td> {{ $atendimento->nome ?? ''}}</td>
                                    <td>{{ $atendimento->necessidade->descricao ?? ''}}</td>
                                    <td><span class="badge badge-default" style="background-color:{{ $atendimento->situacao->cor}}">{{ $atendimento->situacao->descricao ?? ''}}</span></td>





                                    {{--                                        @can('manage-items', App\Atendimento::class)--}}
                                    <td class="text-right">
                                        {{--                                                @if (auth()->user()->can('update', $atendimento) || auth()->user()->can('delete', $atendimento))--}}
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                {{--                                                            @can('update', $atendimento)--}}
                                                <a class="dropdown-item" href="{{ route('atendimentos.show', $atendimento) }}">{{ __('Editar') }}</a>

                                                {{--                                                            @endcan--}}
                                                {{--                                                            @if ($atendimento->items->isEmpty() && auth()->user()->can('delete', $atendimento))--}}
                                                <form action="{{ route('atendimentos.destroy', $atendimento) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Confirma a exclusão?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Excluir') }}
                                                    </button>
                                                </form>
                                                {{--                                                            @endif--}}
                                            </div>
                                        </div>
                                        {{--                                                @endif--}}
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
