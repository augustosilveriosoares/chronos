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

                                <th scope="col-3">{{ __('Nome') }}</th>
                                <th scope="col-1">{{ __('Necessidade') }}</th>
                                <th scope="col-1">{{ __('Situação') }}</th>
                                <th scope="col-1">{{ __('Advogado') }}</th>
                                <th scope="col-3">{{ __('Agendado') }}</th>
                                <th scope="col-3">{{ __('Cidade') }}</th>
                                <th scope="col-3">{{ __('Ação') }}</th>








                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($atendimentos as $atendimento)
                                <tr>

                                    <td> {{ $atendimento->nome ?? ''}}</td>
                                    <td>{{ $atendimento->necessidade->descricao ?? ''}}</td>
                                    <td><span class="badge badge-default" style="background-color:{{ $atendimento->situacao->cor}}">{{ $atendimento->situacao->descricao ?? ''}}</span></td>
                                    <td>

                                        {{$atendimento->user->name ?? ''}}
                                    </td>

                                    @if($atendimento->dataagendamento != null)
                                        <td>{{ date('d-m-y H:i', strtotime($atendimento->dataagendamento))}}</td>
                                    @else
                                        <td></td>
                                    @endif



                                    <td>{{$atendimento->cidade->nome ?? ''}}</td>
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

    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
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
