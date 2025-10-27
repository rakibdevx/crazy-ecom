<header class="header-area">
    <div class="header-large-device">
        <div class="header-top header-top-ptb-1 border-bottom-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="social-offer-wrap">
                            <div class="social-style-1">
                                @if (setting('facebook_link'))
                                    <a href="{{ setting('facebook_link') }}" target="_blank" title="Facebook">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                @endif

                                @if (setting('twitter_link'))
                                    <a href="{{ setting('twitter_link') }}" target="_blank" title="Twitter">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                @endif

                                @if (setting('instagram_link'))
                                    <a href="{{ setting('instagram_link') }}" target="_blank" title="Instagram">
                                        <i class="icon-social-instagram"></i>
                                    </a>
                                @endif

                                @if (setting('youtube_link'))
                                    <a href="{{ setting('youtube_link') }}" target="_blank" title="YouTube">
                                        <i class="icon-social-youtube"></i>
                                    </a>
                                @endif

                                @if (setting('pinterest_link'))
                                    <a href="{{ setting('pinterest_link') }}" target="_blank" title="Pinterest">
                                        <i class="icon-social-pinterest"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="header-offer-wrap-2">
                                <p><span class="mx-2"><i class="icon-envelope"></i></span>{{setting('support_email')}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="header-top-right">
                            <div class="same-style-wrap">
                                <div class="same-style same-style-mrg-2 track-order">
                                    <a href="{{route('track.order')}}">Track Orders </a>
                                </div>
                                <div class="same-style same-style-mrg-2 currency-wrap">
                                    <a class="currency-dropdown-active" href="#"> {{setting('currency')}}({{setting('currency_symbol')}})</a>
                                </div>
                                <div class="same-style same-style-mrg-2 language-wrap">
                                    <a class="language-dropdown-active text-uppercase" href="#">{{setting('default_language')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-padding-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="{{route('index')}}"><img src="{{asset(setting('site_logo'))}}" alt="{{setting('site_name')}}"></a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="categori-search-wrap categori-search-wrap-modify-3">
                            <div class="categori-style-1">
                                <select class="nice-select nice-select-style-1">
                                    <option>All Categories </option>
                                    @foreach ($menu_categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search-wrap-3">
                                <form action="#">
                                    <input placeholder="Search Products..." type="text">
                                    <button class="blue" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="hotline-2-wrap">
                            <div class="hotline-2-icon">
                                <i class="blue icon-call-end"></i>
                            </div>
                            <div class="hotline-2-content">
                                <span> Hotline</span>
                                <h5>{{setting('support_phone')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom bg-blue">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="main-categori-wrap main-categori-wrap-modify-2">
                            <a class="categori-show categori-blue" href="#">All Categories <i class="icon-arrow-down icon-right"></i></a>
                            <div class="category-menu categori-hide" style="display: none;">
                                <nav>
                                    <ul>
                                        @foreach ($menu_categories as $category)
                                            <li class="cr-dropdown">
                                                <a href="{{route('product.category_product',$category->slug)}}">{{$category->name}}
                                                    @if ($category->subcategories->count() > 0)
                                                        <span class="icon-arrow-right"></span>
                                                    @endif
                                                </a>
                                                @if ($category->subcategories->count() > 0)
                                                    <div class="category-menu-dropdown ct-menu-res-height-1">
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <div class="single-category-menu @if ($subcategory->childcategories->count() > 0) ct-menu-mrg-bottom category-menu-border @endif">
                                                                <h4>
                                                                    <a href="{{route('product.sub_category_product',$subcategory->slug)}}">
                                                                        {{$subcategory->name}}
                                                                    </a>
                                                                </h4>
                                                                <ul>
                                                                    @foreach ($subcategory->childcategories as $childcategory)
                                                                    <li><a href="{{route('product.child_category_product',$childcategory->slug)}}">{{$childcategory->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                        <div class="single-category-menu">
                                                            <a href="{{route('product.category_product',$category->slug)}}"><img src="{{$category->image?asset($category->image):setting('default_category_image')}}" alt=""></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="main-menu main-menu-white main-menu-padding-1 main-menu-font-size-14 main-menu-lh-5">
                            <nav>
                                <ul>
                                    <li><a href="{{route('index')}}">HOME </a>
                                    </li>
                                    <li><a href="{{route('product.index')}}">SHOP </a>
                                        <ul class="mega-menu-style mega-menu-mrg-2">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-title" href="#">Shop Layout</a>
                                                        <ul>
                                                            <li><a href="shop.html">standard style</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="shop.html"><img src="{{asset('/')}}frontend/images/banner/banner-12.png" alt=""></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">PAGES </a>
                                        <ul class="sub-menu-style">
                                            <li><a href="about-us.html">about us </a></li>
                                            <li><a href="cart.html">cart page</a></li>
                                            <li><a href="checkout.html">checkout </a></li>
                                            <li><a href="my-account.html">my account</a></li>
                                            <li><a href="wishlist.html">wishlist </a></li>
                                            <li><a href="compare.html">compare </a></li>
                                            <li><a href="contact.html">contact us </a></li>
                                            <li><a href="order-tracking.html">order tracking</a></li>
                                            <li><a href="login-register.html">login / register </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog.html">BLOG </a></li>
                                    <li><a href="contact.html">CONTACT </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="header-action header-action-flex pr-20">
                            <div class="same-style-2 same-style-2-white same-style-2-font-dec">
                                <a href="login-register.html"><i class="icon-user"></i></a>
                            </div>
                            <div class="same-style-2 same-style-2-white same-style-2-font-dec">
                                <a href="wishlist.html"><i class="icon-heart"></i><span class="pro-count red">03</span></a>
                            </div>
                            <div class="same-style-2 same-style-2-white same-style-2-font-dec header-cart">
                                <a class="cart-active" href="#">
                                    <i class="icon-basket-loaded"></i><span class="pro-count red">02</span>
                                    <span class="cart-amount white">$2,435.30</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-small-device small-device-ptb-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="mobile-logo">
                        <a href="{{route('index')}}">
                            <img alt="" src="{{asset('/')}}frontend/images/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="header-action header-action-flex">
                        <div class="same-style-2 same-style-2-font-inc">
                            <a href="login-register.html"><i class="icon-user"></i></a>
                        </div>
                        <div class="same-style-2 same-style-2-font-inc">
                            <a href="wishlist.html"><i class="icon-heart"></i><span class="pro-count red">03</span></a>
                        </div>
                        <div class="same-style-2 same-style-2-font-inc header-cart">
                            <a class="cart-active" href="#">
                                <i class="icon-basket-loaded"></i><span class="pro-count red">02</span>
                            </a>
                        </div>
                        <div class="same-style-2 main-menu-icon">
                            <a class="mobile-header-button-active" href="#"><i class="icon-menu"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="clickalbe-sidebar-wrap">
        <a class="sidebar-close"><i class="icon_close"></i></a>
        <div class="mobile-header-content-area">
            <div class="mobile-search mobile-header-padding-border-1">
                <form class="search-form" action="#">
                    <input type="text" placeholder="Search here…">
                    <button class="button-search"><i class="icon-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-padding-border-2">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="menu-item-has-children "><a href="{{route('product.index')}}">shop</a>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="about-us.html">about us </a></li>
                                <li><a href="cart.html">cart page</a></li>
                                <li><a href="checkout.html">checkout </a></li>
                                <li><a href="my-account.html">my account</a></li>
                                <li><a href="wishlist.html">wishlist </a></li>
                                <li><a href="compare.html">compare </a></li>
                                <li><a href="contact.html">contact us </a></li>
                                <li><a href="order-tracking.html">order tracking</a></li>
                                <li><a href="login-register.html">login / register </a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">BLog</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="main-categori-wrap mobile-menu-wrap mobile-header-padding-border-3">
                <a class="categori-show blue" href="#">
                    <i class="lnr lnr-menu"></i> All Department <i class="icon-arrow-down icon-right"></i>
                </a>
                <div class="categori-hide-2">
                    <nav>
                        <ul class="mobile-menu">
                            @foreach ($menu_categories as $category)
                                <li class="menu-item-has-children "><a href="{{route('product.category_product',$category->slug)}}">{{$category->name}}</a>
                            <ul class="dropdown">
                                @foreach ($category->subcategories as $subcategory)
                                <li><a href="{{route('product.sub_category_product',$subcategory->slug)}}">{{$subcategory->name}} </a></li>
                                @endforeach
                            </ul>
                        </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="mobile-header-info-wrap mobile-header-padding-border-3">
                <div class="single-mobile-header-info">
                    <a href="{{route('track.order')}}"><i class="lastudioicon-pin-3-2"></i>Track Orders </a>
                </div>
            </div>
            <div class="mobile-contact-info mobile-header-padding-border-4">
                <ul>
                    <li><i class="icon-phone "></i> {{setting('support_phone')}}</li>
                    <li><i class="icon-envelope-open "></i>{{setting('support_email')}}</li>
                    <li><i class="icon-home"></i> {{setting('address')}}</li>
                </ul>
            </div>
            <div class="mobile-social-icon">
                @if (setting('facebook_link'))
                    <a class="facebook" href="{{setting('facebook_link')}}"><i class="icon-social-facebook"></i></a>
                @endif

                @if (setting('twitter_link'))
                    <a class="twitter" href="{{setting('twitter_link')}}"><i class="icon-social-twitter"></i></a>
                @endif

                @if (setting('instagram_link'))
                    <a class="instagram" href="{{setting('instagram_link')}}"><i class="icon-social-instagram"></i></a>
                @endif

                @if (setting('youtube_link'))
                    <a class="instagram" href="{{setting('youtube_link')}}"><i class="icon-social-youtube"></i></a>
                @endif

                @if (setting('pinterest_link'))
                    <a class="pinterest" href="{{setting('pinterest_link')}}"><i class="icon-social-pinterest"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
