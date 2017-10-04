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
                                        @foreach($problem->solutions as $key=>$file)
                                        <br/><a href="https://s3.amazonaws.com/kbk300test/{{$file->file->fileName}}" download="{{$file->file->fileName}}">Solution File {{$key+1}} </a>
                                        @endforeach
                                        @else
                                        <p>You uploaded {{count($problem->files)}}
                                            @if(count($problem->files) == 1)
                                        file.</p>
                                        @else
                                    files.</p>
                                    @endif
                                    @endif
                                    @else
                                    @foreach($problem->files as $file)
                                    <br/><a href="https://s3.amazonaws.com/kbk300test/{{$file->file->fileName}}" download="{{$file->file->fileName}}">{{$file->file->fileName}}</a>
                                    @endforeach
                                    @endif
                                    @else
                                    <p>No files uploaded.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"  ng-repeat="prob in problems">
                        <h2 class="font-bold m-b-xs">
                            {{$problem->subject}}
                            <span timer-directive problem="prob"></span>
                        </h2>
                        <div class="pull-right">
                            <a href="{{url('/home')}}"  style="color: white"><button class="btn btn-danger btn-sm" style="margin-top: -60px"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to home </button></a>
                        </div>
                        <hr/>
                        <h4>Task description</h4>
                        <div>
                            <% prob.problem_description %>
                            <!-- {!! $problem->problem_description !!} -->
                            <br/>
                            <br/>
                        </div>
                        <div class="m-t-md">
                            <dt>Posted</dt>
                            <dd>{{$problem->created_at->format('m/d/Y')}}
                            </dd>
                        </div>
                        <div class="m-t-md">
                            <dt>Task type</dt>
                            <dd>{{$problem->task_type->name}}
                            </dd>
                        </div>
                        <div class="m-t-md">
                            @if(Auth::user()->is('regular'))
                            @if($problem->took >= 1 && $problem->waiting == 0)
                            <dt>Solver on your task</dt>
                            <dd>
                                <div class="container" style="margin-left:-15px">
                                    <a href="/home/user/{{$problem->main_solver->id}}"><img src="{{asset('avatars/'.Auth::user()->picture)}}" width="30px" style="border-radius: 50%">
                                        {{$problem->main_solver->name}} {{$problem->main_solver->lastName}}
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
                                    <span problem-show-directive problem="prob" user="{{Auth::user()}}"></span> 
                                </dd>
                            </div>
                            <div class="m-t-md">
                                @if($problem->took == 2 && $problem->solution_description)
                                <dt>Solution description</dt>
                                <div class="col-md-9" style="background:#f3f3f4; padding:10px 20px">
                                 {!! $problem->solution_description !!}
                             </div>
                             @endif
                         </div>
                         <div  class="m-t-md" style="border-top: 1px solid #fff; border-bottom: 1px solid #fff; height: 46px" bidding-directive problem="prob" user="{{Auth::user()}}">
                         </div>
                     </div>
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