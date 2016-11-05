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
        <strong>Assigned</strong>
    </li>                
@stop
@section('manageUsers')
    <div class="row" style="margin-top: 15px">
                        <div class="col-lg-12">
                            <div class="ibox">



                                <div class="ibox-content">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label" for="product_name">Project Name</label>
                                                <input type="text" id="product_name" name="product_name" value="" placeholder="Project Name" class="form-control">
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="price">Name</label>
                                                <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="quantity">Company</label>
                                                <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label" for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" selected="">Completed</option>
                                                    <option value="0">Pending</option>
                                                </select>
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">

                                            <tbody>
                                            @if($myProblems->isEmpty())
                                                <td style="padding: 0px;color:black;text-align: center;">
                                                    <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                        No problems to selsect
                                                    </div>
                                                </td>
                                            @else
                                                 @foreach($myProblems as $myProblem)
                                                    <tr>
                                                        <td style="padding: 0px;color:black">
                                                            <a href="{{url('/home/myproblem',$myProblem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    <!-- {{$myProblem->id}} -->
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <a href="{{url('/home/myproblem',$myProblem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$myProblem->subject}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                             <a href="{{url('/home/myproblem',$myProblem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$myProblem->user_from->name}} {{$myProblem->user_from->lastName}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                            <a href="{{url('/home/myproblem',$myProblem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    Type of problem
                                                                </div>
                                                            </a>
                                                        </td>
                                                        
                                                        <td style="padding: 0px">
                                                            <a href="{{url('/home/myproblem',$myProblem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    Assigned: {{$myProblem->pivot->created_at->format('m/d/Y')}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        
                                                        <td style="padding: 0px;text-align: center">
                                                            <a href="#">
                                                                @if($myProblem->main_slovler == Auth::id())
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    <i class="fa fa-star" style="color: #ed5565" data-toggle="tooltip" data-placement="bottom" title="You are the head solver on this problem"></i>
                                                                </div>
                                                                @else
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    <i class="fa fa-thumb-tack" aria-hidden="true" style="color:#31708f" data-toggle="tooltip" data-placement="bottom" title="You are coworker on this problem"></i>
                                                                </div>
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                             @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
@stop