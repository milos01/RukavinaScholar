@extends('layouts.app')
@section('homeLink')
    <li class="hidden-sm hidden-xs pull-right" style="margin-left: 10px"><a href="{{ url('/') }}" class="link-light">Home</a></li>
@endsection
@section('content')
<div class="container">
    <div class="row" style="padding: 30px">
        <div class="col-md-8 col-md-offset-2">
            <hr/>
            <div>
                <div class="panel-body">
                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">  
                                <div>
                                    <a href="#" type="button" class="btn btn-default" style="background: #4267b2; border-color:#4267b2; padding:10px 20px;width: 230px; width: 100%">Loging with Facebook</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <div>
                                    <a href="#" type="button" class="btn btn-default" style="background: #1ab7ea; border-color:#1ab7ea; padding:10px 20px;width: 230px; width: 100%">Login with Twitter
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <div>
                                    <a href="#" type="button" class="btn btn-default" style="background: #cf4332; border-color:#cf4332; padding:10px 20px;width: 230px; width: 100%">Login with Google</a>
                                </div>
                            </div>
                        </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                                <input id="password" type="password" class="form-control" name="password">

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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
