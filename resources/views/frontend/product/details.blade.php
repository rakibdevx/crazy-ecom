@extends('frontend.layout.index')
@push('title')
    {{$product->name}}
@endpush
@section('meta_title', $product->meta_title)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)


@section('body')
<div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('product.index')}}">Products</a>
                        </li>
                        <li class="active text-capitalize">{{$product->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-details-area pt-120 pb-115">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-tab">
                            <div class="product-dec-right pro-dec-big-img-slider">
                                 @php
                                    $image = null;
                                        if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                                            $image = asset($product->thumbnail);
                                        } else {
                                            $image = asset(setting('default_product_image'));
                                        }
                                @endphp
                                <div class="easyzoom-style">
                                    <div class="easyzoom easyzoom--overlay">
                                        <a href="{{$image}}">
                                            <img src="{{$image}}" alt="">
                                        </a>
                                    </div>
                                    <a class="easyzoom-pop-up img-popup" href="{{$image}}"><i class="icon-size-fullscreen"></i></a>
                                </div>
                                @foreach ($product->gallery as $gallery)

                                    <div class="easyzoom-style">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="{{asset($gallery->url)}}">
                                                <img src="{{asset($gallery->url)}}" alt="">
                                            </a>
                                        </div>
                                        <a class="easyzoom-pop-up img-popup" href="{{asset($gallery->url)}}"><i class="icon-size-fullscreen"></i></a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-dec-left product-dec-slider-small-2 product-dec-small-style2">
                                <div class="product-dec-small active">
                                    <img src="{{$image}}" alt="">
                                </div>
                                @foreach ($product->gallery as $gallery)
                                <div class="product-dec-small active">
                                    <img src="{{asset($gallery->url)}}" alt="">
                                </div>
                                 @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-content pro-details-content-mt-md">
                            <h2 class="text-capitalize">{{$product->name}}</h2>
                            <div class="product-ratting-review-wrap">
                                <div class="product-ratting-digit-wrap">
                                    <div class="product-ratting">
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
                                    <div class="product-digit">
                                        <span>5.0</span>
                                    </div>
                                </div>
                                <div class="product-review-order">
                                    <span>({{$product->totalRatings()}}) Reviews</span>
                                    <span>({{$product->sold_count}}) orders</span>
                                </div>
                            </div>
                            <p>{{$product->short_description}}</p>
                            @if ($product->has_variants == 1)
                                @php
                                    $firstVariant = $product->variants->first();
                                @endphp

                                @if ($firstVariant)
                                    <div class="pro-details-price">
                                        <span class="new-price variant_price">{{ $firstVariant->price }}</span>
                                        <span class="old-price variant_old_price">{{ $firstVariant->old_price }}</span>
                                    </div>
                                @endif
                            @else
                                <div class="pro-details-price">
                                    <span class="new-price">{{$product->sale_price}}</span>
                                    @if ($product->old_price)
                                        <span class="old-price">{{$product->old_price}}</span>
                                    @endif
                                </div>
                            @endif
                            @if ($product->has_variants == 1)
                                @if ($product->variants && $product->variants->count() > 0)
                                    @php
                                        $firstColor = $product->variants->groupBy('color_id')->first()->first();
                                    @endphp
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul class="product-colors">
                                                @foreach($product->variants->groupBy('color_id') as $colorVariants)
                                                    <li>
                                                        <a href="#"
                                                        class="color-item {{ $loop->first ? 'active' : '' }}"
                                                        data-color-id="{{ $colorVariants->first()->color->id }}"
                                                        style="background-color: {{ $colorVariants->first()->color->code }}">
                                                            {{ $colorVariants->first()->color->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="selected_color" name="selected_color" value="{{ $firstColor->color->id }}">
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if ($product->productColors && $product->productColors->count() > 0)
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul class="product-colors">
                                                    @foreach($product->productColors as $color)
                                                        <li>
                                                            <a href="#"
                                                            class="color-item  @if ($loop->first) active @endif"
                                                            style="background-color: {{ $color->color->code }};"
                                                            data-color-id="{{ $color->color->id }}">
                                                            {{ $color->color->name }}

                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            <input type="hidden" id="selected_color" name="selected_color" value="{{$product->productColors[0]->color->id}}">
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if ($product->has_variants == 1)
                                @if ($product->variants && $product->variants->count() > 0)
                                    @php
                                        $groupedSizes = $product->variants->groupBy('size_id');
                                        $firstSize = $groupedSizes->first()->first();
                                    @endphp
                                    <div class="pro-details-size">
                                        <span>Size:</span>
                                        <div class="pro-details-size-content">
                                            <ul>
                                                @foreach($groupedSizes as $sizeId => $sizeVariants)
                                                    @php
                                                        $sizeItem = $sizeVariants->first()->size;
                                                    @endphp
                                                    <li>
                                                        <a href="#"
                                                        class="size-item {{ $loop->first ? 'active' : '' }}"
                                                        data-size-id="{{ $sizeItem->id }}">
                                                            {{ $sizeItem->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="selectedSize" name="size_id" value="{{ $firstSize->size->id }}">
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if ($product->productSizes && $product->productSizes->count() > 0)
                                <div class="pro-details-size">
                                    <span>Size:</span>
                                    <div class="pro-details-size-content">
                                        <ul>
                                            @foreach($product->productSizes as $size)
                                                <li>
                                                    <a href="#"
                                                    class="size-item  @if ($loop->first) active @endif"
                                                    data-size-id="{{ $size->size->id }}">
                                                    {{ $size->size->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" id="selectedSize" name="size_id" value="{{$product->productSizes[0]->size->id}}">
                                    </div>
                                </div>
                            @endif
                            <div class="pro-details-quality">
                                <span>Quantity:</span>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box qty-input" type="text" name="qtybutton" value="1">
                                </div>
                                <input type="hidden" id="product_id" value="{{ $product->id }}">

                            </div>
                            <div class="product-details-meta">
                                <ul>
                                    @if ($product->category)
                                        <li><span>Categories:</span> <a href="{{route('product.category_product',$product->category->slug)}}">{{$product->category->name}}</a></li>
                                    @endif
                                    @php
                                        $tags = json_decode($product->tags, true);
                                    @endphp

                                    @if(!empty($tags) && is_array($tags))
                                        <li>
                                            <span>Tag: </span>
                                            @foreach($tags as $key => $tag)
                                                <a href="{{ route('product.index', ['tag' => $tag]) }}">{{ $tag }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="pro-details-action-wrap">
                                <div class="pro-details-add-to-cart">
                                    @if ($product->has_variants == 1)
                                        @php
                                            $variant = $product->variants
                                                        ->where('color_id', $firstColor->color_id)
                                                        ->where('size_id', $firstSize->size_id)
                                                        ->first();
                                            $isOutOfStock = !$variant || $variant->stock_quantity == 0;
                                        @endphp

                                        <a class="btn {{ $isOutOfStock ? 'btn-secondary disabled' : 'btn-primary' }}" id="addToCartBtn"
                                        href="#"
                                        {{ $isOutOfStock ? 'tabindex=-1 aria-disabled=true' : '' }}>
                                            {{ $isOutOfStock ? 'Out of Stock' : 'Add To Cart' }}
                                        </a>

                                    @else
                                        @php
                                            $isOutOfStock = $product->stock_quantity == 0;
                                        @endphp

                                        <a class="btn {{ $isOutOfStock ? 'btn-secondary disabled' : 'btn-primary' }}" id="addToCartBtn"
                                        href="#"
                                        {{ $isOutOfStock ? 'tabindex=-1 aria-disabled=true' : '' }}>
                                            {{ $isOutOfStock ? 'Out of Stock' : 'Add To Cart' }}
                                        </a>
                                    @endif


                                </div>
                                <div class="pro-details-action">
                                    <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                                    <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                                    <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                    <div class="product-dec-social">
                                        @php
                                            $url = urlencode(request()->fullUrl());
                                            $title = urlencode($product->name);
                                        @endphp
                                        <!-- Facebook -->
                                        <a class="facebook" title="Facebook" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}">
                                            <i class="icon-social-facebook"></i>
                                        </a>

                                        <!-- Twitter -->
                                        <a class="twitter" title="Twitter" target="_blank"
                                            href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}">
                                            <i class="icon-social-twitter"></i>
                                        </a>

                                        <!-- Pinterest -->
                                        <a class="pinterest" title="Pinterest" target="_blank"
                                            href="https://pinterest.com/pin/create/button/?url={{ $url }}&description={{ $title }}">
                                            <i class="icon-social-pinterest"></i>
                                        </a>

                                        <!-- LinkedIn (optional) -->
                                        <a class="linkedin" title="LinkedIn" target="_blank"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&title={{ $title }}">
                                            <i class="icon-social-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="description-review-wrapper pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dec-review-topbar nav mb-45">
                            <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                            <a data-bs-toggle="tab" href="#des-details2">Specification</a>
                            <a data-bs-toggle="tab" href="#des-details4">Reviews and Ratting </a>
                        </div>
                        <div class="tab-content dec-review-bottom">
                            <div id="des-details1" class="tab-pane active">
                                <div class="description-wrap">
                                    {!!$product->description!!}
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">
                                <div class="specification-wrap table-responsive">
                                    <table>
                                        <tbody>
                                            @if(!empty($product->name))
                                                <tr>
                                                    <td class="title width1">Name</td>
                                                    <td class="text-capitalize">{{ $product->name }}</td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->sku))
                                                <tr>
                                                    <td class="title width1">SKU</td>
                                                    <td>{{ $product->sku }}</td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->barcode))
                                                <tr>
                                                    <td class="title width1">Barcode</td>
                                                    <td>{{ $product->barcode }}</td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->category))
                                                <tr>
                                                    <td class="title width1">Category</td>
                                                    <td>
                                                        <a href="{{ route('product.category_product',$product->category->slug) }}">{{ $product->category->name }}</a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->subcategory))
                                                <tr>
                                                    <td class="title width1">Subcategory</td>
                                                    <td>
                                                        <a href="{{ route('product.sub_category_product',$product->subcategory->slug) }}">{{ $product->subcategory->name }}</a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->childCategory))
                                                <tr>
                                                    <td class="title width1">Child Category</td>
                                                    <td>
                                                        <a href="{{ route('product.child_category_product',$product->childCategory->slug) }}">{{ $product->childCategory->name }}</a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->brand))
                                                <tr>
                                                    <td class="title width1">Brand</td>
                                                    <td>
                                                        <a href="{{ route('product.brand_product',$product->brand->slug) }}">{{ $product->brand->name }}</a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if(!empty($product->height_cm ||$product->width_cm ||$product->length_cm))
                                                <tr>
                                                    <td class="title width1">Size</td>
                                                    <td>
                                                        {{$product->height_cm}} cm x
                                                        {{$product->width_cm}} cm x
                                                        {{$product->length_cm}} cm
                                                    </td>
                                                </tr>
                                            @endif
                                            @if(!empty($product->weight_kg))
                                                <tr>
                                                    <td class="title width1">Size</td>
                                                    <td>
                                                        {{$product->weight_kg}} kg
                                                    </td>
                                                </tr>
                                            @endif
                                            @if(!empty($product->color))
                                                <tr>
                                                    <td class="title width1">Color</td>
                                                    <td>{{ $product->color }}</td>
                                                </tr>
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div id="des-details4" class="tab-pane">
                               <div class="blog-comment-wrapper mt-55">
                                <h4 class="blog-dec-title">comments : 02</h4>
                                <div class="single-comment-wrapper mt-35">
                                    <div class="blog-comment-img">
                                        <img src="{{asset('/')}}frontend/images/product-details/client-1.png" alt="">
                                    </div>
                                    <div class="blog-comment-content">
                                        <div class="d-flex">
                                            <div class="div">
                                                <h4>Anthony Stephens</h4>
                                                <span>October 14, 2022 </span>
                                            </div>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam, </p>
                                        <div class="blog-details-btn">
                                            <a href="blog-details.html">read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment-wrapper mt-50 ml-120">
                                    <div class="blog-comment-img">
                                        <img src="{{asset('/')}}frontend/images/product-details/client-1.png" alt="">
                                    </div>
                                    <div class="blog-comment-content">
                                        <h4>DX Joxova</h4>
                                        <span>October 14, 2022 </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam, </p>
                                        <div class="blog-details-btn">
                                            <a href="blog-details.html">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="ratting-form-wrapper">
                                    <span>Add a Review</span>
                                    <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Name <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Email <span>*</span></label>
                                                        <input type="email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="star-box-wrap">
                                                        <div class="single-ratting-star">
                                                            <a href="#"><i class="icon_star"></i></a>
                                                        </div>
                                                        <div class="single-ratting-star">
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                        </div>
                                                        <div class="single-ratting-star">
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                        </div>
                                                        <div class="single-ratting-star">
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                        </div>
                                                        <div class="single-ratting-star">
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                            <a href="#"><i class="icon_star"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Your review <span>*</span></label>
                                                        <textarea name="Your Review"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-product pb-115">
            <div class="container">
                <div class="section-title mb-45 text-center">
                    <h2>Related Product</h2>
                </div>
                <div class="related-product-active">
                    @foreach ($relatedProducts as $product)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('product.details',$product->slug)}}">
                                             @php
                                                $image = null;
                                                    if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                                                        $image = asset($product->thumbnail);
                                                    } else {
                                                        $image = asset(setting('default_product_image'));
                                                    }
                                            @endphp
                                            <img src="{{$image}}" alt="">
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
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.size-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.size-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('selectedSize').value = this.dataset.sizeId;

            var $input = $('.qty-input');
            const productId = $('#product_id').val();
            const productColor = $('#selected_color');;

            updateQuantityAndCheckStock($input, productId,productColor.val(),this.dataset.sizeId, 0);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const colorItems = document.querySelectorAll('.color-item');
        const colorInput = document.getElementById('selected_color');

        colorItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const colorCode = this.getAttribute('data-color-id');
                colorInput.value = colorCode;

                var $input = $('.qty-input');
                const productId = $('#product_id').val();
                const productSize = $('#selectedSize');

                updateQuantityAndCheckStock($input, productId, colorCode, productSize.val(), 0);

            });
        });
    });

    // Stock
    async function updateQuantityAndCheckStock($input, productId, color = null, size = null, increment = 0) {
        let oldValue = parseFloat($input.val()) || 1;
        let newVal = oldValue + increment;
        if (newVal < 1) newVal = 1;
        $input.val(newVal).attr('value', newVal);
        try {
            const res = await fetch(`{{ route('checkStock') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newVal,
                    color: color,
                    size: size
                })
            });
            const data = await res.json();
            $('.variant_price').html(data.price);
            let $btn = $('#addToCartBtn');
            if(data.old_price) {
                $('.variant_old_price').html(data.old_price).show();
            } else {
                $('.variant_old_price').hide();
            }
            if(data.max_stock == 0){
                $btn.removeClass('btn-primary').addClass('btn-secondary disabled')
                    .attr('tabindex','-1')
                    .attr('aria-disabled','true')
                    .text('Out of Stock');
            } else if(data.max_stock > 0){
                $btn.removeClass('btn-secondary disabled').addClass('btn-primary')
                    .removeAttr('tabindex')
                    .removeAttr('aria-disabled')
                    .text('Add To Cart');
            }

            if (!data.available) {
                Swal.fire(
                    'Alert!',
                    `${data.message}`,
                    'error'
                );
                $input.val(data.max_stock).attr('value', data.max_stock);
            }
        } catch (err) {
            console.error('Stock check error:', err);
        }
    }

    $(document).ready(function() {
        var CartPlusMinus = $('.cart-plus-minus');
        CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
        CartPlusMinus.append('<div class="inc qtybutton">+</div>');

        const productId = $('#product_id').val();
        const productColor = $('#selected_color');
        const productSize = $('#selectedSize');

        $(document).on('click', '.qtybutton', function() {
            var $input = $(this).closest('.cart-plus-minus').find('input');
            var increment = $(this).hasClass('inc') ? 1 : -1;
            updateQuantityAndCheckStock($input, productId, productColor.val(), productSize.val(), increment);
        });

        $(document).on('input', 'input.qty-input', function() {
            var $input = $(this);
            updateQuantityAndCheckStock($input, productId, productColor.val(), productSize.val(), 0);
        });

    });


</script>
@endpush
