@extends('admin')
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
    <li class="active">
    	<strong>Profile</strong>
    </li>                
@stop
@section('manageUsers')
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
	<div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Basic info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Security</a></li>
                        
                    </ul>
                    <div class="tab-content" ng-controller="editUserInfoController" ng-init="init({{Auth::user()}})">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="contianer pull-left" style="">
                                    <img src="{{asset('avatars/'.Auth::user()->picture)}}">
                                    <form action="{{route('saveImage')}}" method="POST" enctype="multipart/form-data"/>
                                        <input name="file" type="file" style="max-width: 200px;margin-top: 3px" value="Choose image" data-input="false" multiple /> 
                                        <input type="submit" class="btn btn-primary btn-xs" style="width: 200px; margin-top: 5px" value="Upload picture">   
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/> 
                                    </form>
                                </div>
                            	<form action="{{route('updateUser')}}" method="POST" name="editBasicInfoForm" novalidate>
                                    <fieldset class="form-horizontal">
                                        <div class="form-group" ng-class="{ 'has-error' : editBasicInfoForm.firstName.$invalid && !editBasicInfoForm.firstName.$pristine }"><label class="col-sm-2 control-label">First name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="firstName" ng-model="firstName" capitalize-first required>
                                                 <p ng-show="editBasicInfoForm.firstName.$error.required && !editBasicInfoForm.firstName.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px" ng-cloak>Your first name is required</p>
                                            </div>
                                        </div>
                                       
        
                                        <div class="form-group" ng-class="{ 'has-error' : editBasicInfoForm.lastName.$invalid && !editBasicInfoForm.lastName.$pristine}">
                                            <label class="col-sm-2 control-label">Last name</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="lastName" ng-model="lastName" capitalize-first required>
                                            <p ng-show="editBasicInfoForm.lastName.$error.required && !editBasicInfoForm.lastName.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px" ng-cloak>Your last name is required</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-10" style="margin-left:10px;">
                                            <button class="btn btn-primary pull-right" type="submit" ng-disabled="editBasicInfoForm.$invalid">Edit info</button>
                                        </div>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    </fieldset>
                                </form>
                                <form action="{{route('updateUsername')}}" method="POST" name="editUsername" style="margin-top: 20px" novalidate>
                                    <fieldset class="form-horizontal">
                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}" ng-class="{ 'has-error' : editUsername.username.$invalid && !editUsername.username.$pristine}">
                                            <label class="col-sm-2 control-label">Username</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="username" ng-model="username" required>
                                            <p ng-show="editUsername.username.$error.required && !editUsername.username.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px" ng-cloak>Your username is required</p>
                                            </div>
                                            @if ($errors->has('username'))
                                                <p class="help-block" style="color: red">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-sm-10" style="margin-left:10px;">
                                            <button class="btn btn-primary pull-right" type="submit" ng-disabled="editUsername.$invalid">Change username</button>
                                        </div>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            <form action="{{route('updatePassword')}}" method="POST" name="editPasswordForm" novalidate>
                                <fieldset class="form-horizontal">
                                    <div class="form-group" ng-class="{ 'has-error' : editPasswordForm.oldPassword.$invalid && !editPasswordForm.oldPassword.$pristine }"><label class="col-sm-2 control-label">Old password</label>
                                        <div class="col-sm-8"><input type="password" class="form-control" name="oldPassword" ng-model="user.oldPassword" autocomplete="off" required>
                                        <p ng-show="editPasswordForm.oldPassword.$error.required && !editPasswordForm.oldPassword.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Your current password is required</p>
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : editPasswordForm.newPassword.$invalid && !editPasswordForm.newPassword.$pristine }"><label class="col-sm-2 control-label">New password</label>
                                        <div class="col-sm-8"><input type="password" class="form-control" name="newPassword" ng-model="user.newPassword" required>
                                            <p ng-show="editPasswordForm.newPassword.$error.required && !editPasswordForm.newPassword.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Your new password is required</p>
                                            @if ($errors->has('newPassword'))
                                                <p class="help-block" style="color: red">
                                                    <strong>{{ $errors->first('newPassword') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{ 'has-error' : editPasswordForm.repPassword.$invalid && !editPasswordForm.repPassword.$pristine }"><label class="col-sm-2 control-label">Repeat password</label>
                                        <div class="col-sm-8"><input type="password" class="form-control" name="repPassword" ng-model="user.repPassword" required>
                                            <p ng-show="editPasswordForm.repPassword.$error.required && !editPasswordForm.repPassword.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Repeat password is required</p>
                                            @if ($errors->has('repPassword'))
                                                <p class="help-block" style="color: red">
                                                    <strong>{{ $errors->first('repPassword') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-10" style="margin-left:10px;">
                                    	<button type="submit" class="btn btn-primary pull-right" ng-disabled="editPasswordForm.$invalid">Change password</button>
                                    </div>
                                </fieldset>
                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                            </form>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div> 
    </div>
</div>
@stop
@section('chartTableJs')
@stop
