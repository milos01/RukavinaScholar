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
								<h2 class="title">Sign Up</h2>
								<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" >
                  {{ csrf_field() }}
									<div class="form-group has-feedback" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
										<label for="inputName" class="col-sm-3 control-label">First Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputName" placeholder="Fisrt Name" name="name" value="{{ old('name') }}">
											<i class="fa fa-pencil form-control-feedback"></i>
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
										</div>
									</div>
									<div class="form-group has-feedback" class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
										<label for="inputLastName" class="col-sm-3 control-label">Last Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
											<i class="fa fa-pencil form-control-feedback"></i>
                      @if ($errors->has('last_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
										</div>
									</div>
									<div class="form-group has-feedback" class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
										<label for="inputUserName" class="col-sm-3 control-label">User Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputUserName" placeholder="Username" name="username" value="{{ old('username') }}">
											<i class="fa fa-user form-control-feedback"></i>
                      @if ($errors->has('username'))
                          <span class="help-block">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
										</div>
									</div>
									<div class="form-group has-feedback" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="inputEmail" class="col-sm-3 control-label">Email <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">
											<i class="fa fa-envelope form-control-feedback"></i>
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
										</div>
									</div>
									<div class="form-group has-feedback" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="inputPassword" class="col-sm-3 control-label">Password <span class="text-danger small">*</span></label>
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
                  <div class="form-group has-feedback" class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
										<label for="inputCPassword" class="col-sm-3 control-label">Confirm Password <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="inputCPassword" placeholder="Confirm Password" name="password_confirmation">
											<i class="fa fa-lock form-control-feedback"></i>
                      @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input type="checkbox" required> Accept our <a href="{{ route('privacyPolicy') }}">privacy policy</a> and <a href="{{ route('customerAgreement') }}">customer agreement</a>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<button type="submit" class="btn btn-group btn-default btn-animated">Sign Up <i class="fa fa-check"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
@endsection
