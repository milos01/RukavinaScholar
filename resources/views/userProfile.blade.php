@extends('admin')
@section('navName')
	Profile
@stop
@section('manageUsers')
    <!-- Send message modal -->
                <div id="sendMessageModal" class="modal fade" role="dialog">
                    <div class="modal-dialog" style="width:450px">

                <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New message</h4>
                        </div>
                        <p style="margin-top:6px;padding:0px 17px">To <b>{{$user->name}} {{$user->lastName}}</b></p>
                        <form ng-submit="submitMessageForm()" ng-controller="sendDirectMessageController" name="sendMessageUserForm" novalidate>
                            <div class="modal-body" style="padding: 20px 30px 20px 30px">
                                <textarea class="form-control" rows="5" cols="52" style="resize:none" ng-model="message" required></textarea>
                                <input type="hidden" id="userID" value="{{$user->id}}">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" ng-disabled="sendMessageUserForm.$invalid">Send message</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>

                    </div>
                </div>
                <!-- End send message modal -->
                <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-5 col-md-offset-3">
                    <div class="ibox float-e-margins">
                        
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img alt="image" class="img-responsive" src="../../img/{{$user->picture}}">
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong>{{$user->name}} {{$user->lastName}}</strong></h4>
                                <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                                <h5>
                                    About me
                                </h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                                </p>
                                <div class="row m-t-lg">
                                    <div class="col-md-4">
                                        <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                        <h5><strong>169</strong> Posts</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                        <h5><strong>28</strong> Following</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                                        <h5><strong>240</strong> Followers</h5>
                                    </div>
                                </div>
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#sendMessageModal"><i class="fa fa-envelope" ></i> Send Message</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-coffee"></i> Buy a coffee</button>
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