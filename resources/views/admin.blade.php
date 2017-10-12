<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{Auth::user()->name}}'s page</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../../css/animate.css" rel="stylesheet">
    <link href="../../../../css/style.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="../../../../css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="../../../../css/plugins/iCheck/custom.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="../../../../css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- FooTable -->
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <link href="{{asset('/bower_components/angular-toastr/dist/angular-toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('/bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('/bower_components/ng-dropzone/dist/ng-dropzone.min.css')}}" rel="stylesheet">
    <!-- Gritter -->
    <link href="../../../../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="../../../../bower_components/summernote/dist/summernote.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Lato';
      }

      [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
        display: none !important;
      }

      .fa-btn {
        margin-right: 6px;
      }
      .category {
        display:block;
        font-size:20px;
        background:black;
        color:#fff;
        margin:10px;
        padding:10px;
        text-align:center;
      }

      .category.ng-enter {
        /* standard transition code */
        -webkit-transition: 2s linear all;
        transition: 2s linear all;
        opacity:0;
      }

      .category.ng-enter.ng-enter-active {
        /* standard transition styles */
        opacity:1;
      }
      
      .arrow-up {
        width: 10px;
        height: 10px;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        position: absolute;
        margin-top: -10px;
        margin-left: 5px;
        border-bottom: 10px solid black;
      }

      .arrow-up2 {
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        position: absolute;
        margin-top: -9px;
        margin-left: 6px;
        border-bottom: 9px solid white;
      }
    </style>
  </head>
  <body id="app-layout" ng-app="kbkApp">
    @if (count($errors) > 0)
    <div id="alarm"class="alert alert-danger" style="position: absolute;top:0px;z-index: 10000;width:100%;">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div id="wrapper">
      <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
              <div class="dropdown profile-element">
                <span>
                  <img alt="image" class="img-circle" src="{{asset('avatars/'.Auth::user()->picture)}}" width="53px" height="53px" />
                </span> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear">
                  <span class="block m-t-xs">
                    <strong class="font-bold">
                      {{Auth::user()->name}} {{Auth::user()->lastName}}
                    </strong>
                  </span> 
                  <span class="text-muted text-xs block">
                    {{Auth::user()->role->display_name}}
                  </span>
                </a>
              </div>
              <div class="logo-element">Rukhell</div>
            </li>
            <!-- App side menu -->
            <li style="margin-top:-4px" >
              <a href="{{ route('home') }}">
                <i class="fa fa-home"></i> <span class="nav-label" id="mngu">Home</span>
              </a>
            </li>
            @if(Auth::user()->is('admin') || Auth::user()->is('moderator'))
              <li style="margin-top:-4px"><a href="{{route('showManage')}}"><i class="fa fa-users"></i>
                <span class="nav-label" id="mngu">Manage users</span></a></li>
                <li><a href="{{ route('assigned') }}"><i class="fa fa-book" aria-hidden="true"></i>
                  <span class="nav-label">Assigned to me
                    @if($assigns != 0)
                    <span class="badge" style="background-color:#ed5565; margin-top:-2px; margin-left:2px; color:white">{{$assigns}}</span>
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(Auth::user()->is('admin'))
            <li style="margin-top:-4px">
              <a href="{{ route('showSettingsPage') }}">
                <i class="fa fa-cog"></i> <span class="nav-label" id="mngu">Settings</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->is('regular'))
              <li style="margin-top:-4px">
                <a href="{{ route('newProblem') }}">
                  <i class="fa fa-plus"></i> <span class="nav-label" id="mngu">Submit task</span>
                </a>
              </li>
            @endif
            <li style="margin-top:-4px">
              <a href="{{ route('editUser') }}">
                <i class="fa fa-user"></i> <span class="nav-label">Edit profile</span>
              </a>
            </li>
            <li>
              <a href="{{ route('showInbox') }}">
                <i class="fa fa-envelope"></i>
                <span id="mailBox"class="nav-label">Mailbox
                  @if($myMessagesCount != 0)
                    <span class="badge" style="background-color:#ed5565; margin-top:-2px; margin-left:2px; color:white">{{$myMessagesCount}}</span>
                  @endif
                </span>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <div id="page-wrapper" class="gray-bg" style="min-height: 100vh">
        <div class="row border-bottom">
          <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" ng-controller="userSearchController">
              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
              <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                  <input type="text" placeholder="Search for people..." class="form-control" name="top-search" id="top-search" ng-model="keywords" ng-change="search2()">
                </div>
              </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
              <li>
                <a href="/logout">
                  <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                </a>
              </li>
            </ul>
          </nav>
          <div>
            <div class="" id="responseDiv2" style="width:250px;max-height:200px;border:1px solid gray;position: absolute;margin-top:-5px;display:none;margin-left:70px;z-index: 999;background-color: white;z-index:9999;border-radius:2px;box-shadow: 0px 1px 3px #888888;">
              <div class='arrow-up'></div>
              <div class='arrow-up2'></div>
              <div id="responseDiv22"></div>
            </div>
          </div>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
            <ol class="breadcrumb" style="padding-top: 15px">
              @section('navMenu') @show
            </ol>
          </div>
        </div>
        @yield('manageUsers')
      </div>
    </div>
  <!-- Mainly scripts -->

  <script type="text/javascript" src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

  <script src="../../../../js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="../../../../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- Flot -->
  <script src="../../../../js/plugins/flot/jquery.flot.js"></script>
  <script src="../../../../js/plugins/flot/jquery.flot.spline.js"></script>
  <script src="../../../../js/plugins/flot/jquery.flot.time.js"></script>
  <!-- Custom and plugin javascript -->
  <script src="../../../../js/inspinia.js"></script>
  <script src="../../../../js/plugins/pace/pace.min.js"></script>
  <script type="text/javascript" src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular/angular.min.js')}}"></script>

  <script src="../../../../js/plugins/sweetalert/sweetalert.min.js"></script>

  <script type="text/javascript" src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>
  <!-- <script type="text/javascript" src="{{asset('bower_components/angular-chart.js/dist/angular-chart.min.js')}}"></script> -->
  <script type="text/javascript" src="{{asset('js/plugins/footable/footable.all.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-footable/dist/angular-footable.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/ng-idle/angular-idle.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/ng-dropzone/dist/ng-dropzone.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-toastr/dist/angular-toastr.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-animate/angular-animate.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-summernote/dist/angular-summernote.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
  <script type="text/javascript" src="{{asset('bower_components/angular-socket-io/socket.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/summernote/dist/summernote.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/lodash/dist/lodash.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('bower_components/restangular/dist/restangular.min.js')}}"></script>
  <!-- Main js file -->
  <script src="{{asset('js/app.js')}}"></script>
  <!-- App js services  -->
  <script src="{{asset('js/scripts/services/alert-service.js')}}"></script>
  <script src="{{asset('js/scripts/user/user-service.js')}}"></script>
  <script src="{{asset('js/scripts/utils/util-service.js')}}"></script>
  <script src="{{asset('js/scripts/services/socket-service.js')}}"></script>
  <script src="{{asset('js/scripts/problem/dropzone/dropzone-service.js')}}"></script>
  <!-- App js filters -->
  <script src="{{asset('js/scripts/utils/filters/filters.js')}}"></script>
  <!-- App js resources -->
  <script src="{{asset('js/scripts/user/user-resource.js')}}"></script>
  <script src="{{asset('js/scripts/problem/problem-resource.js')}}"></script>
  <!-- App js controllers -->
  <script src="{{asset('js/scripts/utils/util-controller.js')}}"></script>
  <script src="{{asset('js/scripts/user/user-controller.js')}}"></script>
  <script src="{{asset('js/scripts/problem/problem-controller.js')}}"></script>
  <!-- <script src="{{asset('js/scripts/problem/dropzone-controller.js')}}"></script> -->
  <!-- <script src="{{asset('js/scripts/problem/payment/payment-controller.js')}}"></script> -->

  @section('chartTableJs')
  <script type="text/javascript">
    var data1 = [
    [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6],[17,6]
    ];
    var data2 = [
    [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,1],[17,1]
    ];
    $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
     data1, data2
     ],
     {
       series: {
         lines: {
           show: false,
           fill: true
         },
         splines: {
           show: true,
           tension: 0.4,
           lineWidth: 1,
           fill: 0.4
         },
         points: {
           radius: 0,
           show: true
         },
         shadowSize: 2
       },
       grid: {
         hoverable: true,
         clickable: true,
         tickColor: "#d5d5d5",
         borderWidth: 1,
         color: '#d5d5d5'
       },
       colors: ["#1ab394", "#1C84C6"],
       xaxis:{
       },
       yaxis: {
         ticks: 4
       },
       tooltip: false
     }
     );
    var doughnutData = [
    {
     value: 300,
     color: "#a3e1d4",
     highlight: "#1ab394",
     label: "App"
   },
   {
     value: 50,
     color: "#dedede",
     highlight: "#1ab394",
     label: "Software"
   },
   {
     value: 100,
     color: "#A4CEE8",
     highlight: "#1ab394",
     label: "Laptop"
   }
   ];

   var doughnutOptions = {
     segmentShowStroke: true,
     segmentStrokeColor: "#fff",
     segmentStrokeWidth: 2,
         percentageInnerCutout: 45, // This is 0 for Pie charts
         animationSteps: 100,
         animationEasing: "easeOutBounce",
         animateRotate: true,
         animateScale: false
       };

       var ctx = document.getElementById("doughnutChart").getContext("2d");
       var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
  </script>
  @show  
  </body>
</html>

