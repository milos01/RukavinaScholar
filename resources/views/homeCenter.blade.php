 @extends('admin')
@section('navName')
	Home page
@stop
@section('manageUsers')
<div class="wrapper wrapper-content animated fadeIn">

                <div class="p-w-md m-t-sm">
                    <!-- <div class="row">

                        <div class="col-sm-4">
                            <h1 class="m-b-xs">
                                26,900
                            </h1>
                            <small>
                                Ex.
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
                                    <h5 class="m-b-xs">Ex.</h5>
                                    <h1 class="no-margins">160,000</h1>
                                    <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                                </div>
                                <div class="col-xs-6">
                                    <h5 class="m-b-xs">Ex.</h5>
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

                       
                    </div> -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">



                                <div class="ibox-content" style="min-height: 100px" ng-controller="showProblemController">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group pull-left">
                                            @if(Auth::user()->is('regular'))
                                                <label class="control-label" for="product_name">My tasks</label>
                                            @else
                                                <label class="control-label" for="product_name">All tasks</label>
                                            @endif
                                            <div class="container" style="width:100">
                                                <input  type="text" id="product_name" name="product_name" placeholder="Task Name" class="form-control" ng-model="search.subject" style="float:left;width: 300px;margin-left: -15px">
                                                <div class="container" style="width: 300px;float: left;padding: 6px;margin-left: 30px">
                                                    <label class="checkbox-inline"><input type="checkbox" ng-click="includeColour('Programming')"/> Programming</label>
                                                    <label class="checkbox-inline"><input type="checkbox" ng-click="includeColour('Math')" /> Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" ng-click="includeColour('Physics')"/> Physics</label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="price">Name</label>
                                                <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                                            </div>
                                        </div> -->
                                       <!--  <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="quantity">Company</label>
                                                <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label" for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" selected="">Completed</option>
                                                    <option value="0">Pending</option>
                                                </select>
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="table-responsive" style="overflow-x: visible">
                                        <table class="table table-striped">
                                        
                                            <tbody>
                                                <div style="text-align: center;margin-top:30px;position: relative;" ng-show="loading">
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="color:#1ab394"></i>
                                                    <!-- <span class="sr-only">Loading...</span> -->
                                                </div>
                                                <tr ng-repeat="problem in problems | filter:tookFilter | filter: search | filter:colourFilter" problem-show-directive problem="problem" user="{{Auth::id()}}" ng-cloak>
                                                    
                                                        <td style="padding: 0px;color:black">
                                                            <a href="/home/problem/<%problem.id%>">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678" ng-bind="$index + 1">
                                                                
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <a href="/home/problem/<%problem.id%>">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678" ng-bind="problem.subject">
                                                                
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                             <a href="/home/problem/<%problem.id%>">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678" ng-bind="problem.problem_description | limitTo:50">
                                                                    
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                            <a href="/home/problem/<%problem.id%>">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678" >
                                                                    <span ng-bind="problem.problem_type"></span>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px">
                                                           
                                                        </td>
                                                        <td style="padding: 0px">
                                                            <a href="/home/problem/<%problem.id%>">
                                                                <div style="width:100%;height:100%;padding:8px;color:#737678" >
                                                                     <span ng-bind="problem.created_at | dateFilter: 'MM/dd/yyyy @ h:mma'"></span>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td style="padding: 0px;text-align: center">
                                                            <a href="/home/problem/<%problem.id%>">
                                                                <div  style="width:100%;height:100%;padding:8px;color:#737678" >
                                                                    <div id="statusHolder">
                                                                    </div>

                                                                    <div id="dropDownMenu">
                                                                       <!--  <div class="dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Offers<span class="caret"></span>
                                                                            </button>
                                                                                <ul class="dropdown-menu" id="offersHolder">
                                                                                </ul>
                                                                        </div> -->
                                                                    </div>

                                                                </div>
                                                            </a>
                                                        </td>

                                                </tr>
                                                
                                                <p ng-show="(problems | filter: tookFilter | filter: search | filter:colourFilter).length == 0" style="text-align:center;margin-top:40px;position: relative;" ng-bind="noFound"></p>
                                                
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                        <!-- <button style="width:120px;text-align:center;margin:auto" class="more btn btn-primary btn-block" ng-click="loadMore()">Load More!</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
@stop
@section('jsSocket')
    <script src="../../../js/HomeJS.js"></script>
@stop