@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="row">
        <h4 class="header">Register</h4>
        <form class="col s12" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s6">
                    <input id="name" type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @if ($errors->has('name'))
                        <span class="helper-text">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="input-field col s6 ">
                    <input id="email" type="email" class="validate {{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}">
                    <label for="email" >E-Mail Address</label>
                    @if ($errors->has('email'))
                        <span class="helper-text">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="input-field col s6">
                    <input id="password" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password">
                    <label for="password" >Password</label>
                    @if ($errors->has('password'))
                        <span class="helper-text">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="input-field col s6">
                    <input id="password-confirm" type="password" class="validate {{ $errors->has('password_confirmation') ? ' invalid' : '' }}" name="password_confirmation">
                    <label for="password-confirm" >Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="helper-text">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="col s12">
                    <a href="/login" class="hint">Already registered? Sign in</a>
                    <button type="submit" class="btn waves-effect waves-light">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
