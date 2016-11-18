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
                                                <!-- [media type(video, text doc, string)] -->
                                            <i class="fa fa-cloud-upload fa-5x" aria-hidden="true" style="position: relative;color:#686b6d"></i>
                                            @if(count($problem->files) != 0)
                                                @if(Auth::user()->is('regular'))
                                                  <p>You uploaded {{count($problem->files)}}
                                                  @if(count($problem->files) == 1)
                                                    file.</p>
                                                  @else
                                                    files.</p>
                                                  @endif
                                                @else
                                                    @foreach($problem->files as $file)
                                                        <a href="https://s3.amazonaws.com/kbk300test/{{$file->file->fileName}}" download="{{$file->file->fileName}}">{{$file->file}}</a><br/>
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
                                    <small></small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price"><small class="text-muted"></small> </h2>
                                    </div>
                                    <hr>

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
                                    <dl class="small m-t-md">
                                        

                                        @if(!Auth::user()->is('regular'))
                                            <dt>From</dt>
                                            <dd><a href="/home/user/{{$problem->user_from->id}}">{{$problem->user_from->name}} {{$problem->user_from->lastName}}</a></dd>
                                        @endif
                                       
                                    </dl>
                                    <div  class="m-t-md" style="border-top: 1px solid #eee; border-bottom: 1px solid #eee; height: 46px" ng-controller="bidingController" ng-init="init('{{$problem->id}}')" >
                                        <div id="offerPlace">
                                  
                                       </div>
                                    </div>
                                    
                                    <div>
                                        <div class="btn-group">
                                           <!--  <a href="{{url('home/takeProblem',$problem->id)}}" style="color:#676A6C"><button class="btn btn-white btn-sm"><i class="fa fa-lightbulb-o" aria-hidden="true" style="color:#ed5565"></i> Take it</button></a> -->
                                            <a href="{{url('/home')}}"  style="color: white"><button class="btn btn-danger btn-sm" style="margin-top: 15px;"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to home </button></a>
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