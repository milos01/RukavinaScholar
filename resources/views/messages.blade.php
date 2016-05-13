@extends('admin')
@section('navName')
	{{$user->name}} {{$user->lastName}}
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home/admin')}}">Home</a>
     </li>
     <li>
         <a href="{{url('/home/admin/inbox')}}">Inbox</a>
     </li>
    <li class="active">
    	<strong>{{$user->name}} {{$user->lastName}}</strong>
    </li>                
@stop
@section('manageUsers')
	 <div class="ibox-content">

                        <div class="row">

                            <div class="col-md-9 ">
                                <div class="chat-discussion"  style="background: #fff">
                                    @foreach($myMessages as $message)
                                        @if($message->id != Auth::id())
                                            <div class="chat-message left">
                                                <img class="message-avatar" src="../../../img/{{Auth::user()->picture}}" alt="" >
                                                <div class="message">
                                                     <a class="message-author" href="#"> {{Auth::user()->name}} {{Auth::user()->lastName}} </a>
                                                        <span class="message-date">{{$message->pivot->created_at->format('m/d/Y')}}</span>
                                                        <span class="message-content">
                                                        {{$message->pivot->message}}
                                                        </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat-message right">
                                                <img class="message-avatar" src="../../../img/{{$user->picture}}" alt="" >
                                                <div class="message">
                                                    <a class="message-author" href="#"> {{$user->name}} {{$user->lastName}} </a>
                                                    <span class="message-date"> {{$message->pivot->created_at->format('m/d/Y')}} </span>
                                                    <span class="message-content">
                                                    {{$message->pivot->message}}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    
                                    
                                </div>

                            </div>
                            

                        
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="chat-message-form">

                                    <div class="form-group" ng-controller="sendMessageController">
                                        <form ng-submit="submitMessageForm()">
                                            <textarea class="form-control message-input" name="message" placeholder="Enter message text" ng-model="message" ng-model-options="{ debounce: 1000 }"></textarea>
                                            <input type="hidden" name="userId" value="{{$user->id}}" id="userId">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
                                            <% message %>
                                            <% userId %>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


    </div>
@stop