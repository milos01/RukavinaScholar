<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body id="app-layout" ng-app="kbkApp">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

               
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
    
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

              
                <ul class="nav navbar-nav navbar-right">
                                      @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


  

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-animate.js"></script>
  
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    
    <script src="../../../js/app.js"></script>
    @section('jsSocket')
    @show
</body>
</html> -->

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html lang="en" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>The Project | Home</title>
        <meta name="description" content="The Project a Bootstrap-based, Responsive HTML5 Template">
        <meta name="author" content="htmlcoder.me">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- Web Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

        <!-- Bootstrap core CSS -->
        <link href="landing_bootstrap/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Font Awesome CSS -->
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Fontello CSS -->
        <link href="landing_fonts/fonts/fontello/css/fontello.css" rel="stylesheet">

        <!-- Plugins -->
        <link href="landing_plugins/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
        <link href="landing_plugins/plugins/rs-plugin/css/settings.css" rel="stylesheet">
        <link href="landing_css/css/animations.css" rel="stylesheet">
        <link href="landing_plugins/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="landing_plugins/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
        <link href="landing_plugins/plugins/hover/hover-min.css" rel="stylesheet">      
        
        <!-- The Project's core CSS file -->
        <link href="landing_css/css/style.css" rel="stylesheet" >
        <!-- The Project's Typography CSS file, includes used fonts -->
        <!-- Used font for body: Roboto -->
        <!-- Used font for headings: Raleway -->
        <link href="landing_css/css/typography-default.css" rel="stylesheet" >
        <!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
        <link href="landing_css/css/skins/light_blue.css" rel="stylesheet">
        

        <!-- Custom css --> 
        <link href="landing_css/css/custom.css" rel="stylesheet">
        <style type="text/css">
            [ng\:cloak], [ng-cloak], .ng-cloak {
                display: none !important;
            }
        </style>
    </head>

    <!-- body classes:  -->
    <!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
    <!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
    <!-- "transparent-header": makes the header transparent and pulls the banner to top -->
    <!-- "gradient-background-header": applies gradient background to header -->
    <!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
    <body class="no-trans front-page transparent-header" ng-app="kbkApp">

        <!-- scrollToTop -->
        <!-- ================ -->
        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
        
        <!-- page wrapper start -->
        <!-- ================ -->
        <div class="page-wrapper">
        
            <!-- header-container start -->
            <div class="header-container">
                
                
                <!-- header-top start -->
                <!-- classes:  -->
                <!-- "dark": dark version of header top e.g. class="header-top dark" -->
                <!-- "colored": colored version of header top e.g. class="header-top colored" -->
                <!-- ================ -->
               
                <!-- header-top end -->
                
                <!-- header start -->
                <!-- classes:  -->
                <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
                <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
                <!-- "full-width": mandatory class for the full-width menu layout -->
                <!-- "centered": mandatory class for the centered logo layout -->
                <!-- ================ --> 
                <header class="header  fixed    clearfix">
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 ">
                                <!-- header-left start -->
                                <!-- ================ -->
                                <div class="header-left clearfix">
                                    
                                    <!-- logo -->
                                    <a href="{{ url('/') }}">
                                        <div id="logo" class="logo">
                                            <!-- <a href="index.html"><img id="logo_img" src="landing_plugins//logo_light_blue.png" alt="The Project"></a> -->
                                            Rukhell
                                        </div>
                                    </a>
                                    <!-- name-and-slogan -->
                                    <div class="site-slogan">
                                        Online problem solving
                                    </div>

                                </div>
                                <!-- header-left end -->

                            </div>
                            <div class="col-md-9">
                    
                                <!-- header-right start -->
                                <!-- ================ -->
                                <div class="header-right clearfix">
                                    
                                <!-- main-navigation start -->
                                <!-- classes: -->
                                <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                                <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                                <!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
                                <!-- ================ -->
                                <div class="main-navigation  animated with-dropdown-buttons">

                                    <!-- navbar start -->
                                    <!-- ================ -->
                                    <nav class="navbar navbar-default" role="navigation">
                                        <div class="container-fluid">

                                            <!-- Toggle get grouped for better mobile display -->
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                                
                                            </div>

                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                                <!-- main-menu -->
                                                <ul class="nav navbar-nav pull-right">
                                                    <li class="list-group">  
                                                        <a href="{{ url('/register') }}">Sign up</a>
                                                    </li>
                                                    <li class="dropdown ">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sign in</a>
                                                        <ul class="dropdown-menu" style="width: 400px; text-align: center" >
                                                             <!-- <div class="panel panel-default"> -->
                                                                <div class="panel-body" >
                                                                    <form class="form-horizontal" name="loginForm1" ng-submit="loginFormSubmit()" ng-controller="loginController"  novalidate>
                                                                        {!! csrf_field() !!}

                                                                        <div class="form-group" ng-class="{ 'has-error' : loginForm1.email.$invalid && !loginForm1.email.$pristine }">
                                                                            <label class="col-md-4 control-label">E-Mail Address</label>
                                                                            <!-- <p>E-Mail Address</p> -->
                                                                            <div class="col-md-12" style="margin: auto auto;">
                                                                                <input class="form-control" name="email" ng-model="email" autocomplete="off"  required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group" ng-class="{ 'has-error' : loginForm1.password.$invalid && !loginForm1.password.$pristine }">
                                                                            <label class="col-md-3 control-label">Password</label>
                                                                            <div class="col-md-12">
                                                                                <input type="password" class="form-control" name="password" ng-model="password" autocomplete="off" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" ng-show="loginForm1.email.$error.wrongInputs" style="color:#a94442" ng-cloak>
                                                                            Wrong email or password
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <div class="">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="remember" ng-model="remember"> Remember Me
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    
                                                                        <div class="form-group">
                                                                            <div class="">
                                                                                <button type="submit" id="loginButton1" class="btn btn-primary" ng-disabled="loginForm1.password.$error.required || loginForm1.email.$error.required">
                                                                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                                                                </button>

                                                                                <a class="btn btn-link" href="{{ url('/reset') }}">Forgot Your Password?</a>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            <!-- </div> -->
                                                           
                                                           
                                                        
                                                        </ul>
                                                    </li>
                                                    
                                                   
                                                 
                                                </ul>
                                                <!-- main-menu end -->
                                            </div>

                                        </div>
                                    </nav>
                                    <!-- navbar end -->

                                </div>
                                <!-- main-navigation end -->
                                </div>
                                <!-- header-right end -->
                    
                            </div>
                        </div>
                    </div>
                    
                </header>
                <!-- header end -->
            </div>
            <!-- header-container end -->
            @yield('content')
            <!-- banner start -->
            <!-- ================ -->
            
            <!-- footer end -->
            
        </div>
        <!-- page-wrapper end -->

        <!-- JavaScript files placed at the end of the document so the pages load faster -->
        <!-- ================================================== -->
        <!-- Jquery and Bootstap core js files -->
        <script type="text/javascript" src="landing_plugins/plugins/jquery.min.js"></script>
        <script type="text/javascript" src="landing_bootstrap/bootstrap/js/bootstrap.min.js"></script>

        <!-- Modernizr javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/modernizr.js"></script>
        <!-- jQuery Revolution Slider  -->
        <script type="text/javascript" src="landing_plugins/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="landing_plugins/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <!-- Isotope javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/isotope/isotope.pkgd.min.js"></script>
        <!-- Magnific Popup javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- Appear javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/waypoints/jquery.waypoints.min.js"></script>
        <!-- Count To javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/jquery.countTo.js"></script>
        <!-- Parallax javascript -->
        <script src="landing_plugins/plugins/jquery.parallax-1.1.3.js"></script>
        <!-- Contact form -->
        <script src="landing_plugins/plugins/jquery.validate.js"></script>
        <!-- Background Video -->
        <script src="landing_plugins/plugins/vide/jquery.vide.js"></script>
        <!-- Owl carousel javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/owl-carousel/owl.carousel.js"></script>
        <!-- SmoothScroll javascript -->
        <script type="text/javascript" src="landing_plugins/plugins/jquery.browser.js"></script>
        <script type="text/javascript" src="landing_plugins/plugins/SmoothScroll.js"></script>
        <!-- Initialization of Plugins -->
        <script type="text/javascript" src="landing_js/js/template.js"></script>
        <!-- Custom Scripts -->
        <script type="text/javascript" src="landing_js/js/custom.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-animate.js"></script>
      
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.1.2/ui-bootstrap-tpls.js"></script>
        <script src="../../../js/app.js"></script>
        <script src="../../../js/LoginJS.js"></script>
        @section('jsSocket')
        @show
    </body>
</html>

