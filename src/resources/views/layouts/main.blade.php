<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>{{ $title or 'School system R' }}</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="pink accent-2" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/') }}" class="brand-logo">School</a>
        <ul class="right hide-on-med-and-down">
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                @if (Auth::user()->isManager())
                    <li><a href="{{ url('/') }}">เข้าสู่หน้าจัดการ</a></li>
                @elseif(Auth::user()->isStudent())
                    <li><a href="{{ url('/') }}">ดูข้อมูลส่วนตัว</a></li>
                @elseif(auth()->user()->isTeacher())
                    <li><a href="{{ url('/') }}">เข้าสู่หน้าจัดการ</a> </li>
                    <li><a href="{{ url('/') }}">ดูตารางสอน</a></li>
                @endif
                <li><a href="#" class="dropdown-button"
                       data-activates='user_info'>ยินดีต้อนรับ {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        [{{ Auth::user()->getTextRole() }}]</a></li>
                <!-- Dropdown Structure -->
                <ul id='user_info' class='dropdown-content'>
                    <li><a href="{{ url('/logout') }}">ออกจากระบบ</a></li>
                </ul>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
            <li><a href="{{ url('/register') }}">สมัครสมาชิก</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
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
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>

</body>
</html>
