<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ setting('site_name') }} | @stack('title')</title>
    <meta name="robots" content="noindex, follow" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta -->
    <meta name="title" content="{{ setting('meta_title') }}">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keywords" content="{{ setting('meta_keywords') }}">

    <!-- Open Graph (Facebook, etc.) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ setting('og_title') ?? setting('meta_title') }}">
    <meta property="og:description" content="{{ setting('og_description') ?? setting('meta_description') }}">
    <meta property="og:image" content="{{ asset(setting('og_image')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ setting('meta_title') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ setting('twitter_card') ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ setting('og_title') ?? setting('meta_title') }}">
    <meta name="twitter:description" content="{{ setting('og_description') ?? setting('meta_description') }}">
    <meta name="twitter:image" content="{{ asset(setting('og_image')) }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset(setting('site_favicon')) }}" type="image/png">

    <!-- All CSS is here
	============================================ -->

    <link rel="stylesheet" href="{{asset('/')}}frontend/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/vendor/elegant.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/vendor/linear-icon.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/nice-select.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/easyzoom.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/slick.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/animate.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/')}}frontend/css/style.css">

    @stack('styles')

<body>

    <div class="main-wrapper">
        @include('frontend.layout.header')
        <!-- mobile header start -->

        <!-- mini cart start -->
        @include('frontend.layout.sidebar')

        @yield('body')

        @include('frontend.layout.footer')
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="{{asset('/')}}frontend/images/product/product-1.jpg" alt="">
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="{{asset('/')}}frontend/images/product/product-3.jpg" alt="">
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="{{asset('/')}}frontend/images/product/product-6.jpg" alt="">
                                    </div>
                                </div>
                                <div class="quickview-wrap mt-15">
                                    <div class="nav nav-style-6">
                                        <button class="nav-link active" id="pro-1-tab" data-bs-toggle="tab" data-bs-target="#pro-1" type="button" role="tab"
                                            aria-controls="pro-1" aria-selected="true">
                                            <img src="{{asset('/')}}frontend/images/product/quickview-s1.jpg" alt="product-thumbnail">
                                        </button>
                                        <button class="nav-link" id="pro-2-tab" data-bs-toggle="tab" data-bs-target="#pro-2" type="button" role="tab"
                                            aria-controls="pro-2" aria-selected="true">
                                            <img src="{{asset('/')}}frontend/images/product/quickview-s2.jpg" alt="product-thumbnail">
                                        </button>
                                        <button class="nav-link" id="pro-3-tab" data-bs-toggle="tab" data-bs-target="#pro-3" type="button" role="tab"
                                            aria-controls="pro-3" aria-selected="true">
                                            <img src="{{asset('/')}}frontend/images/product/quickview-s3.jpg" alt="product-thumbnail">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                                <div class="product-details-content quickview-content">
                                    <h2>Simple Black T-Shirt</h2>
                                    <div class="product-ratting-review-wrap">
                                        <div class="product-ratting-digit-wrap">
                                            <div class="product-ratting">
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                            </div>
                                            <div class="product-digit">
                                                <span>5.0</span>
                                            </div>
                                        </div>
                                        <div class="product-review-order">
                                            <span>62 Reviews</span>
                                            <span>242 orders</span>
                                        </div>
                                    </div>
                                    <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>
                                    <div class="pro-details-price">
                                        <span class="new-price">$75.72</span>
                                        <span class="old-price">$95.72</span>
                                    </div>
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul>
                                                <li><a class="dolly" href="#">dolly</a></li>
                                                <li><a class="white" href="#">white</a></li>
                                                <li><a class="azalea" href="#">azalea</a></li>
                                                <li><a class="peach-orange" href="#">Orange</a></li>
                                                <li><a class="mona-lisa active" href="#">lisa</a></li>
                                                <li><a class="cupid" href="#">cupid</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-size">
                                        <span>Size:</span>
                                        <div class="pro-details-size-content">
                                            <ul>
                                                <li><a href="#">XS</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-quality">
                                        <span>Quantity:</span>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                    <div class="product-details-meta">
                                        <ul>
                                            <li><span>Categories:</span> <a href="#">Woman,</a> <a href="#">Dress,</a> <a href="#">T-Shirt</a></li>
                                            <li><span>Tag: </span> <a href="#">Fashion,</a> <a href="#">Mentone</a> , <a href="#">Texas</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-action-wrap">
                                        <div class="pro-details-add-to-cart">
                                            <a title="Add to Cart" href="#">Add To Cart </a>
                                        </div>
                                        <div class="pro-details-action">
                                            <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                                            <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                                            <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                            <div class="product-dec-social">
                                                <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                                <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                                <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                                <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    </div>

    <!-- All JS is here
============================================ -->

    <script src="{{asset('/')}}frontend/js/vendor/modernizr-3.11.7.min.js"></script>
    <script src="{{asset('/')}}frontend/js/vendor/jquery-v3.6.0.min.js"></script>
    <script src="{{asset('/')}}frontend/js/vendor/jquery-migrate-v3.3.2.min.js"></script>
    <script src="{{asset('/')}}frontend/js/vendor/popper.min.js"></script>
    <script src="{{asset('/')}}frontend/js/vendor/bootstrap.min.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/slick.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/jquery.nice-select.min.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/wow.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/jquery-ui.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/sticky-sidebar.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/easyzoom.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/scrollup.js"></script>
    <script src="{{asset('/')}}frontend/js/plugins/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="{{asset('/')}}frontend/js/main.js"></script>

</body>

</html>
