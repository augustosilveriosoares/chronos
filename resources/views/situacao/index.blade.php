@extends('layouts.app', [
    'title' => __('Category Management'),
    'parentSection' => 'laravel',
    'elementName' => 'category-management'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Examples') }}
            @endslot

            <li class="breadcrumb-item"><a href="{{ route('situacao.index') }}">{{ __('Situações de Atendimento') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Lista') }}</li>
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Situações') }}</h3>

                            </div>
                            @if (auth()->user()->can('create', App\Category::class))
                                <div class="col-4 text-right">
                                    <a href="{{ route('situacao.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar') }}</a>
                                </div>
                            @endif
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
                                    <th scope="col">{{ __('Descricao') }}</th>
                                    <th scope="col">{{ __('Cor') }}</th>
                                    <th scope="col text-right"></th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($situacoes as $situacao)
                                    <tr>
                                        <td>{{ $situacao->descricao }}</td>
                                        <td><span class="badge badge-default" style="background-color:{{ $situacao->cor }}">{{ $situacao->descricao }}</span></td>


                                        <td class="text-right">
                                            <a href="{{ route('situacao.show', $situacao) }}">
                                                <button type="button" class="btn  btn-icon-only">
                                                    <span class="btn-inner--icon"><i class="far fa-edit"></i></span>
                                                </button>
                                            </a>
                                            <form action="{{ route('situacao.destroy', $situacao) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn  btn-icon-only"  onclick="confirm('{{ __("Confirma a exclusão?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="btn-inner--icon"><i class="far fa-trash-alt"></i></span>
                                                  </button>
                                            </form>
                                        </td>
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
