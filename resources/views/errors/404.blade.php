@extends('layouts.app')
@section('topMenu')
  @section('homeLink')

  @endsection
  @section('topMenuItems')
  @endsection
@endsection
@section('content')
  <div class="main-container parallax jumbotron border-clear light-translucent-bg text-center margin-clear" style="background-image:url('images/fullscreen-bg.jpg');">
      <div class="container">
        <div class="row">
          <!-- main start -->
          <!-- ================ -->
          <div class="main col-md-6 col-md-offset-3 pv-40">
            <h1 class="page-title"><span class="text-default">404</span></h1>
            <h2>Ooops! Page Not Found</h2>
            <p>The requested URL was not found on this server. Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly.</p>
            <!-- <form role="search">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Search">
                <i class="fa fa-search form-control-feedback"></i>
              </div>
            </form> -->
            <a href="{{ url('/') }}" class="btn btn-default btn-animated btn-lg">Return Home <i class="fa fa-home"></i></a>
          </div>
          <!-- main end -->
        </div>
      </div>
    </div>
@endsection
