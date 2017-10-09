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
                <div class="ibox-content">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                            <tr>
                              <th data-sort-ignore="true">#</th>
                              <th data-sort-ignore="true">Subject</th>
                              <th data-sort-ignore="true">Description</th>
                              <th data-sort-ignore="true">Task Type</th>
                              <th data-sort-ignore="true">Created At</th>
                              <th data-sort-ignore="true">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="problem in problems" ng-cloak foo-repeat-done>
                                <!-- index -->
                                <td><% $index+1 %></td>
                                <!-- subject -->
                                <td><a href="problem/<%problem.id%>"><% problem.subject | limitTo: 26 %></a></td>
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
                    <p ng-show="problems.length === 0" style="text-align:center;margin-top:40px;position: relative;" ng-cloak>No tasks found!</p>
                </div>
            </div>
        </div>
    </div>
@stop
@section('chartTableJs')
@stop