<div class="slider-area bg-gray-8">
    <div class="container">
        <div class="hero-slider-active-2 nav-style-1 nav-style-1-modify-2 nav-style-1-blue">
            @foreach ($sliders as $slider)
                <div class="single-hero-slider single-hero-slider-hm9 single-animation-wrap">
                    <div class="row slider-animated-1">
                        <div class="col-lg-5 col-md-5 col-12 col-sm-6">
                            <div class="hero-slider-content-6 slider-content-hm9">
                                <h5 class="animated">{{$slider->title}}</h5>
                                <h1 class="animated">{{$slider->subtitle}}</h1>
                                <p class="animated">{{$slider->details}}</p>
                                <div class="btn-style-1">
                                    <a class="animated btn-1-padding-4 btn-1-blue btn-1-font-14" href="{{$slider->link}}">{{$slider->button_text}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12 col-sm-6">
                            <div class="hm9-hero-slider-img">
                                <img class="animated" src="{{asset($slider->image??setting('default_slider_image'))}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
