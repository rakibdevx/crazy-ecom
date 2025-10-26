<footer class="footer-area">
    <div class="footer-top border-bottom-4 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-title">Quick Shop</h3>
                        <div class="footer-info-list info-list-50-parcent">
                            <ul>
                                <li><a href="shop.html">New In</a></li>
                                <li><a href="shop.html">T-Shirts</a></li>
                                <li><a href="shop.html">Best Seller</a></li>
                                <li><a href="shop.html">Shirts</a></li>
                                <li><a href="shop.html">Clothing</a></li>
                                <li><a href="shop.html">Bags</a></li>
                                <li><a href="shop.html">Men</a></li>
                                <li><a href="shop.html">Dresses</a></li>
                                <li><a href="shop.html">Women</a></li>
                                <li><a href="shop.html">Jeans</a></li>
                                <li><a href="shop.html">Baby Girl</a></li>
                                <li><a href="shop.html">Shorts</a></li>
                                <li><a href="shop.html">Baby Boys</a></li>
                                <li><a href="shop.html">Blouses & Shirts</a></li>
                                <li><a href="shop.html">Accessories</a></li>
                                <li><a href="shop.html">Blazers</a></li>
                                <li><a href="shop.html">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="footer-widget ml-70 mb-40">
                        <h3 class="footer-title">useful links</h3>
                        <div class="footer-info-list">
                            <ul>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="wishlist.html">My Wishlish</a></li>
                                <li><a href="#">Term & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Track Order</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="#">Returns/Exchange</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="footer-widget mb-40 ">
                        <h3 class="footer-title">Contact Us</h3>
                        <div class="contact-info-2">
                            <div class="single-contact-info-2">
                                <div class="contact-info-2-icon">
                                    <i class="icon-call-end"></i>
                                </div>
                                <div class="contact-info-2-content">
                                    <p>Got a question? Call</p>
                                    <h3 class="blue">{{setting('support_phone')}} </h3>
                                </div>
                            </div>
                            <div class="single-contact-info-2">
                                <div class="contact-info-2-icon">
                                    <i class="icon-cursor icons"></i>
                                </div>
                                <div class="contact-info-2-content">
                                    <p>{{setting('address')}}</p>
                                </div>
                            </div>
                            <div class="single-contact-info-2">
                                <div class="contact-info-2-icon">
                                    <i class="icon-envelope-open "></i>
                                </div>
                                <div class="contact-info-2-content">
                                    <p>{{setting('support_email')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="social-style-1 social-style-1-font-inc social-style-1-mrg-2">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pt-30 pb-30 ">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-6 col-md-6">
                    <div class="payment-img payment-img-right">
                        <a href="{{route('index')}}"><img src="{{asset(setting('site_logo'))}}" alt="{{asset('site_name')}}"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="copyright copyright-center">
                        <p>{{setting('footer_text')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
