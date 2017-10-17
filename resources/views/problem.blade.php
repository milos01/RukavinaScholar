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
                            <div class="product-images">
                                <div>
                                    <div class="image-imitation">
                                        <!-- [media type(video, text doc, string)] -->
                                        <i class="fa fa-cloud-download fa-5x" aria-hidden="true" style="position: relative;color:#686b6d"></i>
                                        @if(count($problem->files) != 0 || count($problem->solutions) != 0)
                                            @if(Auth::user()->is('regular'))
                                                @if($problem->took == 2 && $problem->waiting == 0)
                                                    <p>Your files are ready...</p>
                                                    
                                                @else
                                                    <p>You uploaded {{count($problem->files)}}
                                                    @if(count($problem->files) == 1)
                                                        file.</p>
                                                    @else
                                                        files.
                                                    @endif
                                                @endif
                                            @else
                                                @foreach($problem->files as $file)
                                                    <br/>
                                                    <a href="{{asset('new_tasks/'.$file->fileName)}}" download="{{$file->fileName}}">
                                                        {{$file->fileName}}
                                                    </a>
                                                @endforeach
                                            @endif
                                        @else
                                        <p>No files uploaded.</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <h2 class="font-bold m-b-xs">
                            {{$problem->subject}} ({{$problem->task_type->name}})
                            <span timer-directive problem="prob" user="{{Auth::user()}}" ng-if="dataHasLoaded"></span>
                        </h2>
                        <div class="pull-right">
                            <a href="{{url('/home')}}"  style="color: white"><button class="btn btn-danger btn-sm" style="margin-top: -60px"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to home </button></a>
                        </div>
                        <hr/>
                        <h4>Task description</h4>
                        <div>
                            {!! $problem->problem_description !!}
                            <br/>
                            <br/>
                        </div>
                        <div class="m-t-md">
                            <dt>Posted</dt>
                            <dd>{{$problem->created_at->format('m/d/Y')}}
                            </dd>
                        </div>
                        <div class="m-t-md">
                            @if(Auth::user()->is('regular'))
                            @if($problem->took >= 1 && $problem->waiting == 0)
                            <dt>Solver on your task</dt>
                            <dd>
                                <div class="container" style="margin-left:-15px">
                                    <a href="/home/user/{{$problem->mainSolver->id}}"><img src="{{asset('avatars/'.Auth::user()->picture)}}" width="30px" style="border-radius: 50%">
                                        {{$problem->mainSolver->name}} {{$problem->mainSolver->lastName}}
                                    </a>
                                </div>
                            </dd>
                            @endif
                            @endif
                        </div>
                        <dl class="m-t-md">
                            @if(!Auth::user()->is('regular'))
                            <dt>From</dt>
                            <dd>
                                <div class="container" style="margin-left:-15px">
                                    <a href="/home/user/{{$problem->user_from->id}}"><img src="{{asset('avatars/'.Auth::user()->picture)}}" width="30px" style="border-radius: 50%">
                                        {{$problem->user_from->name}} {{$problem->user_from->lastName}}</a>
                                    </div>
                                </dd>
                            @endif
                        </dl>
                            <div class="m-t-md">
                                <dt>Status</dt>
                                <dd>

                                    <span problem-show-directive problem="prob" user="{{Auth::user()}}" ng-if="dataHasLoaded"></span> 
                                </dd>
                            </div>
                         <div  class="m-t-md" style="border-top: 1px solid #fff; border-bottom: 1px solid #fff; height: 46px" bidding-directive problem="prob" user="{{Auth::user()}}" ng-if="dataHasLoaded">
                         </div>
                     </div>
                 </div>

             </div>

         </div>

     </div>
 </div>
 @if(!Auth::user()->is('regular'))
 <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content form-horizontal">
                <div class="form-group">
                    <div class="col-lg-12 text-center" style="padding: 20px 0px"><h3>Uploaded solutions for task</h3></div>
                    <div class="col-md-1" ng-repeat="solution in prob.solutions">
                        <i class="fa fa-file-o fa-3x" aria-hidden="true"  uib-tooltip="<% solution.fileName | limitTo: 10 %>..." tooltip-placement="bottom"></i>
                        <!-- <span class="bagde" ng-cloak>(<% solution %>)</span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
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
</div>
@stop
@section('chartTableJs')
@stop