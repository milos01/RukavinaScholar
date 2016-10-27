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
        <strong>Payment for {{$problem->subject}}</strong>
    </li>                
@stop
@section('manageUsers')
    {{$offer}}
@stop