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
<div class="row" style="margin-top: 20px">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add new problem</h5>
                            
                        </div>
                        <div class="ibox-content" ng-controller="newProblemController">
                            <form method="get" class="form-horizontal"  ng-submit="addProblemSubmit()" name="newProblemForm" novalidate>
                                <div class="form-group"><label class="col-sm-2 control-label">Problem name/type</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" ng-model="probName" required></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10"><textarea class="form-control" style="resize:none;height:200px" ng-model="probDescription"></textarea>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Problem category</label>
                                  <div class="col-sm-10">
                                           
                                                <label> <input type="radio"  name="chType" ng-model="answer" value="Math"> <i></i> Math </label>
                                            
                                      
                                                <label> <input type="radio" name="chType" ng-model="answer" value="Physics"> <i></i> Physics </label>
                                       
                                       
                                                <label> <input type="radio" name="chType" ng-model="answer" value="Programming"> <i></i> Programming </label>
                                      
                                      
                                  </div>
                                </div>
                               
                            </form>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group" id="uploadHolderr">
                                    <form action="/home/uploadProblem" class="dropzone" id="dropzoneForm" style="border: 1px dashed gray;width:99%;margin:auto auto;border-radius: 3px;background: #ececec" enctype="multipart/form-data" >
                                        <div class="fallback">
                                           <input name="file" type="file" id="fileSelected" ng-mdoel="aa" multiple />
                                        </div>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/> 
                                    </form>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group" style="margin-bottom: 53px">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" ng-click="addProblemSubmit()" ng-disabled="newProblemForm.$invalid">Submit problem</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop
