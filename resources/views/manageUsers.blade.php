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
	     <form method="POST" action="{{ url('/home/addStaff') }}" name="addStaffForm" novalidate>
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add staff</h4>
	      </div>
	      <div class="modal-body">
	      	<fieldset class="form-horizontal">
	        <div class="form-group" ng-class="{ 'has-error' : addStaffForm.fname.$invalid && !addStaffForm.fname.$pristine }">
                <div class="col-sm-12"><input type="text" class="form-control" name="fname" ng-model="staff.fname" placeholder="First name" required>
                	<p ng-show="addStaffForm.fname.$error.required && !addStaffForm.fname.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Name required</p>
                </div>
             </div>
             <div class="form-group" ng-class="{ 'has-error' : addStaffForm.lname.$invalid && !addStaffForm.lname.$pristine }">
             	<div class="col-sm-12">
	        		<input type="text" class="form-control" placeholder="Last name" name = "lname" ng-model="staff.lname" required>
	        		<p ng-show="addStaffForm.lname.$error.required && !addStaffForm.lname.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Last name required</p>
                </div>
             </div>
             <div class="form-group" ng-class="{ 'has-error' : addStaffForm.email.$invalid && !addStaffForm.email.$pristine }">
             	<div class="col-sm-12">
	        		<input type="email" class="form-control" placeholder="Email" name = "email" ng-model="staff.email" required>
	        		<p ng-show="addStaffForm.email.$error.required && !addStaffForm.email.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Email required</p>
	        		<p ng-show="addStaffForm.email.$error.email && !addStaffForm.email.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Email not valid</p>
                </div>
             </div>
	        <input type="text" class="form-control" placeholder="Password" name = "password" value="defpass" style="margin-top:10px" disabled>
	        </fieldset>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" ng-disabled="addStaffForm.$invalid">Add</button>
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
										@if($user->email != Auth::user()->email)
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
	                                            <a href=""><img alt="image" class="img-circle" src="../../img/{{$user->picture}}"></a>
	                                            
	                                        </td>
	                                        <td class="project-actions">
	                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> View </a>
	                                            <a href="{{url('/home/manage/deleteUser',[$user->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
	                                        </td>
	                                    </tr>
	                                    @endif
                                    @endforeach  
                                    @foreach($deletedUsers as $user)
										@if($user->email != Auth::user()->email)
	                                    <tr  style="background: rgba(237, 86, 102, .1)">
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
	                                            <small>Signed up: {{$user->created_at->format('m/d/Y')}}</small><br/>
	                                            <small>Deleted at: {{$user->deleted_at->format('m/d/Y')}}</small>
	                                        </td>
	                                        <td class="project-completion">
	                                                <small>Activity: {{$user->effect}}%</small>
	                                                <div class="progress progress-mini">
	                                                    <div style="width: {{$user->effect}}%;" class="progress-bar"></div>
	                                                </div>
	                                        </td>
	                                        <td class="project-people">
	                                            <a href=""><img alt="image" class="img-circle" src="../../img/{{$user->picture}}"></a>
	                                            
	                                        </td>
	                                        <td class="project-actions">
	                                            <!-- <a href="#" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> View </a> -->
	                                            <a href="{{url('/home/manage/deleteUser',[$user->id])}}" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Activate </a>
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



