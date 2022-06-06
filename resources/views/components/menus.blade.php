    @auth
        @if (!isset($layout))
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/painel') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto">

                            @foreach ($menus as $menu)
                                @if (!empty($menu['permission']))
                                    @if (auth()->user()->can($menu['permission']))
                                        @if (!empty($menu['collapse']))
                                            <li class="nav-item dropdown">

                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="{{ __($menu['icon']) }} me-2"></i>{{ __($menu['name']) }}
                                                </a>

                                                <div class="dropdown-menu px-2" aria-labelledby="topnav-uielement">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div>
                                                                @if (isset($menu['submenus']))
                                                                    @foreach ($menu['submenus'] as $submenu)
                                                                        @if (isset($submenu['permission']))
                                                                            @if (auth()->user()->can($submenu['permission']))
                                                                                <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                                    class="dropdown-item">{{ __($submenu['name']) }}</a>
                                                                            @else
                                                                                <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                                    class="dropdown-item">{{ __($submenu['name']) }}</a>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ Route::has($menu['route']) ? route($menu['route']) : '' }}">
                                                    <i class="ri-dashboard-line me-2"></i> {{ __($menu['name']) }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @else
                                    @if (!empty($menu['collapse']))
                                        <li class="nav-item dropdown">

                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="{{ __($menu['icon']) }} me-2"></i>{{ __($menu['name']) }}
                                            </a>

                                            <div class="dropdown-menu px-2">
                                                @if (isset($menu['submenus']))
                                                    @foreach ($menu['submenus'] as $submenu)
                                                        @if (isset($submenu['permission']))
                                                            @if (auth()->user()->can($submenu['permission']))
                                                                <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                    class="dropdown-item">{{ __($submenu['name']) }}
                                                                </a>
                                                            @else
                                                                <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                    class="dropdown-item">{{ __($submenu['name']) }}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ Route::has($menu['route']) ? route($menu['route']) : '' }}">
                                                <i class="ri-dashboard-line me-2"></i> {{ __($menu['name']) }}
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if (auth()->user()->hasRole('dev'))
                                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                                Developer
                                            </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @else
            @if ($layout == 'horizontal')
                <div class="topnav">
                    <div class="container-fluid">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">

                                    @foreach ($menus as $menu)
                                        @if (!empty($menu['permission']))
                                            @if (auth()->user()->can($menu['permission']))
                                                @if (!empty($menu['collapse']))
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                                            <i class="{{ __($menu['icon']) }} me-2"></i>{{ __($menu['name']) }} <div class="arrow-down"></div>
                                                        </a>

                                                        <div class="dropdown-menu px-2" aria-labelledby="topnav-uielement">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div>
                                                                        @if (isset($menu['submenus']))
                                                                            @foreach ($menu['submenus'] as $submenu)
                                                                                @if (isset($submenu['permission']))
                                                                                    @if (auth()->user()->can($submenu['permission']))
                                                                                        <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                                            class="dropdown-item">{{ __($submenu['name']) }}</a>
                                                                                    @else
                                                                                        <a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}"
                                                                                            class="dropdown-item">{{ __($submenu['name']) }}</a>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ Route::has($menu['route']) ? route($menu['route']) : '' }}">
                                                            <i class="ri-dashboard-line me-2"></i> {{ __($menu['name']) }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            @else
                <div class="vertical-menu">
                    <div data-simplebar class="h-100">

                        <div class="vertical-menu_logo">
                            <a href="{{ route('painel') }}" class="logo active">
                                <span class="logo-lg text-center">
                                    <img src="{{ asset('images/logo.png') }}" alt="img-logo">
                                </span>
                                <span class="logo-sm text-center">
                                    <img src="{{ asset('images/logo-sm.png') }}" alt="img-logo">
                                </span>
                            </a>
                        </div>

                        <div id="sidebar-menu">
                            <ul class="metismenu list-unstyled" id="side-menu">
                                <li class="menu-title">Menu</li>

                                @foreach ($menus as $menu)
                                    @if (!empty($menu['permission']))
                                        @if (auth()->user()->can($menu['permission']))
                                            @if (!empty($menu['collapse']))
                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                        <i class="{{ __($menu['icon']) }}"></i>
                                                        <span>{{ __($menu['name']) }}</span>
                                                    </a>

                                                    <ul class="sub-menu" aria-expanded="true">
                                                        @if (isset($menu['submenus']))
                                                            @foreach ($menu['submenus'] as $submenu)
                                                                @if (isset($submenu['permission']))
                                                                    @if (auth()->user()->can($submenu['permission']))
                                                                        <li><a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}">{{ __($submenu['name']) }}</a></li>
                                                                    @endif
                                                                @else
                                                                    <li><a href="{{ Route::has($submenu['route']) ? route($submenu['route']) : '' }}">{{ __($submenu['name']) }}</a></li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '' }}" class="waves-effect">
                                                        <i class="{{ __($menu['icon']) }}"></i>
                                                        <span>{{ __($menu['name']) }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endauth
