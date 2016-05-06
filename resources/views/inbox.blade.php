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

            
                <h2>
                    Inbox (16)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

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
	                    	<td class="mail-ontact"><a href="mail_detail.html">to me: {{$message->pivot->user_from}}</a></td>
	                    
	                    @endif
	                    <td class="mail-subject"><a href="mail_detail.html">{{$message}}</a></td>
	                    <td class=""><i class="fa fa-paperclip"></i></td>
	                    <td class="text-right mail-date">6.10 AM</td>
	                </tr>
                @endforeach
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>
@stop