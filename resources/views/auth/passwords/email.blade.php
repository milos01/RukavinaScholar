@extends('layouts.app')
@section('topMenu')
@parent
  @section('homeLink')
      <li class="hidden-sm hidden-xs pull-right" style="margin-left: 10px"><a href="{{ url('/') }}" class="link-light">Home</a></li>
  @endsection
  @section('topMenuItems')
    @parent
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
                                <h2 class="title">Password reset</h2>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
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

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-group btn-default btn-animated">Send Password Reset Link <i class="fa fa-btn fa-envelope"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- main end -->
                    </div>
                </div>
            </div>
            <!-- main-container end -->
@endsection
