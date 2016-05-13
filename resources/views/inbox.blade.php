@extends('admin')
@section('navName')
	Inbox
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home/admin')}}">Home</a>
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
                	@if($message->pivot->read == 0)
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
	                	@if($message->pivot->read == 0)
		                <tr class="unread">
		                @else
		                <tr class="read">
		                @endif
		                    <td class="check-mail">
		                        <input type="checkbox" class="i-checks">
		                    </td>
		                    @if($message->pivot->user_to != Auth::user()->id)
		                    	<td class="mail-ontact"><a href="mail_detail.html">{{$message->name}} {{$message->lastName}}</a></td>
		                    @else
		                    	<td class="mail-ontact"><a href="mail_detail.html">{{$message->pivot->user_from}}</a></td>
		                    
		                    @endif
		                    <td class="mail-subject"><a href="{{url('/home/admin/inbox', $message->pivot->user_from)}}">

		                    @if(strlen($message->pivot->message) > 120)
		                    	{{substr($message->pivot->message, 0, 120)}}...
		                    @else
		                    	{{$message->pivot->message}}
		                    @endif
		                    </a></td>
		                    <td class="text-right mail-date"><small>{{$message->created_at->format('m/d/Y')}}</small></td>
		                </tr>
                @endforeach
                </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
@stop