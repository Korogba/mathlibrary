var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.styles([
        'vendor/bootstrap/bootstrap.css',
        'vendor/fontawesome/css/font-awesome.css',
        'vendor/owlcarousel/owl.carousel.min.css',
        'vendor/owlcarousel/owl.theme.default.min.css',
        'vendor/magnific-popup/magnific-popup.css',
        'css/theme.css',
        'css/theme-elements.css',
        'css/theme-blog.css',
        'css/theme-shop.css',
        'css/theme-animate.css',
        'vendor/rs-plugin/css/settings.css',
        'vendor/circle-flip-slideshow/css/component.css',
        'css/skins/default.css',
        'css/custom.css'
    ], 'public/output/final.css', 'public');

    mix.scripts([
        'vendor/jquery/jquery.js',
        'vendor/jquery.appear/jquery.appear.js',
        'vendor/jquery.easing/jquery.easing.js',
        'vendor/jquery-cookie/jquery-cookie.js',
        'vendor/bootstrap/bootstrap.js',
        'vendor/common/common.js',
        'vendor/jquery.validation/jquery.validation.js',
        'vendor/jquery.stellar/jquery.stellar.js',
        'vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js',
        'vendor/jquery.gmap/jquery.gmap.js',
        'vendor/isotope/jquery.isotope.js',
        'vendor/owlcarousel/owl.carousel.js',
        'vendor/jflickrfeed/jflickrfeed.js',
        'vendor/magnific-popup/jquery.magnific-popup.js',
        'vendor/vide/vide.js',
        'js/theme.js',
        'vendor/rs-plugin/js/jquery.themepunch.tools.min.js',
        'vendor/rs-plugin/js/jquery.themepunch.revolution.min.js',
        'vendor/circle-flip-slideshow/js/jquery.flipshow.js',
        'js/views/view.home.js',
        'js/custom.js',
        'js/theme.init.js'
    ], 'public/output/final.js', 'public');

});
