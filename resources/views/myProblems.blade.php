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
    <div class="row" style="margin-top: 15px" ng-controller="assignedController" ng-init="init({{Auth::user()}})">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group pull-left">
                                <div class="container" style="width:100">
                                    <form ng-submit="taskSearchFilter()">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <input  type="text" id="product_name" name="product_name" placeholder="Task Name" class="form-control" ng-model="product_name" style="float:left;width: 100%;margin-left: -15px">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="checkbox-inline"><input type="checkbox" name="Programming" ng-model="programming"/> Programming</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="Math" ng-model="math" /> Math</label>
                                                <label class="checkbox-inline"><input type="checkbox" name="Physics" ng-model="physics"/> Physics</label>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary btn-xs form-control" type="submit" style="width: 100%;">Search!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                              <th data-sort-ignore="true">Subject</th>
                              <th data-sort-ignore="true">Description</th>
                              <th data-sort-ignore="true">Task Type</th>
                              <th data-sort-ignore="true">Created At</th>
                              <th data-sort-ignore="true">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="problem in assignedObj.problemsData" ng-cloak foo-repeat-done>
                                <!-- subject -->
                                <td><a href="problem/<%problem.hashid%>"><% problem.subject | limitTo: 26 %></a></td>
                                <!-- description -->
                                <td><span ng-bind-html="problem.problem_description"></span></td>
                                <!-- task type -->
                                <td><% problem.task_type.name %></td>
                                <!-- created at -->
                                <td><% problem.created_at | dateFilter: 'MM/dd/yyyy' %>
                                </td>
                                <!-- info -->
                                <td>
                                    <span assign-directive problem="problem" user="{{Auth::user()}}"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center;margin-top:30px;position: relative;" ng-show="loading" ng-cloak>
                        <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="color:#1ab394"></i>
                    </div>
                    <p ng-show="assignedObj.problemsData.length === 0" style="text-align:center;margin-top:40px;position: relative" ng-cloak>No tasks found!</p>
                    <div ng-controller="paginationController" ng-if="assignedObj.problemsMeta && assignedObj.problemsData">
                        <div class="coll-lg-12 text-center"  page-links-directive problemsd="assignedObj.problemsData" problemsm="assignedObj.problemsMeta" user="{{Auth::user()}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('chartTableJs')
@stop