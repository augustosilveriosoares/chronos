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



        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Parametros de Atendimento') }}</h3>
                            </div>
                            <div class="col-4 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        <form method="post" action="{{ route('parametro.update', $parametro) }}" autocomplete="off">
                            @method('put')
                            @csrf


                        <div class="row">
                            <div class="col-12 pl-lg-4">
                                <div class="form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="id"value="{{$parametro->id ??''}}">
                                    <label class="form-control-label" for="input-tempo">{{ __('Tempo de Atendimento (min)') }}</label>
                                    <input type="text" name="tempo" id="tempo" class="form-control{{ $errors->has('tempo') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempo') }}" value="{{ $parametro->tempo ??'' }}" required autofocus>


                                    @include('alerts.feedback', ['field' => 'tempo'])
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 pl-lg-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="onlyMyCity" name="onlyMyCity" type="checkbox" {{$parametro->onlyMyCity()? 'checked':''}}>
                                    <label class="custom-control-label" for="onlyMyCity">Visualizar apenas minha cidade</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
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
