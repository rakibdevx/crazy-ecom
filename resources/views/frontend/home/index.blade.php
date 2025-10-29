@extends('frontend.layout.index')
@push('title')
Home
@endpush
@section('body')
@include('frontend.home.slider')
{{-- <div class="service-area">
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
</div> --}}

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
@if ($best_sells->isNotEmpty() && setting('best_selling_enable'))
    <div class="product-area pb-120">
        <div class="container">
            <div class="section-title-6 section-title-6-xs mb-25 ">
                <div class="d-flex justify-content-between">
                    <h2>best selling Items </h2>
                    <div class="more-product-btn text-center">
                        <a href="{{route('product.best_selling_product')}}">More</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="tab-content jump">
                <div id="product-6" class="tab-pane active">
                    <div class="product-slider-active-3 nav-style-3">
                        @foreach ($best_sells as $product)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('product.details',$product->slug)}}">
                                            <img src="{{asset($product->thumbnail)}}" alt="">
                                        </a>
                                        @if ($product->has_variants == 0)
                                        <span class="pro-badge left bg-red">-{{setting('currency_symbol') . ($product->old_price - $product->sale_price) }}</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <button title="Wishlist"><i class="icon-heart"></i></button>
                                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            <button title="Compare"><i class="icon-refresh"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3 class="mrg-none text-capitalize"><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
                                        <h3 class="mrg-none text-capitalize"><a class="blue" href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif
                                        <div class="pro-add-to-cart-2">
                                            <button title="Add to Cart">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($deals->isNotEmpty() && setting('hot_deals_enable'))
    <div class="product-area pb-120">
        <div class="container">
            <div class="section-title-6 section-title-6-xs mb-25 ">
                <div class="d-flex justify-content-between">
                    <h2>Hot Deals </h2>
                    <div class="more-product-btn text-center">
                        <a href="{{route('product.hot_deals_product')}}">More</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="tab-content jump">
                <div id="product-6" class="tab-pane active">
                    <div class="product-slider-active-3 nav-style-3">
                        @foreach ($deals as $product)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('product.details',$product->slug)}}">
                                            <img src="{{asset($product->thumbnail)}}" alt="{{$product->name}}">
                                        </a>
                                        @if ($product->has_variants == 0)
                                        <span class="pro-badge left bg-red">-{{setting('currency_symbol') . ($product->old_price - $product->sale_price) }}</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <button title="Wishlist"><i class="icon-heart"></i></button>
                                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            <button title="Compare"><i class="icon-refresh"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3 class="mrg-none text-capitalize"><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
                                        <h3 class="mrg-none text-capitalize"><a class="blue" href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif
                                        <div class="pro-add-to-cart-2">
                                            <button title="Add to Cart">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($featureds->isNotEmpty() && setting('featured_products_enable'))
    <div class="product-area pb-120">
        <div class="container">
            <div class="section-title-6 section-title-6-xs mb-25 ">
                <div class="d-flex justify-content-between">
                    <h2>Featured Products</h2>
                    <div class="more-product-btn text-center">
                        <a href="{{route('product.featured_product')}}">More</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="tab-content jump">
                <div id="product-6" class="tab-pane active">
                    <div class="product-slider-active-3 nav-style-3">
                        @foreach ($featureds as $product)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('product.details',$product->slug)}}">
                                            <img src="{{asset($product->thumbnail)}}" alt="">
                                        </a>
                                        @if ($product->has_variants == 0)
                                        <span class="pro-badge left bg-red">-{{setting('currency_symbol') . ($product->old_price - $product->sale_price) }}</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <button title="Wishlist"><i class="icon-heart"></i></button>
                                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            <button title="Compare"><i class="icon-refresh"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3 class="mrg-none text-capitalize"><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
                                        <h3 class="mrg-none text-capitalize"><a class="blue" href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif
                                        <div class="pro-add-to-cart-2">
                                            <button title="Add to Cart">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($trendings->isNotEmpty() && setting('trending_products_enable'))
    <div class="product-area pb-120">
        <div class="container">
            <div class="section-title-6 section-title-6-xs mb-25 ">
                <div class="d-flex justify-content-between">
                    <h2>Trending Products </h2>
                <div class="more-product-btn text-center">
                    <a href="{{route('product.trending_product')}}">More</a>
                </div>
            </div>
            <hr>
            </div>
            <div class="tab-content jump">
                <div id="product-6" class="tab-pane active">
                    <div class="product-slider-active-3 nav-style-3">
                        @foreach ($trendings as $product)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('product.details',$product->slug)}}">
                                            <img src="{{asset($product->thumbnail)}}" alt="">
                                        </a>
                                        @if ($product->has_variants == 0)
                                        <span class="pro-badge left bg-red">-{{setting('currency_symbol') . ($product->old_price - $product->sale_price) }}</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <button title="Wishlist"><i class="icon-heart"></i></button>
                                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            <button title="Compare"><i class="icon-refresh"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3 class="mrg-none text-capitalize"><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
                                        <h3 class="mrg-none text-capitalize"><a class="blue" href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @php
                                                    $avgRating = round($product->averageRating());
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <i class="icon_star"></i>
                                                    @else
                                                        <i class="icon_star gray"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span>({{$product->totalRatings()}})</span>
                                        </div>
                                        <div class="product-price-4">
                                            @if ($product->has_variants == 0)
                                                <span class="new-price">{{ setting('currency_symbol') . $product->sale_price }}</span>
                                                @if ($product->old_price)
                                                    <span class="old-price">{{ setting('currency_symbol') . $product->old_price }}</span>
                                                @endif
                                            @else
                                                @php
                                                    $minPrice = $product->variants->min('price');
                                                    $maxPrice = $product->variants->max('price');
                                                @endphp
                                                <span class="new-price">
                                                    {{ setting('currency_symbol') . $minPrice }}
                                                    @if($minPrice != $maxPrice)
                                                        - {{ setting('currency_symbol') . $maxPrice }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        @if ($product->vendor)
                                            <div class="product-author">
                                                <span>Seller: <a href="#">{{$product->vendor->name}}</a></span>
                                            </div>
                                        @endif
                                        <div class="pro-add-to-cart-2">
                                            <button title="Add to Cart">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($categories->isNotEmpty() && setting('popular_categories_enable'))
    <div class="product-categories-area pb-60">
        <div class="container">
            <div class="section-title-6 section-title-6-xs mb-60">
                <div class="d-flex justify-content-between">
                    <h2>popular categories</h2>
                    <div class="more-product-btn text-center">
                    </div>
                </div>
                <hr>
            </div>
            <div class="product-categories-slider-3 nav-style-3">
                @foreach ($categories as $category)
                    <div class="product-plr-1">
                        <div class="single-product-wrap mb-50">
                            <div class="product-img product-img-border border-blue mb-20">
                                <a href="{{route('product.category_product',$category->slug)}}">
                                    <img class="cat-image" src="{{$category->image?asset($category->image):setting('default_category_image')}}" alt="{{$category->name}}">
                                </a>
                            </div>
                            <div class="product-content-categories-2 product-content-blue text-center">
                                <h5><a href="{{route('product.category_product',$category->slug)}}">{{$category->name}}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
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
        <div class="section-title-6 section-title-6-xs mb-60">
            <div class="d-flex justify-content-between">
                <h2>Sugguest today</h2>
                <div class="more-product-btn text-center">
                    <a href="{{route('product.index')}}">More</a>
                </div>
            </div>
            <hr>
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec px-2">
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
@if ($brands->isNotEmpty() && setting('brands_enable'))
    <div class="brand-logo-area">
        <div class="container">
             <div class="section-title-6 section-title-6-xs mb-60">
                 <div class="d-flex justify-content-between">
                     <h2>Brands</h2>
                    <div class="more-product-btn text-center">
                    </div>
                </div>
                <hr>
            </div>
            <div class="brand-slider nav-style-3">
                @foreach ($brands as $brand)
                    <div class="single-brand-logo mb-10">
                        <a href="{{route('product.brand_product',$brand->slug)}}"><img class="max-height-100 max-width-250" src="{{$brand->image?asset($brand->image):asset(setting('default_brand_image'))}}" alt="{{$brand->name}}"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif



@endsection
