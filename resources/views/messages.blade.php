@extends('admin')
@section('navName')
	{{$user->name}} {{$user->lastName}}
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
     <li>
         <a href="{{url('/home/inbox')}}">Inbox</a>
     </li>
    <li class="active">
    	<strong>{{$user->name}} {{$user->lastName}}</strong>
    </li>                
@stop
@section('manageUsers')
	<div class="wrapper wrapper-content">

                        <div class="row">

                            <div class="col-md-8 animated fadeInRight" >
                                <div class="chat-discussion chDiscussion"  style="background: #fff;">
                                    @foreach($myMessages as $message)
                                        <br>
                                        @if($message->id != Auth::id())
                                            <div class="chat-message left" style="width:100%" id="leftUserMessage">
                                                <img class="message-avatar" src="../../../img/{{Auth::user()->picture}}" alt="" style="border-radius: 50%">
                                                <div class="message">
                                                     <a class="message-author" href="#"> {{Auth::user()->name}} {{Auth::user()->lastName}} </a>
                                                        <span class="message-date">{{$message->pivot->created_at->format('m/d/Y')}}</span>
                                                        <span class="message-content" id="messageBox">
                                                            {!!nl2br(($message->pivot->message))!!}
                                                        </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat-message right" style="width:100%">
                                                <img class="message-avatar" src="../../../img/{{$user->picture}}" alt="" style="border-radius: 50%">
                                                <div class="message" style="background: #f7f7f7">
                                                    <a class="message-author" href="#"> {{$user->name}} {{$user->lastName}} </a>
                                                    <span class="message-date">{{$message->pivot->created_at->format('m/d/Y')}} </span>
                                                        <span class="message-content" >
                                                           {!!nl2br(($message->pivot->message))!!}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    
                                    
                                </div>


                            </div>
                            

                        
                        


                    </div>
                    <!-- <div class="rcol-md-12 animated fadeInRight" > -->
                     
                            <div class="col-lg-8" style="background-color: #fff; margin-top: 1px;width:66%;">
                                <div class="" style="margin-left:22px;width:60%;margin-bottom: 15px;margin-top:20px">
                                    <div class="chat-message-form">

                                        <div class="form-group" ng-controller="sendMessageController" style="float:left;">
                                            <form ng-submit="submitMessageForm()">
                                                <textarea rows="2" cols="55" class="form-control messInput" name="message" placeholder="Write a message..." ng-model="message" ng-model-options="{ debounce: 1000 }" style="resize:none;border:none"></textarea>
                                                <input type="hidden" name="userId" value="{{$user->id}}" id="userId">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
                                                
                                            </form>
                                        </div>
                                        <div class="container">
                                            <span style="float:left;padding:7px 0px">SEND</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                        <!-- </div> -->
    </div>
@stop