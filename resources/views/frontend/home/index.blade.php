@extends('frontend.layout.index')
@push('title')
Home
@endpush
@section('body')
@include('frontend.home.slider')
<div class="service-area">
    <div class="container">
        <div class="service-wrap service-wrap-hm9">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-service-wrap mb-30">
                        <div class="service-icon service-icon-blue">
                            <i class="icon-cursor"></i>
                        </div>
                        <div class="service-content">
                            <h3>Free Shipping</h3>
                            <span>Orders over $100</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-service-wrap mb-30">
                        <div class="service-icon service-icon-blue">
                            <i class="icon-reload"></i>
                        </div>
                        <div class="service-content">
                            <h3>Free Returns</h3>
                            <span>Within 30 days</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-service-wrap mb-30">
                        <div class="service-icon service-icon-blue">
                            <i class="icon-lock"></i>
                        </div>
                        <div class="service-content">
                            <h3>100% Secure</h3>
                            <span>Payment Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-service-wrap mb-30">
                        <div class="service-icon service-icon-blue">
                            <i class="icon-tag"></i>
                        </div>
                        <div class="service-content">
                            <h3>Best Price</h3>
                            <span>Guaranteed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-us-area pt-60 pb-120">
    <div class="container">
        <div class="about-us-content-3 text-center">
            <h3>Welcome To <span>norda</span> - one stop marketplace ecommerce in usa </h3>
            <p>We have over 50K+ products different adaptive your purpose shopping </p>
        </div>
    </div>
</div>
<div class="banner-area pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="banner-wrap mb-30">
                    <div class="banner-img banner-img-zoom">
                        <a href="product-details.html"><img src="{{asset('/')}}frontend/images/banner/banner-27.jpg" alt=""></a>
                    </div>
                    <div class="banner-content-11">
                        <h2><span>Zara</span> Pattern Boxed <br>Underwear</h2>
                        <p class="mrg-inc">Stretch, & Fress cool</p>
                        <div class="btn-style-4">
                            <a class="hover-red" href="product-details.html">Shop now <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="banner-wrap mb-30">
                    <div class="banner-img banner-img-zoom">
                        <a href="product-details.html"><img src="{{asset('/')}}frontend/images/banner/banner-28.jpg" alt=""></a>
                    </div>
                    <div class="banner-content-20">
                        <div class="banner-content-20-top">
                            <div class="banner-content-20-brand">
                                <span>JATA</span>
                            </div>
                            <p>super bass <br>tech 2.0</p>
                        </div>
                        <h2>Sone Speaker</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-120">
    <div class="container">
        <div class="section-title-6 section-title-6-xs mb-25 text-center">
            <h2>best seller in last month</h2>
        </div>
        <div class="tab-style-9 nav mb-60">
            <a class="active" href="#product-6" data-bs-toggle="tab">Top 20 </a>
            <a href="#product-7" data-bs-toggle="tab"> Electronic </a>
            <a href="#product-8" data-bs-toggle="tab">Apparel </a>
            <a href="#product-9" data-bs-toggle="tab"> Computer </a>
            <a href="#product-10" data-bs-toggle="tab"> Cookware </a>
            <a href="#product-11" data-bs-toggle="tab"> Baby </a>
        </div>
        <div class="tab-content jump">
            <div id="product-6" class="tab-pane active">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-7" class="tab-pane">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-8" class="tab-pane">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-9" class="tab-pane">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-10" class="tab-pane">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-11" class="tab-pane">
                <div class="product-slider-active-3 nav-style-3">
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-45.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-35%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Ciate London Makeup</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star "></i>
                                    </div>
                                    <span>(1)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$86.75 </span>
                                    <span class="old-price">$94.52</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ella Beauty</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-20%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-44.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(3)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$123.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">InterioUS</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-41.jpg" alt="">
                                </a>
                                <span class="pro-badge left bg-red">-40%</span>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Advantage Baby Milk</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$38.50 </span>
                                    <span class="old-price">$42.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">olabear.com</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-43.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Pampers baby-dry diapers</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(6)</span>
                                </div>
                                <div class="product-price-4">
                                    <span>$43.50 </span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">Ugmonko</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="{{asset('/')}}frontend/images/product/product-42.jpg" alt="">
                                </a>
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Wishlist"><i class="icon-heart"></i></button>
                                    <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                    <button title="Compare"><i class="icon-refresh"></i></button>
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star gray"></i>
                                    </div>
                                    <span>(2)</span>
                                </div>
                                <div class="product-price-4">
                                    <span class="new-price">$26.50 </span>
                                    <span class="old-price">$45.85</span>
                                </div>
                                <div class="product-author">
                                    <span>Seller: <a href="#">jetapo shop</a></span>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-categories-area pb-60">
    <div class="container">
        <div class="section-title-6 section-title-6-xs mb-60 text-center">
            <h2>popular categories</h2>
        </div>
        <div class="product-categories-slider-3 nav-style-3">
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-50.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">Fashion</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-89.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">pet supplies</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-51.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">Electronic</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-90.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">kid clothes</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-52.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">computer</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-91.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">smart home</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-53.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">beauty</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-92.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">car parts</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-54.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">sport</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-93.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">gym equipments</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-55.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">baby</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-94.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">infant</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-52.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">computer</a></h5>
                    </div>
                </div>
            </div>
            <div class="product-plr-1">
                <div class="single-product-wrap mb-50">
                    <div class="product-img product-img-border border-blue mb-20">
                        <a href="shop.html">
                            <img src="{{asset('/')}}frontend/images/product/product-50.png" alt="">
                        </a>
                    </div>
                    <div class="product-content-categories-2 product-content-blue text-center">
                        <h5><a href="shop.html">Fashion</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="deal-area">
    <div class="container">
        <div class="deal-bg-color">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="deal-content-2 pl-50">
                        <span>hot deal</span>
                        <h2>
                            <span>50% SALE OFF</span> Norda QLED TV
                        </h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="deal-content-2 pl-35">
                        <p>Discover our collection with leather simple backpacks. Less is more never out trend</p>
                        <div class="deal-btn-2">
                            <a href="product-details.html">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="deal-img">
                        <a href="product-details.html"><img src="{{asset('/')}}frontend/images/product/deal-product.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pt-115 pb-120">
    <div class="container">
        <div class="section-title-6 section-title-6-xs mb-60 text-center">
            <h2>Sugguest today</h2>
        </div>
        <div class="row">
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-62.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Mini Protector</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">USoffice</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Mini Protector</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">USoffice</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-63.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Coolpix Camera</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Coolpix Camera</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-64.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Phone 6S 64 GB</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Phone 6S 64 GB</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-65.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Mobile Tab A</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50  </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">USoffice</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Norda Mobile Tab A</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50 </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">USoffice</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-66.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">DJ Spark II Quadcopter</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">DJ Spark II Quadcopter</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">Electrone</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-67.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Brown T-shirt</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">jetaposhop</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Brown T-shirt</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">jetaposhop</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-68.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">olabear.com</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchoe Backpack</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">olabear.com</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-69.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Adidas Grey Sport Sneaker</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">olabear.com</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Adidas Grey Sport Sneaker</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">olabear.com</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-70.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchose White Duffles</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50  </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">etaposhop</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Herchose White Duffles</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50 </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">etaposhop</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-71.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Rayban Round Sunglasses</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">sunglassjp</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Rayban Round Sunglasses</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">sunglassjp</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-72.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Comet Rice Cooker</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Comet Rice Cooker</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <span>(4)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$19.98 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-73.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Ikea Set 24 Knifes</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">IKEASG</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Ikea Set 24 Knifes</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(2)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$26.50 </span>
                            <span class="old-price">$45.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">IKEASG</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-74.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Pack 10 Utensils</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">IKEASG</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Pack 10 Utensils</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(6)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$43.50 </span>
                            <span class="old-price">$52.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">IKEASG</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-75.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50  </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">White Plastic Chair</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star gray"></i>
                                <i class="icon_star gray"></i>
                            </div>
                            <span>(3)</span>
                        </div>
                        <div class="product-price-4">
                            <span class="new-price">$123.50 </span>
                            <span class="old-price">$152.85</span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html">
                            <img src="{{asset('/')}}frontend/images/product/product-76.jpg" alt="">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-3">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Black Leather Chair</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <h3 class="mrg-none"><a class="blue" href="product-details.html">Black Leather Chair</a></h3>
                        <div class="product-rating-wrap-2">
                            <div class="product-rating-4">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star "></i>
                            </div>
                            <span>(1)</span>
                        </div>
                        <div class="product-price-4">
                            <span>$86.75 </span>
                        </div>
                        <div class="product-author">
                            <span>Seller: <a href="#">homeuk</a></span>
                        </div>
                        <div class="pro-add-to-cart-2">
                            <button title="Add to Cart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-product-btn text-center">
            <a href="shop.html">More Product</a>
        </div>
    </div>
</div>
<div class="about-us-area bg-gray-8 pt-115 pb-115">
    <div class="container">
        <div class="about-us-content-4">
            <div class="about-us-content-4-title">
                <h4>Norda: The One-stop Shopping Destination</h4>
            </div>
            <p>E-commerce is revolutionizing the way we all shop in Bangladesh. Why do you want to hop from one store to another in search of the latest phone when you can find it on the Internet in a single click? Not only mobiles. Norda houses everything you can possibly imagine, from trending electronics like laptops, tablets, smartphones, and mobile accessories to in-vogue fashion staples like shoes, clothing and lifestyle accessories; from modern furniture like sofa sets, dining tables, and wardrobes to appliances that make your life easy like washing machines, TVs, ACs, mixer grinder juicers and other time-saving kitchen and small appliances; from home furnishings like cushion covers, mattresses and bedsheets to toys and musical instruments, we got them all covered. You name it, and you can stay assured about finding them all here. For those of you with erratic working hours, norda is your best bet. Shop in your PJs, at night or in the wee hours of the morning. This e-commerce never shuts down.</p>
            <p>What's more, with our year-round shopping festivals and events, our prices are irresistible. We're sure you'll find yourself picking up more than what you had in mind. If you are wondering why you should shop from Flipkart when there are multiple options available to you, well, the below will answer your question.</p>
            <div class="about-us-content-4-title">
                <h4>Norda Plus</h4>
            </div>
            <p>A world of limitless possibilities awaits you - Norda Plus was kickstarted as a loyalty reward programme for all its regular customers at zero subscription fee. All you need is 500 supercoins to be a part of this service. For every 100 rupees spent on Norda order, Plus members earns 4 supercoins & non-plus members earn 2 supercoins. Free delivery, early access during sales and shopping festivals, exchange offers and priority customer service are the top benefits to a Norda Plus member. In short, earn more when you shop more!</p>
            <p>What's more, you can even use the Flipkart supercoins for a number of exciting services, like:
                An annual Zomato Gold membership</p>
        </div>
    </div>
</div>
<div class="subscribe-area pt-95 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="section-title-3">
                    <h2>Our Newsletter</h2>
                    <p>Get updates by subscribe our weekly newsletter</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div id="mc_embed_signup" class="subscribe-form-2">
                    <form id="mc-embedded-subscribe-form" class="validate subscribe-form-style-2" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                        <div id="mc_embed_signup_scroll" class="mc-form-2 mc-form-2-bg-gray">
                            <input class="email" type="email" required="" placeholder="Enter your email address" name="EMAIL" value="">
                            <div class="mc-news-2" aria-hidden="true">
                                <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                            </div>
                            <div class="clear-2 clear-2-blue">
                                <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
