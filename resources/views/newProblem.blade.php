@extends('admin')
@section('navName')
	Add problem
@stop
@section('navMenu')

    @parent
     <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
     
    <li class="active">
        <strong>Add problem</strong>
    </li>                
@stop
@section('manageUsers')
<div class="row" style="margin-top: 20px" ng-controller="newProblemController">
                <div class="col-lg-12" >
                    <div id="showNewProblemForm" class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add new problem</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form method="get" class="form-horizontal"  ng-submit="addProblemSubmit()" name="newProblemForm" novalidate>
                                <div class="form-group"><label class="col-sm-2 control-label">Problem name/type</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" ng-model="probName" required></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10"><textarea class="form-control" style="resize:none;height:200px" ng-model="probDescription" required></textarea>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Problem category</label>
                                  <div class="col-sm-10" style="margin-top:7px">
                                           
                                                <label> <input type="radio"  name="chType" ng-model="answer" value="Math" ng-required="!answer"> <i></i> Math </label>
                                            
                                      
                                                <label style="margin-left: 15px"> <input type="radio" name="chType" ng-model="answer" value="Physics" ng-required="!answer"> <i></i> Physics </label>
                                       
                                       
                                                <label style="margin-left: 15px"> <input type="radio" name="chType" ng-model="answer" value="Programming" ng-required="!answer"> <i></i> Programming </label>
                                      
                                      
                                  </div>
                                </div>
                               
                            </form>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group" id="uploadHolderr">
                                    <form action="/home/api/application/uploadProblem" class="dropzone" id="dropzoneForm" style="border: 1px dashed gray;width:99%;margin:auto auto;border-radius: 3px;background: #ececec" enctype="multipart/form-data" >
                                        <div class="fallback">
                                           <input name="file" type="file" id="fileSelected" ng-mdoel="aa" multiple />
                                        </div>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/> 
                                        <!-- <span class="dz-upload2"></span> -->
                                    </form>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group" style="margin-bottom: 53px">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary pull-left" ng-click="addProblemSubmit()" id="showSubmitButton"  ng-disabled="newProblemForm.$invalid" style="display: none;">With params</button>
                                        <button class="btn btn-primary pull-left" ng-click="addProblemSubmit()" id="showSubmitButton2" ng-disabled="newProblemForm.$invalid" style="">Without params</button>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div id="showProblemConfirm" style="display: none" >
                        <div class="ibox-content" >
                            <div class="middle-box text-center animated fadeInDown" style="max-width: 600px;">
                                <i class="fa fa-exchange fa-4x" aria-hidden="true"></i>

                                <h4>Your problem is our concern now, all you need to do is sit, relax and wait for offers. After you receive offers you can choose one of them which suits you the best. </h4>

                                <div class="error-desc" style="margin-bottom: 40px">
                                    <br/><a href="/home" class="btn btn-primary">Back home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop
