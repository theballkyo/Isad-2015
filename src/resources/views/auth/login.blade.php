@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s8">
            <h4>Login</h4>
            <form class="col s12" action="{{ url('/login') }}" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="email" id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">email</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input name="password" id="icon_vpn_key" type="password" class="validate">
                        <label for="icon_vpn_key">Password</label>
                    </div>
                    <button class="col s3 offset-s9 btn waves-effect waves-light right" type="submit" name="action">
                        เข้าสู่ระบบ
                        <i class="material-icons right">send</i>
                    </button>
                    <a href="{{ url('/register') }}" class="col s3 offset-s9 btn-flat right">หรือสมัครสมาชิกได้ที่นี้</a>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
        <div class="col s4">
            @if (count($errors) > 0)
                <p>
                <ul class="collection">
                    @foreach ($errors->all() as $error)
                        <li class="collection-item red accent-3 white-text">{{ $error }}</li>
                    @endforeach
                </ul>
                </p>
            @endif
        </div>
    </div>

@endsection
