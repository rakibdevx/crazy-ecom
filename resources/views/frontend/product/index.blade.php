@extends('frontend.layout.index')
@push('title')
    Products
@endpush
@section('body')
 <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="active">Shop </li>
                    </ul>
                </div>
            </div>
        </div>
        <form method="GET" class="filters-form">
        <div class="shop-area pt-120">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper">
                            <div class="shop-topbar-left">
                                <p>Showing 1 - 20 of 30 results </p>
                            </div>
                            <div class="product-sorting-wrapper">
                                <div class="product-shorting shorting-style">
                                    <label>View :</label>
                                    <select name="view" onchange="this.form.submit()">
                                        <option value="20" @selected(request('view') == '20')>20</option>
                                        <option value="30" @selected(request('view') == '30')>30</option>
                                        <option value="40" @selected(request('view') == '40')>40</option>
                                        <option value="50" @selected(request('view') == '50')>50</option>
                                        <option value="60" @selected(request('view') == '60')>60</option>
                                    </select>
                                </div>
                                <div class="product-show shorting-style">
                                    <label>Sort by :</label>
                                    <select name="sort" onchange="this.form.submit()">
                                        <option value="latest" @selected(request('sort') == 'latest')>Newest</option>
                                        <option value="popular" @selected(request('sort') == 'popular')>Most Popular</option>
                                        <option value="price_low_high" @selected(request('sort') == 'price_low_high')>Price Low → High</option>
                                        <option value="price_high_low" @selected(request('sort') == 'price_high_low')>Price High → Low</option>
                                        <option value="random" @selected(request('sort') == 'random')>Random</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="shop-bottom-area">
                            <div class="row">
                                @forelse ($products as $product)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-product-wrap mb-35">
                                        <div class="product-img product-img-zoom mb-15">
                                            <a href="product-details.html">
                                                @php
                                                    $image = null;
                                                        if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                                                            $image = asset($product->thumbnail);
                                                        } else {
                                                            $image = asset(setting('default_product_image'));
                                                        }
                                                @endphp
                                                <img src="{{asset($image)}}" alt="{{$product->name}}">
                                            </a>
                                            @if ($product->has_variants == 1)
                                        <span class="pro-badge left bg-red">-{{setting('currency_symbol') . ($product->old_price - $product->sale_price) }}</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <button title="Wishlist"><i class="icon-heart"></i></button>
                                            <button title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            <button title="Compare"><i class="icon-refresh"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3 class="mrg-none text-capitalize"><a href="product-details.html">{{$product->name}}</a></h3>
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
                                        <h3 class="mrg-none text-capitalize"><a class="blue" href="product-details.html">{{$product->name}}</a></h3>
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
                                            <div class="pro-add-to-cart">
                                                <button title="Add to Cart">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p>No Product Found</p>
                                @endforelse
                            </div>
                            <div class="pro-pagination-style text-center mt-10">
                                <ul>
                                    <li><a class="prev" href="#"><i class="icon-arrow-left"></i></a></li>
                                    <li><a class="active" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a class="next" href="#"><i class="icon-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-wrapper sidebar-wrapper-mrg-right">
                            <div class="sidebar-widget mb-40">
                                <h4 class="sidebar-widget-title">Search </h4>
                                <div class="sidebar-search">
                                    <form class="sidebar-search-form" action="#">
                                        <input type="text" placeholder="Search here...">
                                        <button>
                                            <i class="icon-magnifier"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Categories </h4>
                                <div class="shop-catigory">
                                    <ul>
                                        <li><a href="shop.html">T-Shirt</a></li>
                                        <li><a href="shop.html">Shoes</a></li>
                                        <li><a href="shop.html">Clothing </a></li>
                                        <li><a href="shop.html">Women </a></li>
                                        <li><a href="shop.html">Baby Boy </a></li>
                                        <li><a href="shop.html">Accessories </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Price Filter </h4>
                                <div class="price-filter">
                                    <span>Range:  $100.00 - 1.300.00 </span>
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Refine By </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox"> <a href="#">On Sale <span>4</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">New <span>5</span></a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">In Stock <span>6</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Size </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">XL <span>4</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">L <span>5</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">SM <span>6</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">XXL <span>7</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Color </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Green <span>7</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Cream <span>8</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Blue <span>9</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Black <span>3</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border pt-40">
                                <h4 class="sidebar-widget-title">Popular Tags</h4>
                                <div class="tag-wrap sidebar-widget-tag">
                                    <a href="#">Clothing</a>
                                    <a href="#">Accessories</a>
                                    <a href="#">For Men</a>
                                    <a href="#">Women</a>
                                    <a href="#">Fashion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
@endsection
