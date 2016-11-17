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
                        <div class="row" style="margin-top:-11px" >

                            <div class="col-md-8 animated fadeInRight" style="overflow:hidden;padding:0px" ng-controller="sendMessageController">
                                <div class="chat-discussion chDiscussion"  style="background: #fff;height:63vh;overflow: auto;position:relative;padding-right:20px;margin-right:-20px">
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
                                    <div id="showNewMessage"></div>
                                    
                                    
                                </div>
                                <div class="chat-discussion"  style="background: #fff;height:10vh;border-top:1px solid #e7eaec">
                                    <div class="chat-message-form">
                                        <div class="form-group" style="float:left;">
                                            <form ng-submit="submitMessageForm()" name="sendMessageForm" novalidate>
                                                <div class="form-group" ng-class="{ 'has-error' : sendMessageForm.message.$invalid && !sendMessageForm.message.$pristine }">
                                                    <div class="col-sm-7">
                                                        <textarea rows="2" cols="140" class="form-control messInput" name="message" placeholder="Write a message..." ng-model="message" style="resize:none;border:none" required></textarea>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="userId" value="{{$user->id}}" id="userId">
                                                <input type="hidden" name="userPicture" value="{{Auth::user()->picture}}" id="userPicture">
                                                <input type="hidden" name="userName" value="{{Auth::user()->name}}" id="userName">
                                                <input type="hidden" name="lastName" value="{{Auth::user()->lastName}}" id="lastName">
                                                <input type="hidden" name="userEmail" value="{{$user->email}}" id="userEmail">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
                                                <button type="submit" style="float:left;padding:7px 0px;border:none;background:white;margin-left:-10px;" ng-disabled="sendMessageForm.$invalid">SEND</button>
                                            </form>
                                        </div>       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
    

@stop
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

</body>
</html>
