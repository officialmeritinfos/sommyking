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

    <main data-title="blog-single">
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center blog-article">
                    <div class="col-12">
                        <img class="rounded-0 rounded-top rounded-lg-1 img-fluid mb-md-0 mb-lg-n5"
                             src="{{asset('home/images/service/'.$service->photo)}}"
                             alt="{{$service->title}}" />
                    </div>
                    <div class="col-md-12 col-lg-9">
                        <article class="card rounded-0 rounded-bottom rounded-lg-1 blog-card">
                            <div class="card-body p-3 py-md-4 px-md-5">

                                <h2 class="fw-bold mt-3 mb-4">
                                    {{$service->title}}
                                </h2>
                                <p>
                                    {!! $service->content !!}
                                </p>
                                </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
