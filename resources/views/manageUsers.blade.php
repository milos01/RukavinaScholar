@extends('admin')
@section('navName')
	Manage users
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
    <li class="active">
    	<strong>Manage users</strong>
    </li>                
@stop
@section('manageUsers')
	<!-- Modal -->
	<div id="addMemnerModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="width:400px">

	    <!-- Modal content-->
	     <form method="POST" action="{{ url('/home/addStaff') }}">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add staff</h4>
	      </div>
	      <div class="modal-body">
	        <input type="text" class="form-control" placeholder="First name" name = "fname" style="margin-top:10px"></input>
	        <input type="text" class="form-control" placeholder="Last name" name = "lname" style="margin-top:10px"></input>
	        <input type="text" class="form-control" placeholder="Email" name = "email" style="margin-top:10px"></input>
	        <input type="password" class="form-control" placeholder="Password" name = "password" style="margin-top:10px"></input>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Add</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    </form>
	  </div>
	</div>
	<!-- End modal -->
	 <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Staff list</h5>
                            <div class="ibox-tools">
                                <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addMemnerModal">Add new staff member</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
									@foreach($users as $user)
										@if($user->email != Auth::user()->email && !$user->is('regular'))
	                                    <tr>
	                                        <td class="project-status">
	                                        @if($user->is('moderator'))
	                                            <a href="{{url('/home/upgrade', $user->id)}}" class="btn btn-primary btn-s">Make admin</a>
	                                        @elseif($user->is('admin'))
	                                        	<a href="{{url('/home/downgrade', $user->id)}}" class="btn btn-default btn-s">Downgrade</a>
	                                        @endif
	                                        </td>
	                                        <td class="project-title">
	                                            <a href="{{url('/home', $user->id)}}">{{ $user->name }} {{$user->lastName}}
	                                            	@if($user->is('moderator'))
	                                            		(Moderator)
	                                        		@elseif($user->is('admin'))
	                                        			(Admin)
	                                        		@endif
	                                            </a>
	                                            <br/>
	                                            <small>Signed up: {{$user->created_at->format('m/d/Y')}}</small>
	                                        </td>
	                                        <td class="project-completion">
	                                                <small>Activity: {{$user->effect}}%</small>
	                                                <div class="progress progress-mini">
	                                                    <div style="width: {{$user->effect}}%;" class="progress-bar"></div>
	                                                </div>
	                                        </td>
	                                        <td class="project-people">
	                                            <a href=""><img alt="image" class="img-circle" src="../../img/a3.jpg"></a>
	                                            
	                                        </td>
	                                        <td class="project-actions">
	                                            <!-- <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
	                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a> -->
	                                        </td>
	                                    </tr>
	                                    @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop