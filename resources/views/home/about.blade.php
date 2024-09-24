@extends('home.base')
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('home/images/background/5.jpg')}})">
        <div class="auto-container">
            <h2>{{$pageName}}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>{{$pageName}}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <main>
        <!-- section content begin -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9 text-center">
                        <h1>Putting our clients first <span class="text-highlight">since 2010</span></h1>
                        <p class="lead text-muted">
                            For more than 10 years, we’ve been empowering clients by helping them take
                            control of their financial lives.
                        </p>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row gy-2 gy-md-2 gx-0 gx-md-2 gx-lg-4">
                            <div class="col-md-12 d-flex align-items-start">
                                <div class="icon-wrap bg-primary rounded-circle flex-shrink-0 me-2">
                                    <i class="fas fa-leaf fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="h4">About Us</h3>
                                    <p class="mb-0">
                                        {{$siteName}} is an investment company that allows investors - small and large scale to
                                        seamlessly invest in crypto mining with guaranteed returns.
                                        Powered by advanced artificial intelligence (AI) algorithms, {{$siteName}} provides
                                        cutting-edge solutions to help clients earn from the dynamic world of cryptocurrencies
                                        with confidence and success.<br/>
                                        With our AI-driven investment strategies, we analyze extensive market data, historical
                                        trends, and real-time indicators to make informed investment decisions and optimize
                                        portfolio performance.
                                        <br/>
                                        Moreover, our AI-powered trading systems revolutionize the way our clients approach the
                                        market. By leveraging real-time analysis, historical patterns, and indicators, our
                                        trading algorithms execute trades with precision and accuracy, enabling our clients
                                        to capitalize on market opportunities and enhance their trading performance.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-start">
                                <div class="icon-wrap bg-primary rounded-circle flex-shrink-0 me-2">
                                    <i class="fas fa-hourglass-end fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="h4">History</h3>
                                    <p class="mb-0">
                                        In 2010, {{$siteName}} was founded, envisioning a future where cryptocurrencies and AI intersect
                                        to revolutionize the financial landscape. By 2008-2009,
                                        the company focuses on research and development, exploring the potential of
                                        cryptocurrencies and laying the foundation for AI-driven solutions. By 2010-2012,
                                        {{$siteName}} establishes itself as a trusted name in the cryptocurrency industry,
                                        offering innovative investment strategies and attracting a growing client base.
                                        By 2021,{{$siteName}} reaches a milestone, managing a diverse portfolio of clients and establishing
                                        itself as a leader in AI-powered cryptocurrency solutions. The company's commitment to
                                        innovation, expertise, and client success sets it apart in the industry.
                                        2022-2023,{{$siteName}} continues to adapt to the evolving cryptocurrency landscape, embracing new
                                        technologies and expanding its range of services. They stay at the forefront of AI
                                        advancements, further optimizing their investment strategies, mining operations,
                                        and trading algorithms.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section content end -->

        <!-- section content begin -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-9">
                        <div class="row row-cols-1 row-cols-lg-2 align-items-center gy-3">
                            <div class="col text-md-center text-lg-start">
                                <h4 class="text-secondary mb-1">Number speaks</h4>
                                <h1>We always ready<br>for a challenge.</h1>
                                <a href="#" class="btn btn-primary rounded-pill mt-2">Learn more<i class="fas fa-arrow-right fa-sm ms-1"></i></a>
                            </div>
                            <div class="col">
                                <div class="row align-items-start gx-0 mb-2 mb-md-4">
                                    <div class="col-12 col-md-4 text-md-end border-bottom border-primary">
                                        <h1 class="text-primary">
                                            <span class="count" data-counter-end="410">410</span>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-md-8 mt-2 mt-md-0 ps-md-4">
                                        <h5>Trading instruments</h5>
                                        <p>
                                            Because we belive in diversification of portfolio, we engage in diverse activities
                                            from cryptocurrency investments, to precious mineral mining to NFTs, to stocks,
                                            and to ETFs.
                                        </p>
                                    </div>
                                </div>
                                <div class="row align-items-start gx-0">
                                    <div class="col-12 col-md-4 text-md-end border-bottom border-primary">
                                        <h1 class="text-primary">
                                            <span class="count" data-counter-end="107">50+</span>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-md-8 mt-2 mt-md-0 ps-md-4">
                                        <h5>Countries covered</h5>
                                        <p>
                                            We are present in over 100 countries including the United States, United Kingdom,
                                            Australia, Denmark, Israel, Saudi Arabia, Canada, China and Switzerland to name
                                            but a few.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section content end -->
    </main>
@endsection
