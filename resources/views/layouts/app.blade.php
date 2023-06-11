<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite('resources/sass/app.scss')
</head>
<body>
    <div id="app" class="position-absolute bg-transparent start-0 w-100 h-100">

        <symbols-component></symbols-component>

        <main>
        @auth

        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">{{ __('Application name') }}</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">

                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        {{ __('Dashboard') }}
                    </a>
                </li>

                @role('health-professional')
                <li>
                    <a href="{{ route('agenda') }}" class="nav-link text-white">

                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#calendar3" /></svg>
                        {{ __('Agenda') }}

                    </a>
                </li>
                <li>
                    <a href="{{ route('billing') }}" class="nav-link text-white">

                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#collection" /></svg>
                        {{ __('Billing') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks') }}" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" /></svg>
                        {{ __('Tasks') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('statistics') }}" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#gear-fill" /></svg>

                        {{ __('Statistics') }}
                    </a>
                </li>
                @endrole


                @role('administrator')
                <li>
                    <a href="{{ route('users') }}" class="nav-link text-white">

                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" /></svg>
                        {{ __('Users') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('medicalestablishments') }}" class="nav-link text-white">

                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" /></svg>
                        {{ __('Medicalestablishments') }}

                    </a>
                </li>
                @endrole
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">

                    @role('patient')
                    <li><a class="dropdown-item" href="{{ route('settings') }}">{{ __('Settings') }}</a></li>
                    @endrole

                    @role('health-professional')
                    <li><a class="dropdown-item" href="{{ route('settings') }}">{{ __('Settings') }}</a></li>
                    @endrole

                    <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a></li>


                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>


        @endauth
        <div class="container-fluid"> 
            <div class="row justify-content-center mt-2">
                <div class="col-md-12"> 

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @yield('content')
                    <router-view></router-view>

                </div>
            </div>
        </div>

        </main>
    </div>
    @vite('resources/js/app.js')

</body>
</html>
