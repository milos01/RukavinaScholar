@extends('layouts.app')

<!-- Main Content -->
@section('content')
<section class="light-gray-bg pv-30 clearfix">
                <div class="container">
                    <!-- <div class="row"> -->
                        
                        <div class="" ng-controller="reserPasswrdController">
                            <div class="pv-30 ph-20 feature-box bordered shadow text-center">
                                <span class="icon default-bg circle"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                                <h3>Reset Password</h3>
                                <div class="separator clearfix"></div>
                                <p>Enter you email address below</p>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form class="form-horizontal" name="resetForm" role="form" method="POST" ng-submit="resetFormSubmit()">
                                    {!! csrf_field() !!}

                                    <div class="form-group" ng-class="{ 'has-error' : resetForm.resetEmilAdderss.$error.userex && !resetForm.resetEmilAdderss.$pristine }">
                                        <label class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="resetEmilAdderss" ng-model="resetEmilAdderss" ng-change="findUser()" autocomplete="off" required>
                                            <label class="pull-right" style="margin-top:-30px;margin-right:10px;color:#a94442" ng-show="resetForm.resetEmilAdderss.$error.userex" ng-cloak>email not exist</label>
                                        </div>                                       
                                    </div>
                                    <div class="form-group" >
                                        <div class="">
                                            <button type="submit" class="btn btn-primary" ng-disabled="resetForm.$invalid">
                                                <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link <i class="fa fa-spinner fa-spin fa-1x fa-fw" ng-show="showLoadMailIcon" ng-cloak></i>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
</section>
@endsection
