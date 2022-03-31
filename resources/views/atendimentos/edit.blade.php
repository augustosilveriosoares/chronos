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
                                <span><h4>{{$atendimento->nome ?? ''}}  </h4></span>
                                <span class="text-muted small">Criado em {{date('d-m-Y', strtotime($atendimento->datacadastro))}} </span>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('atendimentos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">

                        <div class="row">
                            <div class="col"><span>Necessidade</span></div>
                            <div class="col"><span>col</span></div>
                            <div class="col"><span>col</span></div>
                            <div class="col"><span>col</span></div>
                        </div>
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
