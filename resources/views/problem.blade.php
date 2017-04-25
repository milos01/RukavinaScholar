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
 <div class="wrapper wrapper-content animated fadeInRight">

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
                                                        @foreach($problem->solutions as $file)
                                                            <p>Your files are ready...</p>
                                                            <br/><a href="https://s3.amazonaws.com/kbk300test/{{$file->file->fileName}}" download="{{$file->file->fileName}}">{{$file->file->fileName}}</a>
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
                                <div class="col-md-7">

                                    <h2 class="font-bold m-b-xs">
                                        {{$problem->subject}}
                                    </h2>
                                    
                                    
                                       <div class="pull-right">
                                            
                                                <a href="{{url('/home')}}"  style="color: white"><button class="btn btn-danger btn-sm" style="margin-top: -60px"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to home </button></a>
                                           
                                        </div>
                                    <hr/>

                                    <h4>Task description</h4>

                                    <div class="">
                                        {{$problem->problem_description}}

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
                                        <dd>{{$problem->problem_type}}
                                        </dd>
                                    </div>
                                    <div class="m-t-md">
                                    @if(Auth::user()->is('regular'))
                                        @if($problem->took >= 1 && $problem->waiting == 0)
                                            <dt>Solver on your task</dt>
                                                <dd>
                                                <div class="container" style="margin-left:-15px">
                                                    <a href="/home/user/{{$problem->main_solver->id}}"><img src="../../img/{{$problem->main_solver->picture}}" width="30px" style="border-radius: 3px">
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
                                                    <a href="/home/user/{{$problem->user_from->id}}"><img src="../../img/{{$problem->main_solver->picture}}" width="30px" style="border-radius: 3px">
                                                        {{$problem->user_from->name}} {{$problem->user_from->lastName}}</a>
                                                </div>
                                            </dd>
                                        @endif
                                       
                                    </dl>
                                    <div class="m-t-md">
                                        <dt>Status</dt>
                                        @if($problem->took == 1 && $problem->waiting == 0)
                                            <dd><span><i class="fa fa-pencil" aria-hidden="true" style="color:black"></i> Under work...</span></dd>
                                        @elseif($problem->took == 2 && $problem->waiting == 0)
                                            <dd><span><i class="fa fa-check" aria-hidden="true" style="color:green"></i> Finised</span></dd>
                                        @elseif($problem->took == 0 && $problem->waiting == 1 || $problem->took == 0 && $problem->waiting == 0)
                                            <dd><span><i class="fa fa-clock-o" aria-hidden="true" style="color:black"></i> Pending...</span></dd>
                                     
                                        @endif
                                        
                                    </div>
                                    <div  class="m-t-md" style="border-top: 1px solid #fff; border-bottom: 1px solid #fff; height: 46px" ng-controller="bidingController" ng-init="init('{{$problem->id}}')" >
                                        <div id="offerPlace">
                                  
                                       </div>
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