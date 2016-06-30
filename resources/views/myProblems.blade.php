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
        <strong>My work</strong>
    </li>                
@stop
@section('manageUsers')
    @foreach($myProblems as $myProblem)
        {{$myProblem->subject}}
    @endforeach
@stop