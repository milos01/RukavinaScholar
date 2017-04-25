@extends('admin')
@section('navName')
	Problem preview
@stop
@section('navMenu')

    @parent
     <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
     <li>
         <a href="{{url('/home/assigned')}}">Assigned</a>
     </li>
    <li class="active">
        <strong>{{$problem->subject}}</strong>
    </li>                
@stop
@section('manageUsers')
 <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-5">


                                    <div class="product-images">

                                        <div>
                                            <div class="image-imitation">
                                                <!-- [media type(video, text doc, string)] -->
                                                <i class="fa fa-cloud-download fa-5x" aria-hidden="true" style="position: relative;color:#686b6d"></i>
                                                @if(count($problem->files) != 0)
                                                    @foreach($problem->files as $file)
                                                        <br><a href="https://s3.amazonaws.com/kbk300test/{{$file->file->fileName}}" download="{{$file->file->fileName}}">{{$file->file->fileName}}</a><br/>
                                                    @endforeach
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
                                    <small></small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price"><small class="text-muted"></small> </h2>
                                    </div>
                                    <hr>

                                    <h4>Problem description</h4>

                                    <div class="">
                                        {{$problem->problem_description}}

                                        <br/>
                                        <br/>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </div>
                                    <dl class="m-t-md">
                                        <dt>From</dt>
                                        <dd>{{$problem->user_from->name}} {{$problem->user_from->lastName}}</dd>
                                       
                                    </dl>
                                    <hr>
                                        @if($problem->main_slovler == Auth::id())
                                        <dl class="m-t-md">
                                            <dt>Main solver</dt>
                                            <dd>You</dd>
                                        </dl>

                                        <div class="small text-muted" ng-controller="userSearchController">
                                            <dt>Search for moderators (find co-worker for this task)</dt>
                                            <input type="text" id="searchInput" class="form-control" style="margin-bottom:20px;width:254px" ng-model="keywords" ng-change="search()">
                                            <input type="hidden" value="{{$problem->id}}" id="problemId">
                                            <div id="itemsHolder" style="position: absolute;height: 120px;margin-top:-54px;margin-left:250px;">
                                            @foreach($problem->users as $user)
                                                @if($user->id != Auth::user()->id)
                                                <div class="" id="menuSearchItem{{$user->id}}plus{{$problem->id}}" style="border-bottom:2px solid red;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px ">
                                                    {{$user->name}} {{$user->lastName}} 
                                                <i class="fa fa-times" aria-hidden="true" style="cursor:pointer" ng-click="deleteWorker({{$problem->id}},{{$user->id}})"></i></div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    
                                    
                                        
                                        <div id="resDiv" style="width:254px;max-height:200px;position: absolute;margin-top:-17px;z-index: 999;background-color: white;">
                                            
                                                
                                            
                                            
                                        </div>
                                        @else
                                        <dl class="m-t-md">
                                            <dt>Main solver</dt>
                                            <dd>{{$problem->main_solver->name}} {{$problem->main_solver->lastName}}</dd>
                                       
                                        </dl>
                                        <dl class="m-t-md">
                                            <dt>Other people on this problem</dt>
                                            <dd>
                                            @foreach($problem->users as $user)
                                                @if($user->id != $problem->main_solver->id)

                                                    @if($user == $problem->users->last())
                                                        @if(Auth::user()->id == $user->id)
                                                            <strong><i>You &nbsp;</i></strong>
                                                        @else
                                                            <strong><i>{{$user->name}} {{$user->lastName}}</i></strong> &nbsp;
                                                        @endif
                                                    @else
                                                        @if(Auth::user()->id == $user->id)
                                                            <strong><i>You, &nbsp;</i></strong>
                                                        @else
                                                            <strong><i>{{$user->name}} {{$user->lastName}},</i></strong> &nbsp;
                                                        @endif
                                                    @endif
                                                   
                                                @endif
                                            @endforeach
                                            </dd>
                                       
                                        </dl>
                                        @endif
                                    <div>
                                        <div class="btn-group">
                                            <!-- <button class="btn btn-white btn-sm"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="{{url('home/takeProblem',$problem->id)}}" style="color:#676A6C"> Take it</a></button> -->
                                            <a href="{{url('/home/assigned')}}" class="btn btn-danger btn-sm" type="button"><i class="fa fa-angle-left" aria-hidden="true" ></i> Back to problems </a>
                                            @if($problem->main_slovler == Auth::id())
                                                <a href=""  ng-controller="MyCtrldd" class="btn btn-success btn-sm" type="button" ng-click="showDetails()"><i class="fa fa-check" aria-hidden="true" ></i> Post solution </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="container" style="margin-left: -15px;margin-top: 15px;" >
                                        @foreach($problem->solutions as $solution)
                                            @if(substr($solution->file->fileName, -3) == "mp3")
                                                <div class="container pull-left" style="margin-left:-15px;width:60px">
                                                    <i class="fa fa-file-audio-o fa-3x" aria-hidden="true" style="color:#c5c5c5"></i>
                                                    <p style="margin-left: 3px">{{substr($solution->file->fileName, -3)}}</p>
                                                </div>
                                            @elseif(substr($solution->file->fileName, -3) == "pdf")
                                            @else
                                                <div class="container pull-left" style="margin-left:-15px;width:60px" >
                                                    <i class="fa fa-file-o fa-3x" aria-hidden="true" style="color:#c5c5c5"></i>
                                                    <p style="margin-left: 3px">{{substr($solution->file->fileName, -3)}}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    


                                </div>
                            </div>

                        </div>
                     
                    </div>

                </div>
                <div class="col-lg-12 modUpdate" style="display: none">
                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row" ng-controller="dropzoneSolutionController">
                                <div class="form-group" id="uploadHolder2">
                                 <p style="margin-left: 10px;font-weight: bold">Upload solution</p>
                                    <form action="/home/api/application/uploadSolution" class="dropzone" id="dropzoneForm2" style="border: 1px dashed gray;width:99%;margin:auto auto;border-radius: 3px;background: #ececec" enctype="multipart/form-data" >
                                        <div class="fallback">
                                           <input name="file" type="file" id="fileSelected" ng-mdoel="aa" multiple />
                                        </div>
                                         <input type="hidden" name="prob_id" value="{{$problem->id}}"/> 
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>



        </div>
        <div id="filesHolder"></div>
@stop