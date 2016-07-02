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
                                    
                                        <div class="small text-muted" ng-controller="userSearchController">
                                            <dt>Search for moderators</dt>
                                            <input type="text" id="searchInput" class="form-control" style="margin-bottom:20px;width:250px" ng-model="keywords" ng-change="search()">
                                            <input type="hidden" value="{{$problem->id}}" id="problemId">
                                             
                                        </div>
                                    
                                    <!-- @foreach($problem->users as $user)
                                        {{$user->name}} {{$user->lastName}}
                                    @endforeach -->
                                  
                                        <div class="container" id="responseDiv" style="width:250px;max-height:200px;border:1px solid red;position: absolute;margin-top:-17px;z-index: 999;background-color: white;display: none">
                                            
                                        </div>
                                    
                                    <div>
                                        <div class="btn-group">
                                            <button class="btn btn-white btn-sm"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="{{url('home/takeProblem',$problem->id)}}" style="color:#676A6C"> Take it</a></button>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i><a href="{{url('/home')}}"  style="color: white"> Back to home </a></button>
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