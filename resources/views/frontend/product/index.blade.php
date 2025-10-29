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
                        <li><a href="{{ route('product.index') }}">Shop</a></li>
                        @isset($datatype)
                            <li class="active">{{$datatype}}</li>
                        @endisset
                        @if(isset($category))
                            <li class="active">{{ $category->name }}</li>
                        @elseif(isset($subcategory))
                            @if($subcategory->category)
                                <li>
                                    <a href="{{ route('product.category_product', $subcategory->category->slug) }}">
                                        {{ $subcategory->category->name }}
                                    </a>
                                </li>
                            @endif
                            <li class="active">{{ $subcategory->name }}</li>

                        @elseif(isset($childCategory))
                            @if($childCategory->category)
                                <li>
                                    <a href="{{ route('product.category_product', $childCategory->category->slug) }}">
                                        {{ $childCategory->category->name }}
                                    </a>
                                </li>
                            @endif

                            @if($childCategory->subcategory)
                                <li>
                                    <a href="{{ route('product.sub_category_product', $childCategory->subcategory->slug) }}">
                                        {{ $childCategory->subcategory->name }}
                                    </a>
                                </li>
                            @endif

                            <li class="active">{{ $childCategory->name }}</li>

                        @elseif(isset($brand))
                            <li class="active">{{ $brand->name }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <form action="" id="filter_from" method="get">
        <div class="shop-area pt-120">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-10">
                        <div class="shop-topbar-wrapper">
                            <div class="shop-topbar-left">
                                @if ($products->count() > 0)
                                    <p>
                                        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results
                                    </p>
                                @endif
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
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="single-product-wrap mb-35">
                                        <div class="product-img product-img-zoom mb-15">
                                            <a href="{{route('product.details',$product->slug)}}">
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
                    <div class="col-lg-2">
                        <div class="sidebar-wrapper sidebar-wrapper-mrg-right">
                           <div class="sidebar-widget shop-sidebar-border mb-35">
                                <h4 class="sidebar-widget-title">Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="category-list">
                                        @foreach ($categories as $index => $category)
                                            <li class="{{ $index >= 7 ? 'extra-category hidden' : '' }}">
                                                <a href="{{ route('product.category_product', $category->slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($categories) > 10)
                                        <div class="btn-style-2">
                                            <a id="view-more-categories" class="btn btn-link ps-0">View More</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                           <div class="sidebar-widget shop-sidebar-border mb-35">
                                <h4 class="sidebar-widget-title">Brands</h4>
                                <div class="shop-catigory">
                                    <ul id="category-list">
                                        @foreach ($brands as $index => $brand)
                                            <li class="{{ $index >= 7 ? 'extra-brands hidden' : '' }}">
                                                <a href="{{ route('product.brand_product', $brand->slug) }}">
                                                    {{ $brand->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($brands) > 10)
                                        <div class="btn-style-2">
                                            <a id="view-more-brands" class="btn btn-link ps-0">View More</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Price Filter </h4>
                                <div class="price-filter">
                                    <span>Range:  {{setting('currency_symbol')}}{{$minPriceFilter}} - {{setting('currency_symbol')}}{{$maxPriceFilter}} </span>
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <input type="text" id="amount" placeholder="" />
                                            <input type="hidden" id="max_price" name="max_price" placeholder="" />
                                            <input type="hidden" id="min_price" name="min_price" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(function() {
            var sliderrange = $('#slider-range');
            var amountprice = $('#amount');
            var minInput = $('#min_price');
            var maxInput = $('#max_price');
            var form = $('#filter_from');

            sliderrange.slider({
                range: true,
                min: {{ $minPriceFilter }},
                max: {{ $maxPriceFilter }},
                values: [
                    {{ request('min_price', $minPriceFilter) }},
                    {{ request('max_price', $maxPriceFilter) }}
                ],
                slide: function(event, ui) {
                    amountprice.val("{{ setting('currency_symbol') }}" + ui.values[0] +
                                    " - {{ setting('currency_symbol') }}" + ui.values[1]);
                },
                change: function(event, ui) {
                    minInput.val(ui.values[0]);
                    maxInput.val(ui.values[1]);
                    form.submit();
                }
            });

            // initial display
            amountprice.val("{{ setting('currency_symbol') }}" + sliderrange.slider("values", 0) +
                            " - {{ setting('currency_symbol') }}" + sliderrange.slider("values", 1));
        });

    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('view-more-categories');
        if(btn) {
            btn.addEventListener('click', function() {
                const extra = document.querySelectorAll('.extra-category');
                extra.forEach(li => li.classList.toggle('hidden'));
                btn.textContent = btn.textContent === 'View More' ? 'View Less' : 'View More';
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('view-more-brands');
        if(btn) {
            btn.addEventListener('click', function() {
                const extra = document.querySelectorAll('.extra-brands');
                extra.forEach(li => li.classList.toggle('hidden'));
                btn.textContent = btn.textContent === 'View More' ? 'View Less' : 'View More';
            });
        }
    });
    </script>
@endpush



