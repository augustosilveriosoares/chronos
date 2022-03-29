        @extends('layouts.app')

        @section('content')


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="main-content">
                <!-- Top navbar -->

                <div class="header bg-gradient-primary pb-8 pt-2 pt-md-6">

                </div>
                <div class="container-fluid mt--6">
                    <div class="row">
                        <div class="col-xl-12 order-xl-1">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h3 class="mb-0">Usuarios</h3>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{route('usuario')}}" class="btn btn-sm btn-primary">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">




                                    <form method="POST" action="{{route('usuario.update')}}"   autocomplete="off" enctype="multipart/form-data" class="form">

                                        @csrf
                                        @method("PUT")

                                        <h6 class="heading-small text-muted mb-4">Informações do Usuário</h6>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <label class="form-control-label" for="input-name">Nome</label>
                                                    <input type="hidden" name="id" id="input-id" class="form-control"  value="{{$usuario->id??''}}"  >
                                                    <input type="text" name="name" id="input-nome" class="form-control"  value="{{$usuario->name??''}}"  >
                                                    <label class="form-control-label" for="input-name">Email</label>
                                                    <input type="text" name="email" id="input-nome" class="form-control"  value="{{$usuario->email??''}}"  >
                                                    <input type="file" class="form-control" name="image" id="image">

                                                </div>



                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">Salvar</button>

                                        </div>


                                    </form>


                                </div>

                            </div>

                            @if(session()->has('message'))

                                    <div class="alert alert-success alert-dismissible fade show t-3" role="alert">
                                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                        <span class="alert-inner--text"><strong>Salvo!</strong> O registro foi atualizado</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                            @endif
                        </div>

                    </div>

                        <div class="row">
                            <div class="col mt-2">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h3 class="mb-0">Contas Google</h3>
                                            </div>
                                            <div class="col-4 text-right">

                                                <a href="{{route('google.store')}}" ><button type="button" class="btn btn-success">Adicionar</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">





                                        <!-- Comments -->

                                        <div class="mb-1">
                                            @if($usuario->googleAccounts)
                                            @foreach($usuario->googleAccounts as $gac)
                                                <div class="media media-comment pt-1 pb-1">

                                                    <div class="media-body ml-2">
                                                        <div class="media-comment-text">
                                                            <h6 class="h5 mt-0">{{$gac->name ?? ''}}</h6>
                                                            <p class="text-sm lh-160">Google ID: {{$gac->google_id ?? ''}}</p>



                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                            @endif




                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>






        @endsection

