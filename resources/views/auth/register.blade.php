@extends('layouts.app')

<!-- Main Content -->
@section('content')
<section class="light-gray-bg pv-30 clearfix">
                <div class="container">
                    <!-- <div class="row"> -->
                        
                        <div ng-controller="registerController">
                            <div class="pv-30 ph-20 feature-box bordered shadow text-center">
                                <span class="icon default-bg circle"><i class="fa fa-btn fa-user"></i></span>
                                <h3>Registration</h3>
                                <div class="separator clearfix"></div>
                                <p>Enter basic information about yourself</p>


                                <form class="form-horizontal" name="registerForm" ng-submit="registerUserForm()" novalidate>
                                    {!! csrf_field() !!}

                                    <div class="form-group" ng-class="{ 'has-error' : registerForm.name.$invalid && !registerForm.name.$pristine }">
                                        <label class="col-md-4 control-label">First name</label>

                                        <div class="col-md-4"> 
                                            <input type="text" class="form-control" name="name" ng-model="user.name" required>
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : registerForm.last_name.$invalid && !registerForm.last_name.$pristine }">
                                        <label class="col-md-4 control-label">Last name</label>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="last_name" ng-model="user.last_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : registerForm.email.$invalid && !registerForm.email.$pristine }">
                                        <label class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-4">
                                            <input type="email" class="form-control" name="email" ng-model="user.email" required>
                                        </div>
                                    </div>

                                    <div class="form-group" ng-class="{ 'has-error' : registerForm.password.$invalid && !registerForm.password.$pristine }">
                                        <label class="col-md-4 control-label">Password</label>

                                        <div class="col-md-4">
                                            <input type="password" class="form-control" name="password" ng-model="user.password" password-length password-verify="user.password_confirmation" required>
                                        </div>
                                        <p ng-show="registerForm.password.$error.passlen && !editPasswordForm.password.$error.required" style="font-size:14px;margin-right:28px;color:#ed5565;margin-top:-28px">Password must be in between 4 and 10 chars</p>
                                    </div>

                                    <div class="form-group" ng-class="{ 'has-error' : registerForm.password_confirmation.$invalid && !registerForm.password_confirmation.$pristine }">
                                        <label class="col-md-4 control-label">Confirm Password</label>

                                        <div class="col-md-4">
                                            <input type="password" class="form-control" name="password_confirmation" ng-model="user.password_confirmation" password-verify="user.password" required>
                                        </div>
                                        <p ng-show="registerForm.password_confirmation.$error.passwordVerify && !registerForm.password_confirmation.$error.required" style="font-size:14pxmargin-right:28px;color:#ed5565;margin-top:-28px">Passwords not same</p>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary" ng-disabled="registerForm.$invalid">
                                                <i class="fa fa-btn fa-user"></i> Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
</section>
@endsection
