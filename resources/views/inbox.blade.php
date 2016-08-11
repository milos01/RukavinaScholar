
@extends('admin')
@section('navName')
	Inbox
@stop
@section('navMenu')

	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
    <li class="active">
    	<strong>Inbox</strong>
    </li>                
@stop
@section('manageUsers')
	<div class="wrapper wrapper-content">
        <div class="row">
            
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">

            	<?php $num = 0 ?>
                <h2>
                @foreach($myMessages as $message)
                	@if($message->pivot->read == 0 and $message->pivot->user_to == Auth::id())
                		<?php $num++; ?>
                	@endif
                @endforeach

                Inbox ({{$num}})
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash-o"></i> </button>

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
                @foreach($myMessages as $message)
	                	@if($message->pivot->read == 0 and $message->pivot->user_to == Auth::id())
		                <tr class="unread">
		                @else
		                <tr class="read">
		                @endif
		                    <td class="check-mail" style="padding-top: 19px">
		                        <input type="checkbox" class="i-checks">
		                    </td>
		                    @if($message->pivot->user_to != Auth::user()->id)
                                <td style="width:50px;padding: 6px">
                                    <div >
                                         <img class="message-avatar" style="width:45px;margin-top:0px;height:45px;border-radius:50%;" src="../../../img/{{$message->picture}}" alt="" >
                                    </div>
                                </td>
		                    	<td class="mail-ontact" style="padding-top: 19px"><a href="mail_detail.html">{{$message->name}} {{$message->lastName}}</a></td>
                                <td class="mail-subject" style="padding-top: 19px"><a href="{{url('/home/inbox', $message->pivot->user_to)}}">

                                @if(strlen($message->pivot->message) > 120)
                                    <i class="fa fa-weixin" aria-hidden="true"></i>  &nbsp; {{substr($message->pivot->message, 0, 120)}}...
                                @else
                                    <i class="fa fa-weixin" aria-hidden="true"></i>  &nbsp; {{$message->pivot->message}}
                                @endif
                                </a></td>
		                    @else
                                <?php
                                    $notMeUser = App::make("App\User")->find($message->pivot->user_from);
                                ?>
		                          <td style="width:50px;padding: 6px">
                                    <div >
                                         <img class="message-avatar" style="width:45px;margin-top:0px;height:45px;border-radius:50%;" src="../../../img/{{$notMeUser->picture}}" alt="" >
                                    </div>
                                  </td>
                                  <td class="mail-ontact" style="padding-top: 19px"> <a href="mail_detail.html">{{$notMeUser->name}} {{$notMeUser->lastName}}</a></td>
                                  <td class="mail-subject" style="padding-top: 19px"><a href="{{url('/home/inbox', $message->pivot->user_from)}}">

                                    @if(strlen($message->pivot->message) > 120)
                                        <i class="fa fa-weixin" aria-hidden="true"></i>  &nbsp; {{substr($message->pivot->message, 0, 120)}}...
                                    @else
                                        <i class="fa fa-weixin" aria-hidden="true"></i>  &nbsp; {{$message->pivot->message}}
                                    @endif
                                </a></td>
		                    @endif
		                    
		                    <td class="text-right mail-date" style="padding-top: 19px"><small>{{$message->created_at->format('m/d/Y')}}</small></td>
		                </tr>
                @endforeach
                </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
@stop