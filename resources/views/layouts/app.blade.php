<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html lang="en" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html dir="ltr" lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>The Project | Home Education</title>
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
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Font Awesome CSS -->
        <link href="../fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Fontello CSS -->
        <link href="../fonts/fontello/css/fontello.css" rel="stylesheet">

        <!-- Plugins -->
        <link href="../plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
        <link href="../plugins/rs-plugin-5/css/settings.css" rel="stylesheet">
        <link href="../plugins/rs-plugin-5/css/layers.css" rel="stylesheet">
        <link href="../plugins/rs-plugin-5/css/navigation.css" rel="stylesheet">
        <link href="../css/css/animations.css" rel="stylesheet">
        <link href="../plugins/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="../plugins/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">
        <link href="../plugins/hover/hover-min.css" rel="stylesheet">

        <!-- The Project's core CSS file -->
        <!-- Use css/rtl_style.css for RTL version -->
        <link href="../css/css/style.css" rel="stylesheet" >
        <!-- The Project's Typography CSS file, includes used fonts -->
        <!-- Used font for body: Roboto -->
        <!-- Used font for headings: Raleway -->
        <!-- Use css/rtl_typography-default.css for RTL version -->
        <link href="../css/css/typography-default.css" rel="stylesheet" >
        <!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
        <link href="../css/css/skins/cool_green.css" rel="stylesheet">


        <!-- Custom css -->
        <link href="../css/css/custom.css" rel="stylesheet">
    </head>

    <!-- body classes:  -->
    <!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
    <!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
    <!-- "transparent-header": makes the header transparent and pulls the banner to top -->
    <!-- "gradient-background-header": applies gradient background to header -->
    <!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
    <body class="no-trans front-page   page-loader-1">

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
                <div class="header-top  colored">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-2 col-sm-5">
                                <!-- header-top-first start -->
                                <!-- ================ -->
                                <div class="header-top-first clearfix">
                                    <!-- <ul class="social-links circle small clearfix hidden-xs">
                                        <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                        <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>

                                    </ul> -->
                                    <ul class="list-inline" style="display: inline-flex;">
                                        @yield('homeLink')
                                    </ul>
                                    <div class="social-links hidden-lg hidden-md hidden-sm circle small">
                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                                            <ul class="dropdown-menu dropdown-animation">
                                                <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                                <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                                <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                                <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                                <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                                                <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                                                <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                                <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- header-top-first end -->

                            </div>

                            <div class="col-xs-10 col-sm-7">
                                @section('topMenuItems')
                                <!-- header-top-second start -->
                                <!-- ================ -->
                                <div id="header-top-second"  class="clearfix text-right">
                                    <nav>
                                        <ul class="list-inline">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li class="hidden-sm hidden-xs"></li>


                                            @if (Auth::guest())
                                                <li class="hidden-sm hidden-xs"><a href="{{ url('/login') }}" class="link-light">Log in</a></li>
                                                <li class="hidden-sm hidden-xs"><a href="{{ url('/register') }}" class="link-light">Sign up</a></li>
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
                                    </nav>
                                </div>
                                <!-- header-top-second end -->
                                @show
                            </div>

                        </div>
                    </div>
                </div>
                <!-- header-top end -->



            <!-- banner start -->
            <!-- ================ -->
            @yield('content')
            <!-- footer top end -->
            <!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
            <!-- ================ -->
            <footer id="footer" class="clearfix ">

                <!-- .footer start -->
                <!-- ================ -->
                <div class="footer">
                    <div class="container">
                        <div class="footer-inner">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="footer-content">
                                        <h2 class="title logo-font text-default">The College</h2>
                                        <div class="separator-2"></div>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Lorem ipsum dolor sit</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i>  Consectetur adipisicing elit</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Rerum iure temporibus</a></li>
                                            </ul>
                                        </nav>
                                        <h4 class="title text-default"><i class="fa fa-wechat pr-10"></i> Consectetur adipisicing</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-forms.html"><i class="fa fa-chevron-circle-right"></i> Repudiandae porro doloribus</a></li>
                                                <li><a href="components-tabs-and-pills.html"><i class="fa fa-chevron-circle-right"></i> Amet culpa</a></li>
                                                <li><a target="_blank" href="http://htmlcoder.me/support"><i class="fa fa-chevron-circle-right"></i> Atque vero laudantium</a></li>
                                                <li><a href="#"><i class="fa fa-chevron-circle-right"></i> Loat dolot aspree</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="footer-content">
                                        <h4 class="title text-default"><i class="fa fa-search pr-10"></i> Resources</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Vel consequatur</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Provident obcaecati</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Illo perspiciatis</a></li>
                                                <li><a href="components-forms.html"><i class="fa fa-chevron-circle-right"></i> acilis maiores</a></li>
                                                <li><a href="components-tabs-and-pills.html"><i class="fa fa-chevron-circle-right"></i> Enim modi</a></li>
                                            </ul>
                                        </nav>
                                        <h4 class="title text-default"><i class="fa fa-users pr-10"></i> Staff/Faculty</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-forms.html"><i class="fa fa-chevron-circle-right"></i> acilis maiores</a></li>
                                                <li><a href="components-tabs-and-pills.html"><i class="fa fa-chevron-circle-right"></i> Enim modi</a></li>
                                                <li><a target="_blank" href="http://htmlcoder.me/support"><i class="fa fa-chevron-circle-right"></i> Support</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="footer-content">
                                        <h4 class="title text-default"><i class="fa fa-file-text-o pr-10"></i> Admission</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-forms.html"><i class="fa fa-chevron-circle-right"></i> Facilis maiores</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Provident obcaecati</a></li>
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Vel consequatur</a></li>
                                                <li><a target="_blank" href="http://htmlcoder.me/support"><i class="fa fa-chevron-circle-right"></i> Support</a></li>
                                            </ul>
                                        </nav>
                                        <h4 class="title text-default"><i class="fa fa-child pr-10"></i> Students</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Illo perspiciatis</a></li>
                                                <li><a href="components-tabs-and-pills.html"><i class="fa fa-chevron-circle-right"></i> Enim modi</a></li>
                                                <li><a href="#"><i class="fa fa-chevron-circle-right"></i> Privacy</a></li>
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Vel consequatur</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="footer-content">
                                        <h4 class="title text-default"><i class="fa fa-institution pr-10"></i> Schools</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Consectetur adipisicing elit</a></li>
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Lorem ipsum dolor sit</a></li>
                                                <li><a href="components-tabs-and-pills.html"><i class="fa fa-chevron-circle-right"></i> Amet culpa</a></li>
                                                <li><a href="components-forms.html"><i class="fa fa-chevron-circle-right"></i> Repudiandae porro doloribus</a></li>
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Rerum iure temporibus</a></li>
                                                <li><a target="_blank" href="http://htmlcoder.me/support"><i class="fa fa-chevron-circle-right"></i> Atque vero laudantium</a></li>
                                            </ul>
                                        </nav>
                                        <h4 class="title text-default"><i class="fa fa-info-circle pr-10"></i> Information</h4>
                                        <nav class="mb-20">
                                            <ul class="nav nav-pills nav-stacked list-style-icons">
                                                <li><a href="components-buttons.html"><i class="fa fa-chevron-circle-right"></i> Consectetur adipisicing elit</a></li>
                                                <li><a href="components-social-icons.html"><i class="fa fa-chevron-circle-right"></i> Lorem ipsum dolor sit</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .footer end -->

                <!-- .subfooter start -->
                <!-- ================ -->
                <div class="subfooter default-bg">
                    <div class="container">
                        <div class="subfooter-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center"><span class="logo-font pr-10">The College</span> Copyright © 2017 The Project by <a class="link-light" target="_blank" href="http://htmlcoder.me">HtmlCoder</a>. All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .subfooter end -->

            </footer>
            <!-- footer end -->

        </div>
        <!-- page-wrapper end -->

        <!-- JavaScript files placed at the end of the document so the pages load faster -->
        <!-- ================================================== -->
        <!-- Jquery and Bootstap core js files -->
        <script type="text/javascript" src="../plugins/jquery.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- Modernizr javascript -->
        <script type="text/javascript" src="../plugins/modernizr.js"></script>
        <script type="text/javascript" src="../plugins/rs-plugin-5/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
        <script type="text/javascript" src="../plugins/rs-plugin-5/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
        <!-- Isotope javascript -->
        <script type="text/javascript" src="../plugins/isotope/isotope.pkgd.min.js"></script>
        <!-- Magnific Popup javascript -->
        <script type="text/javascript" src="../plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- Appear javascript -->
        <script type="text/javascript" src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <!-- Count To javascript -->
        <script type="text/javascript" src="../plugins/jquery.countTo.js"></script>
        <!-- Parallax javascript -->
        <script src="../plugins/jquery.parallax-1.1.3.js"></script>
        <!-- Contact form -->
        <script src="../plugins/jquery.validate.js"></script>
        <!-- Google Maps javascript -->
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=your_google_map_key"></script>
        <script type="text/javascript" src="js/js/google.map.config.js"></script> -->
        <!-- Background Video -->
        <script src="../plugins/vide/jquery.vide.js"></script>
        <!-- Owl carousel javascript -->
        <script type="text/javascript" src="../plugins/owlcarousel2/owl.carousel.min.js"></script>
        <!-- Pace javascript -->
        <script type="text/javascript" src="../plugins/pace/pace.min.js"></script>
        <!-- SmoothScroll javascript -->
        <script type="text/javascript" src="../plugins/jquery.browser.js"></script>
        <script type="text/javascript" src="../plugins/SmoothScroll.js"></script>
        <!-- Initialization of Plugins -->
        <script type="text/javascript" src="../js/js/template.js"></script>
        <!-- Custom Scripts -->
        <script type="text/javascript" src="../js/js/custom.js"></script>

    </body>
</html>
