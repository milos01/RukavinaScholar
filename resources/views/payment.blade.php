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
        <strong>Payment for {{$problem->subject}}</strong>
    </li>                
@stop
@section('manageUsers')
    <!-- {{$offer}} -->
    <div class="wrapper wrapper-content animated fadeInRight">


            <div class="row">
                <div class="col-md-4">
                    <div class="payment-card">
                        <i class="fa fa-cc-visa payment-icon-big text-success"></i>
                        <h2>
                            **** **** **** 1060
                        </h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <small>
                                    <strong>Expiry date:</strong> 10/16
                                </small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small>
                                    <strong>Name:</strong> David Williams
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="payment-card">
                        <i class="fa fa-cc-mastercard payment-icon-big text-warning"></i>
                        <h2>
                            **** **** **** 7002
                        </h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <small>
                                    <strong>Expiry date:</strong> 10/16
                                </small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small>
                                    <strong>Name:</strong> Anna Smith
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="payment-card">
                        <i class="fa fa-cc-discover payment-icon-big text-danger"></i>
                        <h2>
                            **** **** **** 3466
                        </h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <small>
                                    <strong>Expiry date:</strong> 10/16
                                </small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <small>
                                    <strong>Name:</strong> Morgan Stanch
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">


                


                <div class="col-lg-12">

                    <div class="ibox">
                        <div class="ibox-title" >
                            Payment info
                        </div>
                        <div class="ibox-content">

                            <div class="panel-group payments-method" id="accordion">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                    <h2>Summary</h2>
                                        <strong>Payment for solving task</strong> <br/>
                                        <strong>Price:</strong> <span class="text-navy">${{$offer->price}}.00</span>

                                                    <p class="m-t">
                                                        
                                                        When you make payment our professional tim will recive your problem and solve it in shorest posible time. 

                                                    </p>
                                        <div class="pull-right">
                                            <i class="fa fa-cc-paypal text-success"></i>
                                        </div>
                                        <h4 class="panel-title" style="margin-top: 20px">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color:#1c84c6">Choose paying method</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <form method="POST" action="/home/api/application/makePayment" 
                                                    ng-controller="braintreeController">
                                                        <!-- <div id="dropin-container"></div> -->
                                                        <button class="btn btn-primary" type="submit" style="margin-top:50px">Make a payment!</button>
                                                        <input type="hidden" name="sloId" value="{{$offer->personFrom->id}}">
                                                        <input type="hidden" name="probId" value="{{$offer->problem_id}}">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                            </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
@stop
<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>