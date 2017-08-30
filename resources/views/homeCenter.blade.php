 @extends('admin')
 @section('navName')
 Home page
 @stop
 @section('manageUsers')
 <div class="wrapper wrapper-content animated fadeIn">

    <div class="p-w-md m-t-sm">


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

                                    </div>

                                    <div class="table-responsive" style="overflow-x: visible">
                                        <table class="table table-striped">

                                            <tbody>
                                                <div style="text-align: center;margin-top:30px;position: relative;" ng-show="loading">
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="color:#1ab394"></i>
                                                    <!-- <span class="sr-only">Loading...</span> -->
                                                </div>




                                                <div ng-repeat="problem in problems | filter:tookFilter | filter: search | filter:colourFilter" problem-show-directive problem="problem" user="{{Auth::id()}}" ng-cloak>

                                                    <div class="ibox" >
                                                        <div class="ibox-title" style="background: #f9f9f9">
                                                            <div class="col-md-1" style="">
                                                                <div style="" ng-bind="$index + 1"></div>
                                                            </div>

                                                            <div class="col-md-2" style="overflow: hidden;">
                                                                <a href="home/problem/<%problem.id%>">
                                                                    <div>
                                                                    <div ng-bind="problem.subject | limitTo: 6"></div>
                                                                    </div>
                                                                </a>
                                                            </div>

                                                           <!--  <div class="col-md-2" style="overflow: hidden;">
                                                                <div style="" ng-bind="problem.problem_description | limitTo:5"><span>...</span>></div>
                                                            </div> -->

                                                            <div class="col-md-1" style="overflow: hidden">
                                                                <div style="" ng-bind="problem.problem_type"></div>
                                                            </div>

                                                            <div class="col-md-2" style="overflow: hidden;">
                                                                <div style="" ng-bind="problem.created_at | dateFilter: 'MM/dd/yyyy'"></div>
                                                            </div>


                                                            <div class="col-md-1 pull-right">
                                                                <div class="ibox-tools">

                                                                    <a class="collapse-link" ng-click="collapseMotion(problem)">
                                                                        <span ng-show="problem.showUp" ng-cloak>
                                                                            <i class="fa fa-chevron-up"></i>
                                                                        </span>

                                                                        <span ng-show="problem.showDown" ng-cloak>
                                                                            <i class="fa fa-chevron-down"></i>
                                                                        </span>
                                                                        <!--  <i class="fa fa-chevron-down"></i> -->
                                                                    </a>

                                                                </div>
                                                                <div ng-show="showAcceptDecline<%problem.id%>" style="margin-top: -20px;margin-left: -30px" ng-cloak>
                                                                  <a ng-click="acceptOffer(problem.id)">Accept</a>
                                                                  /
                                                                  <a ng-click="declineOffer(problem.id)">Decline</a>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2" style="">
                                                                <div id="statusHolder">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2" style="">
                                                                <span ng-bind="problem.timer"></span>

                                                            </div>
                                                            <div class="col-md-2">


                                                            </div>

                                                        </div>
                                                        <div class="collapse container" uib-collapse="problem.isCollapsed" style="background: antiquewhite;width: 100%" ng-show="showOffersManu" ng-cloak>
                                                            <!-- <a href="home/problem/<%offer.id%>"> -->
                                                            <div class="row" ng-repeat="offer in problem.offers" style="padding: 10px 5px">

                                                                <div class="col-md-1" my-offer offer="offer">
                                                                 <p ng-bind="offer.isMine">

                                                                 </p>
                                                             </div>

                                                             <div class="col-md-5" style="background: #fdf0e0;">

                                                                Offer description: <%offer.description | limitTo:50%>

                                                            </div>

                                                            <div class="col-md-1 pull-right" style="">
                                                             $<%offer.price%>
                                                         </div>
                                                         <div class="col-md-2 pull-right" style="">
                                                             <div style="" ng-bind="offer.created_at | dateFilter: 'MM/dd/yyyy @ h:mma'"></div>
                                                         </div>
                                                     </div>
                                                     <!-- </a> -->
                                                 </div>
                                             </div>
                                         </div>

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
