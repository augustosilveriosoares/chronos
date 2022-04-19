<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-scrollx_visible">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">

                    <li class="nav-item {{ $parentSection == 'dashboards' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">{{ __('Dashboards') }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ $elementName == 'atendimentos' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('atendimentos.index') }}">
                            <i class="ni ni-single-02 text-dark"></i>
                            <span class="nav-link-text">{{ __('Atendimentos') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ $elementName == 'agendamento' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('agendamento.index') }}">
                            <i class="ni ni-calendar-grid-58 text-dark"></i>
                            <span class="nav-link-text">{{ __('Agenda') }}</span>
                        </a>
                    </li>
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item active collapsed">
                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fab fa-laravel" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Configurações') }}</span>
                        </a>
                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ $elementName == 'profile' ? 'active' : '' }}">
                                    <a href="{{ route('profile.edit') }}" class="nav-link">{{ __('Perfil') }}</a>
                                </li>
                                @can('manage-users', App\User::class)
                                    <li class="nav-item  {{ $elementName == 'role-management' ? 'active' : '' }}">
                                        <a href="{{ route('role.index') }}" class="nav-link">{{ __('Regras') }}</a>
                                    </li>
                                @endcan
                                @can('manage-users', App\User::class)
                                    <li class="nav-item {{ $elementName == 'user-management' ? 'active' : '' }}">
                                        <a href="{{ route('user.index') }}" class="nav-link">{{ __('Usuários') }}</a>
                                    </li>
                                @endcan
                                @can('manage-items', App\User::class)
                                    <li class="nav-item {{ $elementName == 'situacao-management' ? 'active' : '' }}">
                                        <a href="{{ route('situacao.index') }}" class="nav-link">{{ __('Situações') }}</a>
                                    </li>
                                @endcan
                                @can('manage-items', App\User::class)
                                    <li class="nav-item {{ $elementName == 'parametro-management' ? 'active' : '' }}">
                                        <a href="{{ route('parametro.index') }}" class="nav-link">{{ __('Parametros') }}</a>
                                    </li>
                                @endcan
                                @can('manage-items', App\User::class)
                                    <li class="nav-item {{ $elementName == 'tag-management' ? 'active' : '' }}">
                                        <a href="{{ route('tag.index') }}" class="nav-link">{{ __('Tags') }}</a>
                                    </li>
                                @endcan
                                @can('manage-items', App\User::class)
                                    <li class="nav-item {{ $elementName == 'item-management' ? 'active' : '' }}">
                                        <a href="{{ route('item.index') }}" class="nav-link">{{ __('Item Management') }}</a>
                                    </li>
                                @else
                                    <li class="nav-item {{ $elementName == 'item-management' ? 'active' : '' }}">
                                        <a href="{{ route('item.index') }}" class="nav-link">{{ __('Items') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                        @endif


                </ul>

            </div>
        </div>
    </div>
</nav>
