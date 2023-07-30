<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('images/logo.png') }}" />
    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Datepicker -->
    <script src="{{ asset('js/datepicker.js') }}" ></script>
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet"> 

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('karyawan') }}">{{ __('Karyawan') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('absensi') }}">{{ __('Absensi') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('payroll') }}">{{ __('Payroll') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main class="pt-3">
            <div class="container-fluid px-4">                   
                @if ($message = Session::get('success'))
                    <div class="position-fixed top-1 end-0 pe-2">
                        <div class="toast fade show align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check-circle fs-3 ps-3"></i>
                                <div class="toast-body ps-2 fs-5">
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif                 
                @if ($message = Session::get('error'))
                    <div class="position-fixed top-1 end-0 pe-2">
                        <div class="toast fade show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-exclamation-triangle fs-3 ps-3"></i>
                                <div class="toast-body ps-2 fs-5">
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif 
                @yield('content')
            </div>
        </main>
    </div>

<script type="text/javascript">
$(document).ready(function() { 
    /* ----- Tooltip ------ */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    /* ----- Date Picker ------ */
    var $startDate = $('.start-date');
    var $endDate = $('.end-date');
    $startDate.datepicker({
        autoHide: true,
        format: 'yyyy-mm-dd',
    });
    $endDate.datepicker({
        autoHide: true,
        format: 'yyyy-mm-dd',
        startDate: $startDate.datepicker('getDate'),
    });
    $startDate.on('change', function () {
        $endDate.datepicker('setStartDate', $startDate.datepicker('getDate'));
        if(Date.parse($startDate.val()) > Date.parse($endDate.val())){
            $endDate.val('')
        }
    });
    $('.datepicker').datepicker({
        autoHide: true,
        format: 'yyyy-mm-dd',
    });
    $('.datepicker-modal').datepicker({
        autoHide: true,
        format: 'yyyy-mm-dd',
        zIndex: 2060,
    });
    /* ----- toast Auto Hide ------ */
    var myToastEl = document.querySelector('.toast');
    var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl); // console.log(myToast._element);  
    if(myToast._element){
        setTimeout(function() {
            myToast.dispose();
        }, 4000);
    }
});
</script>

</body>
</html>
