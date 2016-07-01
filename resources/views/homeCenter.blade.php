@extends('admin')
@section('navName')
	Home page
@stop
@section('manageUsers')
<div class="wrapper wrapper-content animated fadeIn">

                <div class="p-w-md m-t-sm">
                    <div class="row">

                        <div class="col-sm-4">
                            <h1 class="m-b-xs">
                                26,900
                            </h1>
                            <small>
                                Sales in current month
                            </small>
                            <div id="sparkline1" class="m-b-sm">

                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <small class="stats-label">Pages / Visit</small>
                                    <h4>236 321.80</h4>
                                </div>

                                <div class="col-xs-4">
                                    <small class="stats-label">% New Visits </small>
                                    <h4>46.11%</h4>
                                </div>
                                <div class="col-xs-4">
                                    <small class="stats-label">Last week</small>
                                    <h4>432.021</h4>
                                </div>
                            </div>

                        </div>
                         <div class="col-sm-4 pull-right">

                            <div class="row m-t-xs">
                                <div class="col-xs-6">
                                    <h5 class="m-b-xs">Income last month</h5>
                                    <h1 class="no-margins">160,000</h1>
                                    <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                                </div>
                                <div class="col-xs-6">
                                    <h5 class="m-b-xs">Sals current year</h5>
                                    <h1 class="no-margins">42,120</h1>
                                    <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                                </div>
                            </div>


                            <table class="table small m-t-sm">
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>142</strong> Projects

                                    </td>
                                    <td>
                                        <strong>22</strong> Messages
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <strong>61</strong> Comments
                                    </td>
                                    <td>
                                        <strong>54</strong> Articles
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>154</strong> Companies
                                    </td>
                                    <td>
                                        <strong>32</strong> Clients
                                    </td>
                                </tr>
                                </tbody>
                            </table>



                        </div>

                       
                    </div>

                    <div class="row">
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
                                        <div class="col-sm-2">
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
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">

                                            <tbody>
                                            @if($allProblems->isEmpty())
                                                <td style="padding: 0px;color:black;text-align: center;">
                                                    <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                        No problems to selsect
                                                    </div>
                                                </td>
                                            @else
                                                @foreach($allProblems as $problem)
                                                    @if($problem->took != 1)
                                                
                                                    <tr>
                                                        <td style="padding: 0px;color:black">
                                                            <a href="{{url('/home/problem',$problem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$problem->id}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <a href="{{url('/home/problem',$problem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$problem->subject}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                             <a href="{{url('/home/problem',$problem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$problem->user_from->name}} {{$problem->user_from->lastName}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                            <a href="{{url('/home/problem',$problem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    Type of problem
                                                                </div>
                                                            </a>
                                                        </td>
                                                        
                                                        <td style="padding: 0px">
                                                            <a href="{{url('/home/problem',$problem->id)}}">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    {{$problem->created_at->format('m/d/Y')}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px;text-align: center">
                                                            <a href="#">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678">
                                                                    <i class="fa fa-eye" style="color: #1AB394"></i>
                                                                </div>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    @endif
                                                @endforeach
                                             @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
@stop