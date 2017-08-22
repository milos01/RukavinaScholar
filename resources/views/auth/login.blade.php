@extends('layouts.app')
@section('homeLink')
    <li class="hidden-sm hidden-xs pull-right" style="margin-left: 10px"><a href="{{ url('/') }}" class="link-light">Home</a></li>
@endsection
@section('topMenuItems')
@endsection
@section('content')
<!-- <div class="container">
    <div class="row" style="padding: 30px">
        <div class="col-md-8 col-md-offset-2">
            <hr/>
            <div>
                <div class="panel-body">
                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">  
                                <div>
                                    <a href="{{ url('/auth/facebook') }}" type="button" class="btn btn-default" style="background: #4267b2; border-color:#4267b2; padding:10px 20px;width: 230px; width: 100%">Loging with Facebook</a>
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

                                <a class="btn btn-link" href="{{ url('/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- main-container start -->
            <!-- ================ -->
            <div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if (session('warning'))
                                    <div class="alert alert-warning">
                                        {{ session('warning') }}
                                    </div>
                                @endif
                                <h2 class="title">Login</h2>
                                <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group has-feedback">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="inputUserName" class="col-sm-3 control-label">User Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputUserName" placeholder="Username" name="email" value="{{ old('email') }}">
                                                <i class="fa fa-user form-control-feedback"></i>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                                                <i class="fa fa-lock form-control-feedback"></i>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <div class="checkbox">
                                                <label>
                                                     <input type="checkbox" name="remember"> Remember Me
                                                </label>
                                            </div>                                          
                                            <button type="submit" class="btn btn-group btn-default btn-animated">Log In <i class="fa fa-user"></i></button>
                                            <ul class="space-top">
                                                <li><a href="{{ url('/reset') }}">Forgot your password?</a></li>
                                            </ul>
                                            <span class="text-center text-muted">Login with</span>
                                            <ul class="social-links colored circle clearfix">
                                                <li class="facebook"><a target="_blank" href="{{ url('/auth/facebook') }}"><i class="fa fa-facebook"></i></a></li>
                                                <!-- <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                                <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="text-center space-top">Don't have an account yet? <a href="page-signup.html">Sing up</a> now.</p>
                        </div>
                        <!-- main end -->
                    </div>
                </div>
            </div>
            <!-- main-container end -->
@endsection
