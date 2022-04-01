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

            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Gerenciamento de Situação') }}</a></li>
            
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

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($parametro->id)
                            <form method="post" action="{{ route('parametro.update', $parametro) }}" autocomplete="off">
                                @method('put')
                        @else
                            <form method="post" action="{{ route('parametro.store', $parametro) }}" autocomplete="off">
                        @endif
                        @csrf


                            <h6 class="heading-small text-muted mb-4">{{ __('Situação') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                                    <input type="hidden" value="{{$parametro->id ??''}}">
                                    <label class="form-control-label" for="input-tempo">{{ __('Tempo') }}</label>
                                    <input type="text" name="tempo" id="input-tempo" class="form-control{{ $errors->has('tempo') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempo') }}" value="{{ old('tempo', $parametro->tempo ??'') }}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'tempo'])
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
