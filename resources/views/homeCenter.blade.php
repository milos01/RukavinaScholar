 @extends('admin')
 @section('navMenu')
 <div class="row  border-bottom white-bg dashboard-header">

   <div class="col-sm-3">
     <h2>Welcome {{Auth::user()->name}} {{Auth::user()->lastName}}</h2>
     <small>You have 42 messages and 6 notifications.</small>
     <ul class="list-group clear-list m-t">
       <li class="list-group-item fist-item">
         <span class="pull-right">
           09:00 pm
         </span>
         <span class="label label-success">1</span> Please contact me
       </li>
       <li class="list-group-item">
         <span class="pull-right">
           10:16 am
         </span>
         <span class="label label-info">2</span> Sign a contract
       </li>
       <li class="list-group-item">
         <span class="pull-right">
           08:22 pm
         </span>
         <span class="label label-primary">3</span> Open new shop
       </li>
       <li class="list-group-item">
         <span class="pull-right">
           11:06 pm
         </span>
         <span class="label label-default">4</span> Call back to Sylvia
       </li>
       <li class="list-group-item">
         <span class="pull-right">
           12:00 am
         </span>
         <span class="label label-primary">5</span> Write a letter to Sandra
       </li>
     </ul>
   </div>
   <div class="col-sm-6">
     <div class="flot-chart dashboard-chart">
       <div class="flot-chart-content" id="flot-dashboard-chart"></div>
     </div>
     <div class="row text-left">
       <div class="col-xs-4">
         <div class=" m-l-md">
           <span class="h4 font-bold m-t block">$ 406,100</span>
           <small class="text-muted m-b block">Sales marketing report</small>
         </div>
       </div>
       <div class="col-xs-4">
         <span class="h4 font-bold m-t block">$ 150,401</span>
         <small class="text-muted m-b block">Annual sales revenue</small>
       </div>
       <div class="col-xs-4">
         <span class="h4 font-bold m-t block">$ 16,822</span>
         <small class="text-muted m-b block">Half-year revenue margin</small>
       </div>

     </div>
   </div>
   <div class="col-sm-3">
     <div class="statistic-box">
       <h4>
         Project Beta progress
       </h4>
       <p>
         You have two project with not compleated task.
       </p>
       <div class="row text-center">
         <div class="col-lg-6">
           <canvas id="doughnutChart" width="78" height="78"></canvas>
           <h5 >Maxtor</h5>
         </div>
       </div>
       <div class="m-t">
         <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
       </div>

     </div>
   </div>

 </div>
 @stop
 @section('manageUsers')
 <div class="wrapper wrapper-content animated fadeIn">
  <div class="p-w-md m-t-sm">
    <div class="row"  ng-controller="showProblemController" ng-init="init({{Auth::user()}})">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group pull-left">
                  @if(Auth::user()->is('regular'))
                  <label class="control-label" for="product_name">My tasks</label>
                  @else
                  <label class="control-label" for="product_name">Tasks for bidding</label>
                  @endif
                  <div class="container" style="width:100">
                    <input  type="text" id="product_name" name="product_name" placeholder="Task Name" class="form-control" ng-model="search.subject" style="float:left;width: 300px;margin-left: -15px">
                    <div class="container" style="width: 300px;float: left;padding: 6px;margin-left: 30px">
                      <label class="checkbox-inline"><input type="checkbox" ng-click="includeTaskType('Programming')"/> Programming</label>
                      <label class="checkbox-inline"><input type="checkbox" ng-click="includeTaskType('Math')" /> Math</label>
                      <label class="checkbox-inline"><input type="checkbox" ng-click="includeTaskType('Physics')"/> Physics</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                  
                  <th data-sort-ignore="true"></th>
                  
                  @if(!Auth::user()->is('regular'))
                    <th data-hide="all"></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="problem in problems | filter: search | taskTypeFilter:taskTypeIncludes" ng-cloak foo-repeat-done>
                  <!-- index -->
                  <td></td>
                  <!-- subject -->
                  <td><a href="problem/<%problem.hashid%>"><% problem.subject | limitTo: 26 %></a></td>
                  <!-- description -->
                  <td><span ng-bind-html="problem.problem_description"></span></td>
                  <!-- task type -->
                  <td><% problem.task_type.name %></td>
                  <!-- created at -->
                  <td><% problem.created_at.date | dateFilter: 'MM/dd/yyyy' %></td>
                  <!-- info -->
                  <td>
                    <span class="badge" problem-show-directive problem="problem" user="{{Auth::user()}}"></span>
                    <!-- <div ng-click="requestAgain()"><a>click to reset</a></div> -->
                  </td>
                  @if(Auth::user()->is('regular'))
                  <td>
                    <span ng-class="{'badge': problem.showConfirmation && problem.showMakePayment}" confirmation-directive problem="problem" problems="problems" index="<% $index %>"></span>
                    <span class="badge" timer-directive problem="problem" user="{{Auth::user()}}" ></span>
                  </td>
                  @else
                  <td>
                    <span class="badge" timer-directive problem="problem" user="{{Auth::user()}}"></span>
                  </td>
                  @endif
                  <!-- <td>asdasdasdasdasdasas</td> -->
                                    <!-- <td>
                                      <span ng-bind="problem.timer"></span>
                                      <div id="paymentHolder" style="" ng-cloak>
                                      <a ng-show="showMakePayment<%problem.id%>" href="home/problem/'+scope.problem.id+'/payment/'+minOffer.id+'" class="btn btn-info btn-xs" ng-cloak>Make paymendt</a>
                                      <span ng-show="showAcceptDecline<%problem.id%>" style="" ng-cloak>
                                        <a ng-click="acceptOffer(problem)">Accept </a>
                                        /
                                        <a ng-click="declineOffer(problem.id)">Decline</a>
                                      </span>
                                    </div>
                                  </td> -->
                                  @if(!Auth::user()->is('regular'))
                                  <td>
                                    <div ng-repeat="offer in problem.offers">
                                      <div class="row" style="width:100%">
                                        <div class="col-md-4" my-offer offer="offer" user="{{Auth::user()}}"></div>
                                         <!--  <div class="col-md-5" style="background: #fdf0e0;">
                                              Offer description: <%offer.description | limitTo:50%>
                                            </div> -->
                                        <div class="col-md-2">Price: <b>$<% offer.price %></b></div>
                                        <div class="col-md-4">
                                          Posted at: <b>$<% offer.created_at | dateFilter: 'MM/dd/yyyy @ h:mma' %></b>
                                        </div>
                                      </div>
                                    </div>
                                    <p ng-show="problem.offers.length == 0" style="text-align:center;margin-top:10px;position: relative;">No offers for this task</p>
                                  </td>
                                  @endif
                                  <hr/>
                                  </tr>


                                 </tbody>

                               </table>
                               <div style="text-align: center;margin-top:30px;position: relative;" ng-show="loading" ng-cloak>
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="color:#1ab394"></i>
                              </div>
                              <p ng-show="(problems | filter: search | taskTypeFilter:taskTypeIncludes).length === 0" style="text-align:center;margin-top:40px;position: relative" ng-cloak>No tasks found!</p>
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

