@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h4 class="header">Login</h4>
        <form class="col s12" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="row">

                <div class="input-field col s12">
                    <div class="row">
                        <input id="email" type="email" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}">
                        <label for="email">E-Mail Address</label>
                        @if ($errors->has('email'))
                            <span class="helper-text">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="input-field col s12">
                    <div class="row">
                        <input id="password" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password">
                        <label for="password" >Password</label>
                        @if ($errors->has('password'))
                            <span class="helper-text">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <p>
                    <label>
                        <input type="checkbox" name="remember">
                        <span>Remember Me</span>
                    </label>
                </p>
                <a href="/register" class="hint">Don't have an account? Join now</a>
                <button type="submit" class="btn waves-effect waves-light">Login</button>

            </div>
        </form>
    </div>
</div>
@endsection
