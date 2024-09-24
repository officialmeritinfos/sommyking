@extends('home.base')
@section('content')


    <!-- Slider Three -->
    <section class="slider-three">
        <div class="single-item-carousel owl-carousel owl-theme">

            <!-- Slide -->
            <div class="slide">
                <div class="slider-three_image-layer" style="background-image:url({{asset('home/images/main-slider/4.jpg')}})"></div>
                <div class="auto-container">

                    <!-- Content Column -->
                    <div class="slider-three-content">
                        <div class="slider-three_inner">
                            <div class="slider-three_icon">
                                <img src="{{asset('home/images/main-slider/logo-icon.png')}}" alt="" />
                            </div>
                            <h1 class="slider-three_heading">We help investors solve <br> complex financial problems.</h1>
                            <div class="slider-three_text">
                                With our integration of a Robust AI model, we are able to solve complex financial needs
                                of our users in minutes.
                            </div>
                            <!-- Button Box -->
                            <div class="slider-three_button-box">
                                <a class="btn-style-seven theme-btn btn-item" href="{{route('register')}}">
                                    <div class="btn-wrap">
                                        <span class="text-one">Join us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                        <span class="text-two">Join us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Slide -->
            <div class="slide">
                <div class="slider-three_image-layer" style="background-image:url({{asset('home/images/main-slider/6.jpg')}})"></div>
                <div class="auto-container">

                    <!-- Content Column -->
                    <div class="slider-three-content">
                        <div class="slider-three_inner">
                            <div class="slider-three_icon"><img src="{{asset('home/images/main-slider/logo-icon.png')}}" alt="" /></div>
                            <h1 class="slider-three_heading">Grow your Finance <br> and prepare for Retirement</h1>
                            <div class="slider-three_text">
                                Retire in grand style with our Retirement plans crafted just for you to help you
                                grow your wealth portfolio.
                            </div>
                            <!-- Button Box -->
                            <div class="slider-three_button-box">
                                <a class="btn-style-seven theme-btn btn-item" href="{{route('register')}}">
                                    <div class="btn-wrap">
                                        <span class="text-one">Join us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                        <span class="text-two">Join us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Slide -->
            <div class="slide">
                <div class="slider-three_image-layer" style="background-image:url({{asset('home/images/main-slider/mining.jpeg')}})"></div>
                <div class="auto-container">

                    <!-- Content Column -->
                    <div class="slider-three-content">
                        <div class="slider-three_inner">
                            <div class="slider-three_icon"><img src="{{asset('home/images/main-slider/logo-icon.png')}}" alt="" /></div>
                            <h1 class="slider-three_heading">Becoming a mining <br> powerhouse</h1>
                            <div class="slider-three_text">
                                {{$siteName}} engages in heavy-task mining process and airlifts the challenges for our
                                Clients using our Grade-one AI powered mining house.
                            </div>
                            <!-- Button Box -->
                            <div class="slider-three_button-box">
                                <a class="btn-style-seven theme-btn btn-item" href="contact">
                                    <div class="btn-wrap">
                                        <span class="text-one">Contact us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                        <span class="text-two">Contact us <i class="fa-solid fa-caret-right fa-fw"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- End Main Slider -->

    <!-- Feature Three -->
    <section class="feature-three">
        <div class="feature-three_circle-layer" style="background-image:url({{asset('home/images/background/pattern-8.png')}})"></div>
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Feature Block Three -->
                <div class="feature-block_three col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-block_three-inner">
                        <div class="feature-block_three-content">
                            <div class="feature-block_three-icon"><img src="{{asset('home/images/icons/feature-5.png')}}" alt="" /></div>
                            <h5 class="feature-block_three-heading"><a href="#">Best Financial Analysis</a></h5>
                            <div class="feature-block_three-text">
                                We are a business inclined profitable investment company with all the right tools and
                                experts to help you grow your investment.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Block Three -->
                <div class="feature-block_three col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-block_three-inner">
                        <div class="feature-block_three-content">
                            <div class="feature-block_three-icon"><img src="{{asset('home/images/icons/feature-6.png')}}" alt="" /></div>
                            <h5 class="feature-block_three-heading"><a href="#">Creative & Ideal Planning</a></h5>
                            <div class="feature-block_three-text">
                                Our team works hand in hand with our Super AI model to bring up innovative solutions
                                for our clients.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Block Three -->
                <div class="feature-block_three col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-block_three-inner">
                        <div class="feature-block_three-content">
                            <div class="feature-block_three-icon"><img src="{{asset('home/images/icons/feature-7.png')}}" alt="" /></div>
                            <h5 class="feature-block_three-heading">
                                <a href="#">
                                    Financial Trust
                                </a>
                            </h5>
                            <div class="feature-block_three-text">
                                We protect our investors' funds with reputable institutions and this is an insurance
                                against the market fluctuations.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Block Three -->
                <div class="feature-block_three col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-block_three-inner">
                        <div class="feature-block_three-content">
                            <div class="feature-block_three-icon"><img src="{{asset('home/images/icons/feature-8.png')}}" alt="" /></div>
                            <h5 class="feature-block_three-heading"><a href="#">Timely Returns</a></h5>
                            <div class="feature-block_three-text">
                                Our GPT-4 model makes it possible for our investors to get credited on time and without
                                delays.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Feature Three -->

    <!-- About Two -->
    <section class="about-two">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Image Column -->
                <div class="about-two_image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="about-two_image-inner">
                        <div class="about-two_image">
                            <!-- Counter Column -->
                            <div class="about-two_counter-block" data-parallax='{"y" : 50}'>
                                <div class="dots-layer" style="background-image:url({{asset('home/images/icons/about-dots.png')}})"></div>
                                <div class="about-two_counter-number"><span class="odometer" data-count="13"></span></div>
                                <div class="about-two_counter-text">years of <br> experiences</div>
                            </div>
                            <img src="{{asset('home/images/resource/about-1.jpg')}}" alt="" />
                            <div class="about-two_award">
                                <div class="about-two_award-inner">
                                    <div class="about-two_award-icon">
                                        <img src="{{asset('home/images/icons/award.png')}}" alt="" />
                                    </div>
                                    <strong>Best Awarded Company</strong>
                                    We are a business inclined profitable investment company with all the right tools
                                    and experts to help you grow your investment.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="about-two_content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="about-two_content-inner">
                        <!-- Sec Title -->
                        <div class="sec-title style-two">
                            <div class="sec-title_title">About us</div>
                            <h2 class="sec-title_heading">We are dedicated to give <br> you the Best.</h2>
                            <div class="sec-title_text">
                                With {{$siteName}}, harness the potential of
                                artificial intelligence to elevate your cryptocurrency
                                investments, mining operations, and trading
                                endeavors to new
                                heights. Experience x10 of revenue earning in hours.
                            </div>
                        </div>

                        <div class="row clearfix">

                            <!-- About Two Block -->
                            <div class="about-two-block col-lg-6 col-md-6 col-sm-12">
                                <div class="about-two-block_inner">
                                    <span class="about-two_block-icon flaticon-user"></span>
                                    <h5 class="about-two_block-heading">Expert Team</h5>
                                    <div class="about-two_block-text">
                                        With over 50+ ingenious experts and the power of a Super-model AI.
                                    </div>
                                </div>
                            </div>

                            <!-- About Two Block -->
                            <div class="about-two-block col-lg-6 col-md-6 col-sm-12">
                                <div class="about-two-block_inner">
                                    <span class="about-two_block-icon flaticon-profit"></span>
                                    <h5 class="about-two_block-heading">Target fulfill</h5>
                                    <div class="about-two_block-text">
                                        Our track record bears us witness that we have always kept to our words.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End About Two -->

    <!-- Case One -->
    <section class="case-one">
        <div class="case-one_pattern-layer" style="background-image:url({{asset('home/images/background/pattern-12.png')}})"></div>
        <div class="case-one_pattern-layer-two" style="background-image:url({{asset('home/images/background/pattern-9.png')}})"></div>
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title style-two light centered">
                <div class="sec-title_title">Case Studies</div>
                <h2 class="sec-title_heading">Some of our awesome services to <br> check our quality.</h2>
            </div>

            <div class="row clearfix">
            @foreach($services as $service)
                <!-- Case Block One -->
                    <div class="case-block_one col-lg-3 col-md-6 col-sm-12">
                        <div class="case-block_one-inner">
                            <div class="case-block_one-image">
                                <img src="{{asset('home/images/service/'.$service->photo2)}}" alt="" />
                                <div class="case-block_one-content">
                                    <a class="case-block_one-plus fa-solid fa-plus fa-fw" href="#"></a>
                                    <div class="case-block_one-title">{{$service->title}}</div>
                                    <h5 class="case-block_one-heading">
                                        <a href="{{route('service_detail',['id'=>$service->id])}}">
                                            {{$service->title}}
                                        </a>
                                    </h5>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- End Case One -->

    <!-- Services One -->
    <section class="services-one style-two">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title style-two centered">
                <div class="sec-title_title">Who Choose Us</div>
                <h2 class="sec-title_heading">We are dedicated to serve <br> you all time.</h2>
            </div>
            <div class="row clearfix">

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-website"></div>
                        <h5 class="service-block_one-heading">Strategy & Planning</h5>
                        <div class="service-block_one-text">
                            At {{$siteName}}, we strategize for every investment opportunity presented to our users.
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-website"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Strategy & Planning</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    At {{$siteName}}, we strategize for every investment opportunity presented to our users.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-market"></div>
                        <h5 class="service-block_one-heading">Program management</h5>
                        <div class="service-block_one-text">
                            Each user is given a dedicated account manager to help guide them in their
                            portfolio growth.
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-market"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Program management</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    Each user is given a dedicated account manager to help guide them in their
                                    portfolio growth.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-bank-building-silhouette"></div>
                        <h5 class="service-block_one-heading">Automated Returns</h5>
                        <div class="service-block_one-text">
                            Follow through with your investment as it counts and watch your earning grow by the day.
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-bank-building-silhouette"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Automated Returns</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    Follow through with your investment as it counts and watch your earning grow by the day.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-charity"></div>
                        <h5 class="service-block_one-heading">Investment Policy</h5>
                        <div class="service-block_one-text">
                            At {{$siteName}} is where AI meets Human kmowledge for efficient policies that provide for
                            the best result.
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-charity"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Investment Policy</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    At {{$siteName}} is where AI meets Human kmowledge for efficient policies that provide for
                                    the best result.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-business-intelligence"></div>
                        <h5 class="service-block_one-heading">Financial Advices</h5>
                        <div class="service-block_one-text">
                            We engage our clients on their financial need and guide them properly to it.
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-business-intelligence"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Financial Advices</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    We engage our clients on their financial need and guide them properly to it.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Block One / Style Two -->
                <div class="service-block_one style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner">
                        <div class="service-block_one-icon flaticon-shuttle"></div>
                        <h5 class="service-block_one-heading">Zero risk  Plan</h5>
                        <div class="service-block_one-text">
                            Because we are using a super-model, our market analysis are always 99% accurate, and 1% due to
                            human error. However, over the years, we have come to diversify and that has cut down the risk
                            ratio to zero(0)
                        </div>
                        <div class="service-block_one-overlay" style="background-image:url({{asset('home/images/resource/service.jpg')}})">
                            <div class="service-block_one-overlay-inner">
                                <div class="upper-box">
                                    <div class="service-block_one-icon-two flaticon-shuttle"></div>
                                    <h5 class="service-block_one-heading-two"><a href="#">Zero risk  Plan</a></h5>
                                </div>
                                <div class="service-block_one-text-two">
                                    Because we are using a super-model, our market analysis are always 99% accurate, and 1% due to
                                    human error. However, over the years, we have come to diversify and that has cut down the risk
                                    ratio to zero(0)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Services One -->

    <!-- Services One -->
    <section class="services-one" style="background-image:url({{asset('home/images/background/pattern-3.png')}})">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Awesome</div>
                <h2 class="sec-title_heading">Investment Packages</h2>
                <div class="sec-title_text">

                </div>
            </div>
            <div class="row clearfix text-center">
                @foreach($packages as $package)
                    <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp mb-5 mx-auto" data-wow-duration="1s"
                         data-wow-delay="0.1s" data-wow-offset="0"
                         style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <div class="pricing_design">
                            <div class="single-pricing">
                                <div class="price-head">
                                    <h2>{{$package->name}}</h2>
                                    <h1>{{$package->Roi}}%</h1>
                                    <span>/{{$package->returnType}}</span>
                                </div>
                                <ul>
                                    <li><b>Minimum</b>  ${{number_format($package->minAmount,2)}}</li>
                                    <li><b>Maximum</b> @if($package->unlimited !=1)
                                            ${{number_format($package->maxAmount,2)}}
                                        @else
                                            Unlimited
                                        @endif
                                    </li>
                                    <li><b>{{$package->returnType}} returns</b> at {{$package->Roi}}%</li>
                                    <li><b>Referral bonus</b> {{$package->referral}}%</li>
                                    <li><b>Contract</b> {{$package->Duration}}</li>
                                    <li><b>Total</b> {{$package->Roi*$package->numberOfReturn}}%</li>
                                </ul>
                                <div class="pricing-price">

                                </div>
                                <a href="{{route('register')}}" class="price_btn">Start Investment</a>
                            </div>
                        </div>
                    </div><!--- END COL -->
                @endforeach


            </div>



        </div>
    </section>
    <!-- End Services One -->


    <!-- Skill One -->
    <section class="skill-one">
        <div class="skill-one_pattern-layer" style="background-image:url({{asset('home/images/background/pattern-13.png')}})"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Sec Title -->
                        <div class="sec-title style-two">
                            <div class="sec-title_title">Productivity And Efficiency Equals Success</div>
                            <h2 class="sec-title_heading">We draw on our global <br> ability to grow.</h2>
                            <div class="sec-title_text">
                                Powered by advanced artificial intelligence (AI) algorithms, {{$siteName}} provides
                                cutting-edge solutions to help clients earn from the dynamic world of cryptocurrencies
                                with confidence and success.
                            </div>
                        </div>

                        <!-- Skills / Style Three -->
                        <div class="default-skills style-three">

                            <!-- Skill Item -->
                            <div class="default-skill-item">
                                <div class="default-skill-title">Business growth</div>
                                <div class="default-skill-bar">
                                    <div class="default-bar-inner">
                                        <div class="default-bar progress-line" data-width="90">
                                            <div class="default-count-box count-box"><span class="count-text" data-speed="2000" data-stop="90">0</span>%</div>
                                            <div class="default-skill-percentage"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Skill Item -->
                            <div class="default-skill-item">
                                <div class="default-skill-title">Financial Output</div>
                                <div class="default-skill-bar">
                                    <div class="default-bar-inner">
                                        <div class="default-bar progress-line" data-width="95">
                                            <div class="default-count-box count-box"><span class="count-text" data-speed="2000" data-stop="95">0</span>%</div>
                                            <div class="default-skill-percentage"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Skill Item -->
                            <div class="default-skill-item">
                                <div class="default-skill-title">Mining Ratio</div>
                                <div class="default-skill-bar">
                                    <div class="default-bar-inner">
                                        <div class="default-bar progress-line" data-width="80">
                                            <div class="default-count-box count-box"><span class="count-text" data-speed="2000" data-stop="80">0</span>%</div>
                                            <div class="default-skill-percentage"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <!-- Video Box -->
                    <div class="video-box style-two">
                        <figure class="video-image">
                            <img class="transition-500ms" src="{{asset('home/images/resource/video.jpg')}}" alt="">
                        </figure>
                        <a href="https://www.youtube.com/watch?v=XV_s5U0fvdU" class="lightbox-video overlay-box"><span class="fa-solid fa-play fa-fw"><i class="ripple"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Skill One -->

    <!-- Testimonial Two -->
    <section class="testimonial-two" style="background-image:url({{asset('home/images/background/2.jpg')}})">
        <div class="auto-container">
            <div class="content-box d-flex justify-content-end">
                <div class="content-box-inner">
                    <!-- Sec Title -->
                    <div class="sec-title light style-two">
                        <div class="sec-title_title">Testimonial</div>
                        <h2 class="sec-title_heading">We are very happy to <br> share client’s review.</h2>
                    </div>
                    <div class="single-item-carousel owl-carousel owl-theme">

                        <!-- Testimonial Block Two -->
                        <div class="testimonial-block_two">
                            <div class="testimonial-block_two-inner">
                                <div class="testimonial-block_two-text">
                                    “{{$siteName}} has completely transformed my cryptocurrency investments.
                                    Their AI-driven investment strategies have provided me with valuable insights and recommendations,
                                    resulting in significant returns on my portfolio. Their team's expertise and commitment
                                    to success are unmatched”
                                </div>
                                <h5>Maria S</h5>
                                <div class="designation">Investor</div>
                            </div>
                        </div>

                        <!-- Testimonial Block Two -->
                        <div class="testimonial-block_two">
                            <div class="testimonial-block_two-inner">
                                <div class="testimonial-block_two-text">
                                    “I've been mining cryptocurrencies for years, but it wasn't until I started using
                                    {{$siteName}}' AI-powered mining solutions that I truly optimized my operations.
                                    Their advanced algorithms have increased my mining efficiency and profitability,
                                    giving me a competitive edge in the industry. I highly recommend their services
                                    to any serious miner”
                                </div>
                                <h5>Joseph M</h5>
                                <div class="designation">Investor</div>
                            </div>
                        </div>

                        <!-- Testimonial Block Two -->
                        <div class="testimonial-block_two">
                            <div class="testimonial-block_two-inner">
                                <div class="testimonial-block_two-text">
                                    “Trading cryptocurrencies can be overwhelming, but {{$siteName}}' AI-powered trading
                                    systems have revolutionized my approach. Their algorithms make real-time market
                                    analysis and execute trades with precision. I've experienced remarkable results,
                                    and their support team has been there every step of the way.”
                                </div>
                                <h5>Sarah J</h5>
                                <div class="designation">Investor</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonial Two -->

    <!-- News Three -->
    <section class="news-three">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title style-two">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="left-box">
                        <div class="sec-title_title">our news</div>
                        <h2 class="sec-title_heading">We are Connected All Time <br> to Help Your Business!</h2>
                    </div>
                    <div class="right-box">
                    </div>
                </div>
            </div>

            <div class="news-carousel owl-carousel owl-theme">

                <!-- News Block -->
                <div class="news-block-two">
                    <div class="inner-box">
                        <rssapp-wall id="38kEBNRCi1vuK60z"></rssapp-wall>
                        <script src="https://widget.rss.app/v1/wall.js" type="text/javascript" async></script>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End News Three -->

    <!-- CTA One -->
    <section class="cta-one">
        <div class="auto-container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="left-box">
                    <h3 class="cta-one_heading">Looking for the Best Investment and Asset manager?</h3>
                    <div class="cta-one_text">
                        {{$siteName}} is poised to help you change your financial story.
                    </div>
                </div>
                <div class="right-box">
                    <a class="btn-style-seven theme-btn clearfix" href="{{route('register')}}">
                        <div class="btn-wrap">
                            <span class="text-one">Create Account</span>
                            <span class="text-two">Create Account</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End CTA One -->

@endsection
