@extends('admin')
@section('navName')
Problem preview
@stop
@section('navMenu')

@parent
<li>
   <a href="{{url('/home')}}">Home</a>
</li>
<li class="active">
    <strong>{{$problem->subject}}</strong>
</li>
@stop
@section('manageUsers')
<div class="wrapper wrapper-content animated fadeInRight"  ng-controller="ProblemController" ng-init="init({{$problem->id}})">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox product-detail" >
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-lg-12">
                                <div class="widget style1">
                                    <div class="row">
                                        <div class="col-xs-8 text-left">
                                            <h2 class="font-bold">
                                               Task overview
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->is('regular'))
                                @if($problem->took == 2 && $problem->waiting == 0 && $problem->paid == 0)
                                    <div class="col-lg-12">
                                        <div class="widget  p-lg text-center">
                                            <div class="m-b-md">
                                                <i class="fa fa-flash fa-4x"></i>
                                                <h3 class="font-bold no-margins">
                                                    Your task was solved. Make payment to proceed.
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach($problem->solutions as $file)
                                    <a href="{{asset('solved_tasks/'.$file->fileName)}}" download="{{$file->fileName}}">
                                        <div class="col-lg-4">
                                            <div class="widget red-bg p-lg text-center">
                                                <div class="m-b-md">
                                                    <i class="fa fa-file fa-4x"></i>
                                                    <p>
                                                        <small> 
                                                            {{$file->fileName}}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                @endif
                            @else
                                @if(count($problem->files) != 0)
                                    @foreach($problem->files as $file)
                                        <a href="{{asset('new_tasks/'.$file->fileName)}}" download="{{$file->fileName}}">
                                        <div class="col-lg-4">
                                            <div class="widget lazur-bg p-lg text-center">
                                                <div class="m-b-md">
                                                    <i class="fa fa-file fa-4x"></i>
                                                    <p>
                                                        <small> 
                                                            {{$file->fileName}}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="col-lg-12">
                                        <div class="widget  p-lg text-center">
                                            <div class="m-b-md">
                                                <i class="fa fa-flash fa-4x"></i>
                                                <h3 class="font-bold no-margins">
                                                    No files uploaded.
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                    <div class="col-md-7" style="border-left: 1px solid #eaeaea">
                        <div class="col-lg-6">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-question fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        (<span timer-directive problem="prob" user="{{Auth::user()}}" ng-if="dataHasLoaded"></span>) <span><u>Task name</u></span>

                                        <h2 class="font-bold">
                                            {{$problem->subject}}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span><u>Posted at</u></span>
                                        <h2 class="font-bold">{{$problem->created_at->format('m/d/Y')}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <i class="fa fa-info fa-5x"></i>
                                    </div>
                                    <div class="col-xs-11 text-left">
                                        <span><u>Task description</u></span>
                                        <span class="font-bold">{!! $problem->problem_description !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="widget lazur-bg p-xs">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <h3>
                                            <u>Task type:</u> {{$problem->task_type->name}}
                                        </h3>
                                    </div>
                                    <div class="col-xs-7">
                                        <h4>
                                            <span bidding-directive problem="prob" user="{{Auth::user()}}" ng-if="dataHasLoaded"></span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            @if(Auth::user()->is('regular'))
                                @if($problem->took >= 1 && $problem->waiting == 0)
                                    <div class="widget yellow-bg p-lg text-center">
                                        <div class="m-b-md">
                                            <i class="fa fa-user fa-4x"></i>
                                            
                                            <h3 class="font-bold no-margins">
                                                {{$problem->mainSolver->name}} {{$problem->mainSolver->lastName}} <img src="{{asset('avatars/'.Auth::user()->picture)}}" width="30px" style="border-radius: 50%;margin-top: -3px;">
                                            </h3>
                                            <small><u>Solver on task</u></small>
                                        </div>
                                    </div>
                                @endif
                            @else
                            <div class="widget yellow-bg p-lg text-center">
                                <div class="m-b-md">
                                    <i class="fa fa-user fa-4x"></i>
                                    
                                    <h3 class="font-bold no-margins">
                                        {{$problem->user_from->name}} {{$problem->user_from->lastName}} <img src="{{asset('avatars/'.Auth::user()->picture)}}" width="30px" style="border-radius: 50%;margin-top: -3px;">
                                    </h3>
                                    <small><u>User from</u></small>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                        @if(!Auth::user()->is('regular') && count($problem->solutions) != 0)
                        <div class="col-lg-12">
                            <div class="widget style1 red-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-file-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Solution files </span>
                                        <h2 class="font-bold" ng-bind="prob.solutions.length"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                    </div>
                 </div>

             </div>

         </div>

     </div>
     @if(!Auth::user()->is('regular'))
     <div class="row" ng-if="dataHasLoaded" ng-cloak>
        <div class="col-lg-12" ng-controller="newProblemController" ng-init="init(prob, {{Auth::user()}})">
            <div class="ibox float-e-margins" ng-show="showSolutionDropzone">
                <div class="ibox-content">
                    <form class="form-horizontal" ng-submit="addSolutionSubmit(prob)" name="newProblemForm" novalidate>
                        <div>
                            <span>
                                <div class="col-lg-12 text-center" style="padding: 20px 0px"><h3>Upload solution files for task below</h3></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <div style="width:80%">
                                            <summernote config="summernoteOptions" ng-model="probDescription" required></summernote>
                                        </div>
                                    </div>
                                </div>
                                <div id="solution_dropzone" class="dropzone" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div>
                                <input type="hidden" id="taskType" value="solution">
                            </span>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group" style="margin-bottom: 53px">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary pull-left" type="submit" id="showSubmitButton2" ng-disabled="newProblemForm.$invalid || filesLoading" style="">Submit task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@stop
@section('chartTableJs')
@stop