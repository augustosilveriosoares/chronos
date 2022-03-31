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

            <li class="breadcrumb-item"><a href="{{ route('situacao.index') }}">{{ __('Gerenciamento de Situação') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Adicionar') }}</li>
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Situações') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('situacao.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($situacao->id)
                            <form method="post" action="{{ route('situacao.update', $situacao) }}" autocomplete="off">
                                @method('put')
                        @else
                            <form method="post" action="{{ route('situacao.store', $situacao) }}" autocomplete="off">
                        @endif
                        @csrf


                            <h6 class="heading-small text-muted mb-4">{{ __('Situação') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Descrição') }}</label>
                                    <input type="text" name="descricao" id="input-descricao" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" value="{{ old('descricao', $situacao->descricao ??'') }}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'descricao'])
                                </div>
                                <div class="form-group">
                                    <label for="example-color-input" class="form-control-label">Cor</label>
                                    <input type="color" name="cor" id="input-color" class="form-control{{ $errors->has('cor') ? ' is-invalid' : '' }}" placeholder="{{ __('Cor') }}" value="{{ old('cor', $situacao->cor) }}" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
