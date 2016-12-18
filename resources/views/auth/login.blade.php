@extends('layouts.app')
@extends('layouts.master')
@section('head')
@endsection

@section('content')
<div class="container">


    <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-info" id="landing-panel-intro">
                <div class="landing-panel-body">
                <div class="landing-panel-text">
                    <div id='landing-panel-text'>
                    <h4>Welcome to your awesome To Do List.</h4>
                    <br>
                    <h5>Don't have an account?</h5>
                    <br>
                    <a class="btn btn-primary" href="/register">Register</a>
                    </div>
                </div>
                </div>
            </div>
        </div>

<!-- New Column -->
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-info" id="landing-panel">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
