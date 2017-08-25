@extends('layouts.app')
@section('topMenu')
@parent
  @section('homeLink')
      <li class="hidden-sm hidden-xs pull-right" style="margin-left: 10px"><a href="{{ url('/') }}" class="link-light">Home</a></li>
  @endsection
  @section('topMenuItems')
  @endsection
@endsection
@section('content')
            <!-- ================ -->
            <div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">
                                @if (session('status'))
                                    <div class="alert alert-success" style="background: rgba(33, 187, 157, 0.1);">
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
                                            <label for="inputUserName" class="col-sm-3 control-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputUserName" placeholder="Username or email" name="email" value="{{ old('email') }}">
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
                            <p class="text-center space-top">Don't have an account yet? <a href="{{url('register')}}">Sing up</a> now.</p>
                        </div>
                        <!-- main end -->
                    </div>
                </div>
            </div>
            <!-- main-container end -->
@endsection
