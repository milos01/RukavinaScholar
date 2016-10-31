<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{Auth::user()->name}}'s page</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../css/bootstrap.min.css"
          rel="stylesheet">
    <link href="../../../../font-awesome/css/font-awesome.css"
          rel="stylesheet">

    <link href="../../../../css/animate.css" rel="stylesheet">
    <link href="../../../../css/style.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="../../../../css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="../../../../css/plugins/iCheck/custom.css" rel="stylesheet">
        <!-- Sweet Alert -->
    <link href="../../../../css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../../../../css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="../../../../css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="../../../../css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="../../../../css/tooltip.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="../../../../css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato';
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

<!-- End update user -->
<div id="wrapper" ng-controller="mainController">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
						<span> 
                        
                        <img alt="image" class="img-circle"
                                    src="../../../../img/{{Auth::user()->picture}}" width="53px" height="53px" />
                                    
						</span> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span
                                    class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">
                                        {{Auth::user()->name}} {{Auth::user()->lastName}}
                                        </strong>
							</span> <span class="text-muted text-xs block">
                            {{ucfirst(Auth::user()->role)}}
						    </span>
                        </a>
                    </div>
                    <div class="logo-element">KBK</div>
                </li>
                <!-- Admin side menu -->
                <li style="margin-top:-4px" ><a href="/home"><i class="fa fa-home"></i>
                        <span class="nav-label" id="mngu">Home</span></a></li>
                @if(Auth::user()->is('admin'))
                    
                    <li style="margin-top:-4px"><a href="/home/manage"><i class="fa fa-users"></i>
                        <span class="nav-label" id="mngu">Manage users</span></a></li>

                    <li><a href="/home/manage"><i class="fa fa-area-chart"></i>
                        <span class="nav-label">Statistics</span></a></li>
                    <li><a href="/home/assigned"><i class="fa fa-book" aria-hidden="true"></i>
                        <span class="nav-label">Assigned to me </span></a></li>

                @elseif(Auth::user()->is('moderator'))
                    <li><a href="/home/assigned"><i class="fa fa-book" aria-hidden="true"></i>
                        <span class="nav-label">Assigned to me </span></a></li>
                    
                @elseif(Auth::user()->is('regular'))
                    <li style="margin-top:-4px"><a href="/home/newproblem"><i class="fa fa-plus"></i>
                        <span class="nav-label" id="mngu">Submit problem</span></a></li>
                    <li style="margin-top:-4px"><a href="/home/newproblem"><i class="fa fa-book" aria-hidden="true"></i>
                        <span class="nav-label" id="mngu">My problems</span></a></li>
                @endif
                 
                    <li style="margin-top:-4px"><a href="/home/edit"><i class="fa fa-cog"></i>
                        <span class="nav-label">Edit profile</span></a></li>

                        <li>
                        <a href="/home/inbox"><i class="fa fa-envelope"></i>
                            <span id="mailBox"class="nav-label">Mailbox 

                            @if($myMessagesCount != 0)
                               
                                <div id="redDot" style="border-radius: 50%;padding: 2px 2px;width:10px;height:10px;background: red;font-size: 10px; position: absolute; left:33px;top:13px;color:white">
                                    <!-- {{$myMessagesCount}} -->
                                </div>
                            @endif  
                            </span>
                            
                        </a>
                    </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation"
                 style="margin-bottom: 0">
                <div class="navbar-header" ng-controller="userSearchController">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
                       href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for people..." class="form-control" name="top-search" id="top-search" ng-model="keywords" ng-change="search2()">
                        </div>
                    </form>
                    
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li><a href="/logout"> <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                        </a></li>
                </ul>

            </nav>

            <div class="" id="responseDiv2" style="width:250px;max-height:200px;border:1px solid gray;position: absolute;margin-top:-5px;display:none;margin-left:70px;z-index: 999;background-color: white;z-index:9999;border-radius:2px;box-shadow: 0px 1px 3px #888888;">
                  
            </div>
            <!-- <div class='arrow-example arrow-border-example'></div><div class='arrow-example'></div> -->
        </div>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><b>
                @section('navName')
                @show
                </b></h2>
                <ol class="breadcrumb">
                @section('navMenu')
                @show
                </ol>
            </div>
        </div>
        
        @yield('manageUsers')
    </div>
    <!-- Mainly scripts -->
    
    <script src="../../../../js/jquery-2.1.1.js"></script>
    <script src="../../../../js/bootstrap.min.js"></script>
    <script
            src="../../../../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script
            src="../../../../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../../../../js/plugins/flot/jquery.flot.js"></script>
    <script
            src="../../../../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script
            src="../../../../js/plugins/flot/jquery.flot.spline.js"></script>
    <script
            src="../../../../js/plugins/flot/jquery.flot.resize.js"></script>
    <script
            src="../../../../js/plugins/flot/jquery.flot.pie.js"></script>
    <script
            src="../../../../js/plugins/flot/jquery.flot.symbol.js"></script>

    <script
            src="../../../../js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script
            src="../../../../js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../../../../js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../../../js/inspinia.js"></script>
    <script src="../../../../js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../../../../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script
            src="../../../../js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script
            src="../../../../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script
            src="../../../../js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script
            src="../../../../js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../../../../js/demo/sparkline-demo.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
    <!-- Image cropper -->
    <script src="../../../../js/plugins/cropper/cropper.min.js"></script>

   
    <script src="../../../../js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../../../../js/plugins/dropzone/dropzone.js"></script>
    <!-- Socket.IO -->
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <!-- Toastr script -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-animate.js"></script>
    <script src="../../../../js/plugins/toastr/toastr.min.js"></script>
    <!-- Sweet alert -->
    <script src="../../../../js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../../../../js/app.js"></script>
    @section('jsSocket')

    @show
    <!-- iCheck -->
    <script src="../../../../js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    <script>

        $(document).ready(function() {





                    var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });
            
            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            // $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });
                    $('.chart').easyPieChart({
                        barColor : '#f8ac59',
                        //                scaleColor: false,
                        scaleLength : 5,
                        lineWidth : 4,
                        size : 80
                    });

                    $('.chart2').easyPieChart({
                        barColor : '#1c84c6',
                        //                scaleColor: false,
                        scaleLength : 5,
                        lineWidth : 4,
                        size : 80
                    });

                    var data2 = [ [ gd(2012, 1, 1), 7 ],
                        [ gd(2012, 1, 2), 6 ], [ gd(2012, 1, 3), 4 ],
                        [ gd(2012, 1, 4), 8 ], [ gd(2012, 1, 5), 9 ],
                        [ gd(2012, 1, 6), 7 ], [ gd(2012, 1, 7), 5 ],
                        [ gd(2012, 1, 8), 4 ], [ gd(2012, 1, 9), 7 ],
                        [ gd(2012, 1, 10), 8 ], [ gd(2012, 1, 11), 9 ],
                        [ gd(2012, 1, 12), 6 ], [ gd(2012, 1, 13), 4 ],
                        [ gd(2012, 1, 14), 5 ],
                        [ gd(2012, 1, 15), 11 ],
                        [ gd(2012, 1, 16), 8 ], [ gd(2012, 1, 17), 8 ],
                        [ gd(2012, 1, 18), 11 ],
                        [ gd(2012, 1, 19), 11 ],
                        [ gd(2012, 1, 20), 6 ], [ gd(2012, 1, 21), 6 ],
                        [ gd(2012, 1, 22), 8 ],
                        [ gd(2012, 1, 23), 11 ],
                        [ gd(2012, 1, 24), 13 ],
                        [ gd(2012, 1, 25), 7 ], [ gd(2012, 1, 26), 9 ],
                        [ gd(2012, 1, 27), 9 ], [ gd(2012, 1, 28), 8 ],
                        [ gd(2012, 1, 29), 5 ], [ gd(2012, 1, 30), 8 ],
                        [ gd(2012, 1, 31), 25 ] ];

                    var data3 = [ [ gd(2012, 1, 1), 800 ],
                        [ gd(2012, 1, 2), 500 ],
                        [ gd(2012, 1, 3), 600 ],
                        [ gd(2012, 1, 4), 700 ],
                        [ gd(2012, 1, 5), 500 ],
                        [ gd(2012, 1, 6), 456 ],
                        [ gd(2012, 1, 7), 800 ],
                        [ gd(2012, 1, 8), 589 ],
                        [ gd(2012, 1, 9), 467 ],
                        [ gd(2012, 1, 10), 876 ],
                        [ gd(2012, 1, 11), 689 ],
                        [ gd(2012, 1, 12), 700 ],
                        [ gd(2012, 1, 13), 500 ],
                        [ gd(2012, 1, 14), 600 ],
                        [ gd(2012, 1, 15), 700 ],
                        [ gd(2012, 1, 16), 786 ],
                        [ gd(2012, 1, 17), 345 ],
                        [ gd(2012, 1, 18), 888 ],
                        [ gd(2012, 1, 19), 888 ],
                        [ gd(2012, 1, 20), 888 ],
                        [ gd(2012, 1, 21), 987 ],
                        [ gd(2012, 1, 22), 444 ],
                        [ gd(2012, 1, 23), 999 ],
                        [ gd(2012, 1, 24), 567 ],
                        [ gd(2012, 1, 25), 786 ],
                        [ gd(2012, 1, 26), 666 ],
                        [ gd(2012, 1, 27), 888 ],
                        [ gd(2012, 1, 28), 900 ],
                        [ gd(2012, 1, 29), 178 ],
                        [ gd(2012, 1, 30), 555 ],
                        [ gd(2012, 1, 31), 993 ] ];

                    var dataset = [ {
                        label : "Number of orders",
                        data : data3,
                        color : "#1ab394",
                        bars : {
                            show : true,
                            align : "center",
                            barWidth : 24 * 60 * 60 * 600,
                            lineWidth : 0
                        }

                    }, {
                        label : "Payments",
                        data : data2,
                        yaxis : 2,
                        color : "#1C84C6",
                        lines : {
                            lineWidth : 1,
                            show : true,
                            fill : true,
                            fillColor : {
                                colors : [ {
                                    opacity : 0.2
                                }, {
                                    opacity : 0.4
                                } ]
                            }
                        },
                        splines : {
                            show : false,
                            tension : 0.6,
                            lineWidth : 1,
                            fill : 0.1
                        },
                    } ];

                    var options = {
                        xaxis : {
                            mode : "time",
                            tickSize : [ 3, "day" ],
                            tickLength : 0,
                            axisLabel : "Date",
                            axisLabelUseCanvas : true,
                            axisLabelFontSizePixels : 12,
                            axisLabelFontFamily : 'Arial',
                            axisLabelPadding : 10,
                            color : "#d5d5d5"
                        },
                        yaxes : [ {
                            position : "left",
                            max : 1070,
                            color : "#d5d5d5",
                            axisLabelUseCanvas : true,
                            axisLabelFontSizePixels : 12,
                            axisLabelFontFamily : 'Arial',
                            axisLabelPadding : 3
                        }, {
                            position : "right",
                            clolor : "#d5d5d5",
                            axisLabelUseCanvas : true,
                            axisLabelFontSizePixels : 12,
                            axisLabelFontFamily : ' Arial',
                            axisLabelPadding : 67
                        } ],
                        legend : {
                            noColumns : 1,
                            labelBoxBorderColor : "#000000",
                            position : "nw"
                        },
                        grid : {
                            hoverable : false,
                            borderWidth : 0
                        }
                    };

                    function gd(year, month, day) {
                        return new Date(year, month - 1, day).getTime();
                    }

                    var previousPoint = null, previousLabel = null;

                    $.plot($("#flot-dashboard-chart"), dataset, options);

                    var mapData = {
                        "US" : 298,
                        "SA" : 200,
                        "DE" : 220,
                        "FR" : 540,
                        "CN" : 120,
                        "AU" : 760,
                        "BR" : 550,
                        "IN" : 200,
                        "GB" : 120,
                    };

                    $('#world-map').vectorMap({
                        map : 'world_mill_en',
                        backgroundColor : "transparent",
                        regionStyle : {
                            initial : {
                                fill : '#e4e4e4',
                                "fill-opacity" : 0.9,
                                stroke : 'none',
                                "stroke-width" : 0,
                                "stroke-opacity" : 0
                            }
                        },

                        series : {
                            regions : [ {
                                values : mapData,
                                scale : [ "#1ab394", "#22d6b1" ],
                                normalizeFunction : 'polynomial'
                            } ]
                        },
                    });
                });
    </script>
   
</body>
</body>
</html>
