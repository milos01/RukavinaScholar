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
        <strong>{{$problem->user->name}} {{$problem->user->lastName}}'s problem</strong>
    </li>                
@stop
@section('manageUsers')
<div class="wrapper wrapper-content animated fadeIn">

 </div>
@stop