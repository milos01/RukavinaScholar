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

                            <div class="col-md-12 animated fadeInRight" >
                                <div class="chat-discussion chDiscussion"  style="background: #fff;">
                                    @foreach($myMessages as $message)
                                        {{$message->id}}<br>
                                        @if($message->id != Auth::id())
                                            <div class="chat-message left" style="width:60%" id="leftUserMessage">
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
                                            <div class="chat-message right" style="width:60%">
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
                    <div class="rcol-md-12 animated fadeInRight" >
                     
                            <div class="col-lg-12" style="background-color: #fff; margin-top: 1px">
                                <div class="" style="margin-left:22px;width:40%;margin-bottom: 15px;margin-top:20px">
                                    <div class="chat-message-form">

                                        <div class="form-group" ng-controller="sendMessageController">
                                            <form ng-submit="submitMessageForm()">
                                                <textarea class="form-control message-input messInput" name="message" placeholder="Enter message text" ng-model="message" ng-model-options="{ debounce: 1000 }"></textarea>
                                                <input type="hidden" name="userId" value="{{$user->id}}" id="userId">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
                                             
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                      
                        </div>
    </div>
@stop