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
                                                [media type(video, text doc, string)]
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

                                    <div class="small text-muted">
                                        {{$problem->problem_description}}

                                        <br/>
                                        <br/>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </div>
                                    <dl class="small m-t-md">
                                        <dt>From</dt>
                                        <dd>{{$problem->user_from->name}} {{$problem->user_from->lastName}}</dd>
                                       
                                    </dl>
                                    <hr>
                                        @if($problem->main_slovler == Auth::id())
                                        <dl class="small m-t-md">
                                            <dt>Main solver</dt>
                                            <dd>You</dd>
                                        </dl>

                                        <div class="small text-muted" ng-controller="userSearchController">
                                            <dt>Search for moderators</dt>
                                            <input type="text" id="searchInput" class="form-control" style="margin-bottom:20px;width:250px" ng-model="keywords" ng-change="search()">
                                            <input type="hidden" value="{{$problem->id}}" id="problemId">
                                            <div id="itemsHolder" style="position: absolute;width: 500px;height: 120px;margin-top:-54px;margin-left:250px;">
                                            @foreach($problem->users as $user)
                                                @if($user->id != Auth::user()->id)
                                                <div class="" id="menuSearchItem{{$user->id}}plus{{$problem->id}}" style="border-bottom:2px solid red;max-width: 100px;height: 33px;background-color: #F3F3F4;border-radius: 3px; text-align: center;padding-top: 7px;float: left;margin-left: 10px;padding-left: 5px;padding-right:5px ">
                                                    {{$user->name}} {{$user->lastName}} 
                                                <i class="fa fa-times" aria-hidden="true" style="cursor:pointer" ng-click="deleteWorker({{$problem->id}},{{$user->id}})"></i></div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    
                                    
                                        
                                        <div class="" id="responseDiv" style="width:250px;max-height:200px;border:1px solid red;position: absolute;margin-top:-17px;z-index: 999;background-color: white;display: none">
                                            
                                        </div>
                                        @else
                                        <dl class="small m-t-md">
                                            <dt>Main solver</dt>
                                            <dd>{{$problem->main_solver->name}} {{$problem->main_solver->lastName}}</dd>
                                       
                                        </dl>
                                        <dl class="small m-t-md">
                                            <dt>Other people on this problem</dt>
                                            <dd>
                                            @foreach($problem->users as $user)
                                                @if($user->id != $problem->main_solver->id)
                                                    {{$user->name}} {{$user->lastName}} &nbsp;
                                                @endif
                                            @endforeach
                                            </dd>
                                       
                                        </dl>
                                        @endif
                                    <div>
                                        <div class="btn-group">
                                            <!-- <button class="btn btn-white btn-sm"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="{{url('home/takeProblem',$problem->id)}}" style="color:#676A6C"> Take it</a></button> -->
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i><a href="{{url('/home/assigned')}}"  style="color: white"> Back to problems </a></button>
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