@extends('admin')
@section('navName')
	Edit user
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
    <li class="active">
    	<strong>Product edit</strong>
    </li>                
@stop
@section('manageUsers')

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
	<div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"> Basic info</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"> Security</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                    	<form action="{{url('/home/updateUser')}}" method="POST">
	                                        <fieldset class="form-horizontal">
	                                            <div class="form-group"><label class="col-sm-2 control-label">First name:</label>
	                                                <div class="col-sm-8"><input type="text" class="form-control" value="{{Auth::user()->name}}" name="fname"></div>
	                                            </div>
	                                            <div class="form-group"><label class="col-sm-2 control-label">Last name:</label>
	                                                <div class="col-sm-8"><input type="text" class="form-control" value="{{Auth::user()->lastName}}" name="lname"></div>
	                                            </div>
	                                            
	                                            <div class="form-group"><label class="col-sm-2 control-label">Email:</label>
	                                                <div class="col-sm-8"><input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" disabled></div>
	                                            </div>

	                                            <div class="form-group"><label class="col-sm-2 control-label">Role:</label>
	                                                <div class="col-sm-8"><input type="text" class="form-control" value="{{ucfirst(Auth::user()->role)}}" name="role" disabled></div>
	                                            </div>
	                                            
	                   							<div class="col-sm-10" style="margin-left:10px;">
	                                            	<button class="btn btn-primary pull-right" type="submit">Edit info</button>
	                                            </div>
	                                            <input type="hidden" name="_token" value="{{csrf_token()}}"> </input>
	                                        </fieldset>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                    <form action="{{url('/home/updatePassword')}}" method="POST">
                                        <fieldset class="form-horizontal">
                                            <div class="form-group"><label class="col-sm-2 control-label">Old password:</label>
                                                <div class="col-sm-8"><input type="password" class="form-control" name="oldPassword"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">New password:</label>
                                                <div class="col-sm-8"><input type="password" class="form-control" name="newPassword"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Repeat password:</label>
                                                <div class="col-sm-8"><input type="password" class="form-control" name="repPassword"></div>
                                            </div>
                                            <div class="col-sm-10" style="margin-left:10px;">
                                            	<button type="submit" class="btn btn-primary pull-right">Change password</button>
                                            </div>
                                        </fieldset>
                                        <input type="hidden" value="{{csrf_token()}}" name="_token"></input>
                                    </form>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-stripped table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>
                                                        Group
                                                    </th>
                                                    <th>
                                                        Quantity
                                                    </th>
                                                    <th>
                                                        Discount
                                                    </th>
                                                    <th style="width: 20%">
                                                        Date start
                                                    </th>
                                                    <th style="width: 20%">
                                                        Date end
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" >
                                                            <option selected>Group 1</option>
                                                            <option>Group 2</option>
                                                            <option>Group 3</option>
                                                            <option>Group 4</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="10">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="$10.00">
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body">

                                        <div class="row">
            <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <div class="dropzone" id="dropzoneFileUpload">
                                    
                                </div>
                                <!-- <form action="{{url('/home/saveImage')}}" method="POST" enctype="multipart/form-data">
	                                <div class="btn-group">
	                                    <label title="Upload image file" for="inputImage" class="btn btn-primary" style="margin-top:15px;">
	                                        <input type="file" accept="image/*" name="picture" id="inputImage" 	 class="hidden">
	                                        Upload new image
	                                    </label>
	                                </div>
	                                <h4></h4>
	                               	<div class="btn-group">
	                                    <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
	                                    <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
	                                    <!-- <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
	                                    <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>
	                                    <button class="btn btn-warning" id="setDrag" type="button">New crop</button> -->
	                                   <!--  <button class="btn btn-warning" id="setDrag" type="submit">Save</button>
	                                </div>
	                                <input type="hidden" value="{{csrf_token()}}" name="_token"></input>
                                </form>  -->
                            </div>
                        </div>
                    
            </div>
        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
@stop
