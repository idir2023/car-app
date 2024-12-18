<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">

    <!-- title of site -->
    <title>CarVilla</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="{{ 'assets_client/logo/favicon.png' }}" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/font-awesome.min.css' }}">

    <!--linear icon css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/linearicons.css' }}">

    <!--flaticon.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/flaticon.css' }}">

    <!--animate.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/animate.css' }}">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/owl.carousel.min.css' }}">
    <link rel="stylesheet" href="{{ 'assets_client/css/owl.theme.default.min.css' }}">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/bootstrap.min.css' }}">

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ 'assets_client/css/bootsnav.css' }}">

    <!--style.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/style.css' }}">

    <!--responsive.css-->
    <link rel="stylesheet" href="{{ 'assets_client/css/responsive.css' }}">
</head>

<body>


    <!--welcome-hero start -->
    @include('client.layouts.hero')
    <!--welcome-hero end -->

    <!--service start -->
    @include('client.layouts.service')
    <!--service end-->

    <!--new-cars start -->
    @include('client.layouts.newest_cars')
    <!--new-cars end -->

    <!--featured-cars start -->
    @include('client.layouts.featured_cars')
    <!--featured-cars end -->

    <!-- clients-say strat -->
    @include('client.layouts.clients_say')
    <!-- clients-say end -->

    <!--brand strat -->
    @include('client.layouts.brand')
    <!--brand end -->

    <!--blog start -->
    <section id="blog" class="blog"></section>
    <!--blog end -->

    <!--footer start-->
    <footer id="contact" class="contact">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="single-footer-widget">
                            <div class="footer-logo">
                                <a href="index.html">carvilla</a>
                            </div>
                            <p>
                                Ased do eiusm tempor incidi ut labore et dolore magnaian aliqua. Ut enim ad minim
                                veniam.
                            </p>
                            <div class="footer-contact">
                                <p>info@themesine.com</p>
                                <p>+1 (885) 2563154554</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="single-footer-widget">
                            <h2>about devloon</h2>
                            <ul>
                                <li><a href="#">about us</a></li>
                                <li><a href="#">career</a></li>
                                <li><a href="#">terms <span> of service</span></a></li>
                                <li><a href="#">privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="single-footer-widget">
                            <h2>top brands</h2>
                            <div class="row">
                                <div class="col-md-7 col-xs-6">
                                    <ul>
                                        <li><a href="#">BMW</a></li>
                                        <li><a href="#">lamborghini</a></li>
                                        <li><a href="#">camaro</a></li>
                                        <li><a href="#">audi</a></li>
                                        <li><a href="#">infiniti</a></li>
                                        <li><a href="#">nissan</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-5 col-xs-6">
                                    <ul>
                                        <li><a href="#">ferrari</a></li>
                                        <li><a href="#">porsche</a></li>
                                        <li><a href="#">land rover</a></li>
                                        <li><a href="#">aston martin</a></li>
                                        <li><a href="#">mersedes</a></li>
                                        <li><a href="#">opel</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-3 col-sm-6">
                        <div class="single-footer-widget">
                            <h2>news letter</h2>
                            <div class="footer-newsletter">
                                <p>
                                    Subscribe to get latest news update and informations
                                </p>
                            </div>
                            <div class="hm-foot-email">
                                <div class="foot-email-box">
                                    <input type="text" class="form-control" placeholder="Add Email">
                                </div><!--/.foot-email-box-->
                                <div class="foot-email-subscribe">
                                    <span><i class="fa fa-arrow-right"></i></span>
                                </div><!--/.foot-email-icon-->
                            </div><!--/.hm-foot-email-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            &copy; copyright.designed and developed by <a
                                href="https://www.themesine.com/">themesine</a>.
                        </p><!--/p-->
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div><!--/.footer-copyright-->
        </div><!--/.container-->

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top"
                    title="" data-original-title="Back to Top" aria-hidden="true"></i>
            </div>

        </div><!--/.scroll-Top-->

    </footer>
    <!--contact end-->

    <!-- Include all js compiled plugins (below), or include individual files as needed -->

    <script src="{{ 'assets_client/js/jquery.js' }}"></script>

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="{{ 'assets_client/js/bootstrap.min.js' }}"></script>

    <!-- bootsnav js -->
    <script src="{{ 'assets_client/js/bootsnav.js' }}"></script>

    <!--owl.carousel.js-->
    <script src="{{ 'assets_client/js/owl.carousel.min.js' }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!--Custom JS-->
    <script src="{{ 'assets_client/js/custom.js' }}"></script>
</body>

</html>
