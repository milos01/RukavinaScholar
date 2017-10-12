@extends('admin')
@section('navName')
    Add problem
@stop
@section('navMenu') @parent
    <li>
       <a href="{{url('/home')}}">Home</a>
    </li>

    <li class="active">
        <strong>Submit task</strong>
    </li>
@stop
@section('manageUsers')
<div class="row" style="margin-top: 20px" ng-controller="newProblemController" ng-init="init()">
    <div class="col-lg-12" >
        <div id="showNewProblemForm" class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Submit new task</h5>
            </div>
            <div class="ibox-content">
                <form method="get" class="form-horizontal"  ng-submit="addProblemSubmit()" name="newProblemForm" novalidate>
                    <div class="form-group"><label class="col-sm-2 control-label">Problem name/type</label>
                        <div class="col-sm-10"><input type="text" class="form-control" ng-model="probName" style="width: 80%" required></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <div style="width:80%">
                                <summernote config="summernoteOptions" ng-model="probDescription" required></summernote>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Problem category</label>
                        <div class="col-sm-10" style="margin-top:7px">                 
                            <select name="multipleSelect" ng-model="answer" ng-required="!answer">
                                <option value="">Please select category</option>
                                <option ng-repeat="category in categories" value="<% category.id %>"><% category.name %></option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="hr-line-dashed"></div>

                <div class="form-group" id="uploadHolderr">
                    <div class="dropzone" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="margin-bottom: 53px">
                    <div class="col-sm-4 col-sm-offset-2">
                        <!-- <button class="btn btn-primary pull-left" ng-click="addProblemSubmit()" id="showSubmitButton"  ng-disabled="newProblemForm.$invalid" style="display: none;">Submit task</button> -->
                        <button class="btn btn-primary pull-left" ng-click="addProblemSubmit()" id="showSubmitButton2" ng-disabled="newProblemForm.$invalid || filesLoading" style="">Submit task</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="showProblemConfirm" style="display: none" >
            <div class="ibox-content" >
                <div class="middle-box text-center animated fadeInDown" style="max-width: 600px;">
                    <i class="fa fa-exchange fa-4x" aria-hidden="true"></i>

                    <h4>Your problem is our concern now, all you need to do is sit, relax and wait for your best offer.</h4>

                    <div class="error-desc" style="margin-bottom: 40px">
                        <br/><a href="/home" class="btn btn-primary">Back home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('chartTableJs') @stop