@extends('layouts.app', [
'parentSection' => '',
'elementName' => 'agenda'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')

            @slot('title')
                {{ now()->format('F Y') }}
            @endslot

        @endcomponent
    @endcomponent


    <div class="container-fluid mt--6  ">

        <div class="row justify-content-center">

            <div class="col-7 ">
                <!-- Fullcalendar -->
                <div class="card ">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body p-4">
                        <form method="post" action="{{ route('transferencia.transfere') }}" >

                            @csrf
                        <div class="form-group{{ $errors->has('origem') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-user_id">{{ __('De:') }}</label>
                            <select name="origem" id="input-user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Advogado') }}" required>
                                <option value="">-</option>
                                @foreach ($advogados as $adv)
                                    <option value="{{ $adv->id }}" >

                                        {{$adv->name}}

                                    </option>
                                @endforeach

                            </select>
                            @include('alerts.feedback', ['field' => 'idade'])
                        </div>
                        <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-user_id">{{ __('Para:') }}</label>
                            <select name="destino" id="input-user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Advogado') }}" required>
                                <option value="">-</option>
                                @foreach ($advogados as $adv)
                                    <option value="{{ $adv->id }}" >
                                        <a href="#!" class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder" src="{{$adv->picture}}">
                                        </a>
                                        {{$adv->name}}

                                    </option>
                                @endforeach

                            </select>
                            @include('alerts.feedback', ['field' => 'idade'])
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="example-date-input" class="form-control-label">Início</label>
                                    <input class="form-control" type="date" value="" id="example-date-input" name="start" required>
                                </div>
                                <div class="col">
                                    <label for="example-date-input" class="form-control-label">Fim</label>
                                    <input class="form-control" type="date" value="" id="example-date-input" name="end" required>
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Tranferir Atendimentos</button>


                        </div>
                            <div class="form-group">
                                @include('alerts.success')
                                @include('alerts.errors')
                            </div>
                        </form>
                    </div>
                </div>

            </div>


        </div>



        <!-- Footer -->

    </div>
@endsection

@push('css')

    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">



@endpush

@push('js')

    <script src="{{ asset('argon') }}/vendor/moment/min/moment.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>







@endpush



