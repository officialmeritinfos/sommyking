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
            <div class="row d-md-flex justify-content-md-center gx-lg-5">
                <div class="col-12 col-md-10 col-lg-6 pe-lg-5">
                    <h4 class="text-secondary mb-0">Have a questions?</h4>
                    <h1 class="mb-0">Let's <span class="text-highlight">get in touch</span></h1>
                    <div class="card mb-4 mb-md-4 mb-lg-0 mt-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-1 icon-wrap icon-wrap-small bg-primary rounded-circle flex-shrink-0">
                                    <i class="fas fa-map-marker-alt fa-sm text-primary"></i>
                                </div>
                                <p class="mb-0">
                                    {{$web->address}}
                                </p>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 mt-1 gx-lg-0">
                                <div class="col mb-2 mb-md-0 mb-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-1 icon-wrap icon-wrap-small bg-primary rounded-circle flex-shrink-0">
                                            <i class="fas fa-envelope fa-sm text-primary"></i>
                                        </div>
                                        <p class="mb-0">{{$web->email}}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="me-1 icon-wrap icon-wrap-small bg-primary rounded-circle flex-shrink-0">
                                            <i class="fas fa-phone fa-sm text-primary"></i>
                                        </div>
                                        <p class="mb-0">{{$web->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 d-flex">
                    <iframe class="bg-light rounded-1 gmap w-100 h-300 h-md-400 h-lg-600"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d788.2714290681316!2d-122.40677233038309!3d37.788028758101426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858088d85d7123%3A0xdae9e8e7078f0611!2s171%20Maiden%20Ln%2C%20San%20Francisco%2C%20CA%2094108%2C%20USA!5e0!3m2!1sen!2sng!4v1690060280570!5m2!1sen!2sng">
                    </iframe>
                </div>
            </div>
        </div>

    </section>
    <!-- section content end -->
    </main>
@endsection
