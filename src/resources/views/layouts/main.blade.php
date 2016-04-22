<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>{{ $title or 'School system R' }}</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/sweetalert.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
    <link href="{{ asset('css/jquery.seat-charts.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="pink accent-2" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/') }}" class="brand-logo">School</a>
        <ul class="right hide-on-med-and-down">
            @include('layouts.nav_header')
            @if(auth()->check())
            <li><a href="#" class="dropdown-button" data-activates='user_info'>ยินดีต้อนรับ {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    [{{ Auth::user()->getTextRole() }}]</a></li>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            @include('layouts.nav_header')
            @if(auth()->check())
            <li><a href="#" class="dropdown-button" data-activates='user_info2'>ยินดีต้อนรับ {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    [{{ Auth::user()->getTextRole() }}]</a></li>
            @endif
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="content">@yield('header')</div>
<div id="loading" class="container center-align">
    <br><br>
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<div class="section no-pad-bot" id="index-banner">
    <div class="content container">
        @if(url()->full() != url(''))
        @include('layouts.breadcrumbs')
        @endif
        @yield('content')
    </div>
</div>

@yield('container')

<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Company Bio</h5>
                <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's
                    our full time job. Any amount would help support and continue development on this project and is
                    greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            {{ PHP_Timer::resourceUsage() }}
        </div>
    </div>
</footer>


<!--  Scripts-->
<script>SITE_URL = '{{ url('/') }}/';TOKEN = '{!! csrf_token() !!}';</script>
<script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/jquery.seat-charts.min.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
    @if (count($errors) > 0)
        <script>
    var message = '';
    @foreach ($errors->all() as $error)
            message += "<p>{{ $error }}</p>";
    @endforeach
    $(document).ready(function () {
        swal({
            title: "ผิดพลาด!",
            text: message,
            html: true,
            type: 'error'
        });
    });
        </script>
    @endif
    @if(session('msg'))
        <script>
        $(document).ready(function () {
        swal({
        title: "ข้อความ",
        text: '{{ session('msg') }}',
        html: true,
        type: 'success',
        });
        });
        </script>
    @endif
@yield('script')
<script>
    $(document).ready(function() {
       @yield('script_ready')
    });
</script>

</body>
</html>
