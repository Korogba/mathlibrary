<!DOCTYPE html>
<html class="boxed">
    <head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>MathOnline Library</title>

		<!-- Favicon -->
		{{--<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" {{ asset('/css/app.css') }} />--}}
		<link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href=" {{ asset('/vendor/bootstrap/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('/vendor/fontawesome/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ asset('/vendor/owlcarousel/owl.carousel.min.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('/vendor/owlcarousel/owl.theme.default.min.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('/vendor/magnific-popup/magnific-popup.css') }}" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-shop.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-animate.css') }}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/rs-plugin/css/settings.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('vendor/circle-flip-slideshow/css/component.css') }}" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('css/skins/default.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="{{ asset('css/ie.css') }}">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="{{ asset('vendor/respond/respond.js') }}"></script>
			<script src="{{ asset('vendor/excanvas/excanvas.js') }}"></script>
		<![endif]-->
        @yield('head')

	</head>
	<body>
        <div class="container">
            {{--@include('flash::message')--}}
        </div>

		<div class="body">

            @yield('body')


			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>MathOnline</span>
						</div>
						<div class="col-md-8">
							<div class="contact-details">
								<h4 class="heading-primary">Contact Us</h4>
								<ul class="contact">
									<li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> Mathematics Department, Ahmadu Bello University, Zaria Kaduna, Nigeria.</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (234) 456-7890</p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mathematics@abulibrary.edu.ng</a></p></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="{{ url('/home') }}" class="logo">
									<img alt="Porto Website Template" class="img-responsive" src="{{ asset('img/logo-footer.png') }}">
								</a>
							</div>
							<div class="col-md-7">
								<p>© Copyright 2015. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									<ul>
										<li><a href="#">FAQ's</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<!--[if lt IE 9]>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
		<!--<![endif]-->
		<script src="{{ asset('vendor/jquery.appear/jquery.appear.js') }}"></script>
		<script src="{{ asset('vendor/jquery.easing/jquery.easing.js') }}"></script>
		<script src="{{ asset('vendor/jquery-cookie/jquery-cookie.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap/bootstrap.js') }}"></script>
		<script src="{{ asset('vendor/common/common.js') }}"></script>
		<script src="{{ asset('vendor/jquery.validation/jquery.validation.js') }}"></script>
		<script src="{{ asset('vendor/jquery.stellar/jquery.stellar.js') }}"></script>
		<script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
		<script src="{{ asset('vendor/jquery.gmap/jquery.gmap.js') }}"></script>
		<script src="{{ asset('vendor/isotope/jquery.isotope.js') }}"></script>
		<script src="{{ asset('vendor/owlcarousel/owl.carousel.js') }}"></script>
		<script src="{{ asset('vendor/jflickrfeed/jflickrfeed.js') }}"></script>
		<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('vendor/vide/vide.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('js/theme.js') }}"></script>

		<!-- Specific Page Vendor and Views -->
		<script src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
		<script src="{{ asset('vendor/circle-flip-slideshow/js/jquery.flipshow.js') }}"></script>
		<script src="{{ asset('js/views/view.home.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('js/theme.init.js') }}"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-12345678-1']);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>
		 -->
        @yield('footer')

	</body>
</html>
