@extends('app')

@section('title')
    <title>MathOnline Library</title>
@endsection

@section('body')

    <div role="main" class="main">

        <div class="slider-container slider-container-fullscreen">
            <div class="slider" id="revolutionSliderFullScreen" data-plugin-revolution-slider data-plugin-options='{"fullScreen": "on", "autoPlay": true, "autoplayTimeout": 3000}'>
                <ul>
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="300">
                        <img src="{{ asset('/img/slides/slide-bg-full.jpg') }}" data-fullwidthcentering="on" alt="">

                        <div class="tp-caption sft stb visible-lg"
                             data-x="417"
                             data-y="100"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="{{ asset('/img/slides/slide-title-border.png') }}" alt=""></div>

                        <div class="tp-caption top-label lfl stl"
                             data-x="center"
                             data-y="100"
                             data-speed="300"
                             data-start="500"
                             data-easing="easeOutExpo">GET ACCESS TO</div>

                        <div class="tp-caption sft stb visible-lg"
                             data-x="717"
                             data-y="100"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="{{ asset('/img/slides/slide-title-border.png') }}" alt=""></div>

                        <div class="tp-caption main-label sft stb"
                             data-x="center"
                             data-y="130"
                             data-speed="300"
                             data-start="1500"
                             data-easing="easeOutExpo">ANY BOOK!</div>

                        <div class="tp-caption bottom-label sft stb"
                             data-x="center"
                             data-y="200"
                             data-speed="500"
                             data-start="2000"
                             data-easing="easeOutExpo">Search and Reserve Available Books.</div>

                        <a class="tp-caption customin btn btn-lg btn-primary main-button" href="#intro"
                           data-x="center"
                           data-y="250"
                           data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                           data-speed="800"
                           data-start="2500"
                           data-easing="Back.easeInOut"
                           data-endspeed="300">
                            Sign In Now!
                        </a>

                        <div class="tp-caption main-label sft stb visible-lg"
                             data-x="center"
                             data-y="365"
                             data-speed="500"
                             data-start="2700"
                             data-easing="easeOutExpo"><i class="fa fa-arrow-circle-o-down"></i></div>

                    </li>

                    <li data-transition="fade" data-slotamount="10" data-masterspeed="300">
                        <img src="{{ asset('/img/slides/slide-bg-full.jpg') }}" data-fullwidthcentering="on" alt="">

                        <div class="tp-caption sft stb visible-lg"
                             data-x="417"
                             data-y="100"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="{{ asset('/img/slides/slide-title-border.png') }}" alt=""></div>

                        <div class="tp-caption top-label lfl stl"
                             data-x="center"
                             data-y="100"
                             data-speed="300"
                             data-start="500"
                             data-easing="easeOutExpo">TONS OF BOOKS</div>

                        <div class="tp-caption sft stb visible-lg"
                             data-x="717"
                             data-y="100"
                             data-speed="300"
                             data-start="1000"
                             data-easing="easeOutExpo"><img src="{{ asset('/img/slides/slide-title-border.png') }}" alt=""></div>

                        <div class="tp-caption main-label sft stb"
                             data-x="center"
                             data-y="130"
                             data-speed="300"
                             data-start="1500"
                             data-easing="easeOutExpo">A CLICK AWAY!</div>

                        <div class="tp-caption bottom-label sft stb"
                             data-x="center"
                             data-y="200"
                             data-speed="500"
                             data-start="2000"
                             data-easing="easeOutExpo">Search and Reserve Available Books.</div>

                        <a class="tp-caption customin btn btn-lg btn-primary main-button" href="#intro"
                           data-x="center"
                           data-y="250"
                           data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                           data-speed="800"
                           data-start="2500"
                           data-easing="Back.easeInOut"
                           data-endspeed="300">
                            Sign In Now!
                        </a>

                        <div class="tp-caption main-label sft stb visible-lg"
                             data-x="center"
                             data-y="365"
                             data-speed="500"
                             data-start="2700"
                             data-easing="easeOutExpo"><i class="fa fa-arrow-circle-o-down"></i></div>

                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!--suppress CssUnknownTarget -->
    <section class="parallax section section-text-light section-parallax section-center m-none" id="intro" data-stellar-background-ratio="0.5" style="background-image: url(img/parallax.jpg);">

        <div class="container">

            <div class="row">

                <div class="col-md-6">
                    <div class="featured-boxes">
                        <div class="featured-box featured-box-primary align-left mt-xlg">
                            <div class="box-content">
                                <h4 class="heading-primary text-uppercase mb-md">Sign In</h4>
                                {!! Form::open(['url'=>'/auth/login', 'id'=>'frmSignIn']) !!}
                                {{--<form action="{{ url( '/') }}" id="frmSignIn" method="post">--}}
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>E-mail Address</label>
                                                <input name="email" type="email" value="{{ old('email') }}" required placeholder="username@abu.edu.ng" class="form-control input-lg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <a class="pull-right" href="{{ url('/password/email') }}">(Lost Password?)</a>
                                                <label>Password</label>
                                                <input name="password" type="password" value="" required class="form-control input-lg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
													<span class="remember-box checkbox">
														<label for="remember">
                                                            <input type="checkbox" id="remember" name="remember">Remember Me
                                                        </label>
													</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" value="Login" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('partials.errors');
                </div>
            </div>

        </div>

    </section>

@endsection

@section('footer')
{{--
    Returning an array or json from AuthenticateUsers.php via AuthController .php
        allows can make this AJAX jQuery work

    <script>
        $(document).ready(function(){
            $('#frmSignIn').submit(function(){
                var data = $('#frmSignIn').serialize();
                $.post($('#frmSignIn').attr('action'),data, function(data){
                    alert("Nope "+data);
                });

                return false;
            })
        });
    </script>--}}
@endsection

