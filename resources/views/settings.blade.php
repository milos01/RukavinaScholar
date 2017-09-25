@extends('admin')
@section('navName')
	Settings
@stop
@section('navMenu')
	@parent
	 <li>
         <a href="{{url('/home')}}">Home</a>
     </li>
    <li class="active">
    	<strong>Settings</strong>
    </li>
@stop
@section('manageUsers')
<!-- Modal -->
<div id="addCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:400px">

    <!-- Modal content-->
     <form method="POST" action="{!! route('addNewCategory') !!}" name="addStaffForm" novalidate>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add category</h4>
      </div>
      <div class="modal-body">
        <fieldset class="form-horizontal">
          <div class="form-group" ng-class="{ 'has-error' : addStaffForm.name.$invalid && !addStaffForm.name.$pristine }">
              <div class="col-sm-12"><input type="text" class="form-control" name="name" ng-model="staff.name" placeholder="Category name" required>
                <p ng-show="addStaffForm.name.$error.required && !addStaffForm.name.$pristine" style="font-size:14px;position:absolute;right:0px;margin-right:28px;color:#ed5565;margin-top:-28px">Name required</p>
              </div>
           </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-disabled="addStaffForm.$invalid">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
  </div>
</div>
<!-- End modal -->
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
	<div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"> Basic info</a></li>

                            </ul>
                            <div class="tab-content" ng-controller="editUserInfoController" ng-init="init({{Auth::user()}})">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                      <div class="row">
                                               <div class="col-lg-12">
                                                   <div class="wrapper wrapper-content animated fadeInUp">

                                                       <div class="ibox">
                                                           <div class="ibox-title">
                                                               <h5>Category list</h5>
                                                               <div class="ibox-tools">
                                                                   <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addCategoryModal">Add new task category</a>
                                                               </div>
                                                           </div>
                                                           <div class="ibox-content">
                                                               <div class="project-list">
                                                                   <table class="table table-hover">
                                                                       <tbody>
                                                                         @foreach($categories as $category)
                                                                         <!-- Modal -->
                                                                         <div id="deleteCategoryModal{{$category->id}}" class="modal fade" role="dialog">
                                                                           <div class="modal-dialog" style="width:400px">

                                                                             <!-- Modal content-->
                                                                             <form method="POST" action="{!! route('deleteCategory') !!}">
                                                                               {{ method_field('DELETE') }}
                                                                               <div class="modal-content">
                                                                                 <div class="modal-header">
                                                                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                   <h4 class="modal-title">Remove category</h4>
                                                                                 </div>
                                                                                 <div class="modal-body" style="text-align:center">
                                                                                   <p>Are you shure that you want to delete '{{$category->name}}' category</p>
                                                                                 </div>
                                                                                 <div class="modal-footer">
                                                                                   <input type="hidden" name="categoryId" value="{{$category->id}}">
                                                                                   <button type="submit" class="btn btn-danger" >Delete</button>
                                                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                 </div>
                                                                               </div>
                                                                             {{ csrf_field() }}
                                                                             </form>
                                                                           </div>
                                                                         </div>
                                                                         <!-- End modal -->

                                       	                                   <tr>
                                       	                                      <td class="project-title">
                                       	                                        <span>{{ $category->name }}</span>
                                       	                                      </td>

                                     	                                        <td class="project-actions">
                                   	                                            <a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteCategoryModal{{$category->id}}"><i class="fa fa-times"></i> Delete </a>
                                     	                                        </td>
                                       	                                   </tr>
                                                                         @endforeach
                                                                         @foreach($deleteCategories as $category)
                                       	                                   <tr style="background: rgba(237, 86, 102, .1)">
                                       	                                      <td class="project-title">
                                       	                                        <span>{{ $category->name }}</span>
                                       	                                      </td>

                                     	                                        <td class="project-actions">
                                                                                <form action="{!! route('activateCategory') !!}" method="POST">
                                                                                   {{ method_field('PUT') }}
                                                                                   <button type="submit" class="btn btn-primary btn-xs" ><i class="fa fa-check"></i> Activate </button>
                                                                                   <input type="hidden" name="categoryId" value="{{$category->id}}">
                                                                                   {{ csrf_field() }}
                                                                                </form>
                                     	                                        </td>
                                       	                                   </tr>
                                                                         @endforeach
                                                                       </tbody>
                                                                   </table>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            <strong>Danger!</strong> {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
@stop
