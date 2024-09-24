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
    <section class="py-5 in-avo-17">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 position-relative">
                    <h2 class="text-center mb-1">Services</h2>
                    <p class="lead text-muted text-center">Navigate a host of some services we angage in</p>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gx-2 gy-2 mt-2 mb-3">
                        @foreach($services as $service)
                        <div class="col-md-6 col-lg-6">
                            <div class="card card-link">
                                <a class="link-light" href="{{route('service_detail',['id'=>$service->id])}}">
                                    <img src="{{asset('home/images/service/'.$service->photo2)}}" class="img-fluid rounded-1" alt="image">
                                    <div class="card-img-overlay">
                                        <h4 class="text-white mb-0">{{$service->title}}</h4>
                                        <p class="text-white text-opacity-75 mb-0">
                                            {{$service->short}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach


                    </div>
                    <img class="position-absolute card-decor animate-5" src="{{asset('home/img/in-avo-4-decor-1.svg')}}" alt="decor" style="top: 64%; left: -5%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-2.svg')}}" alt="decor" style="top: 0%; left: 10%;">
                    <img class="position-absolute card-decor animate-7" src="{{asset('home/img/in-avo-4-decor-3.svg')}}" alt="decor" style="top: 40%; left: 96%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-4.svg')}}" alt="decor" style="top: 98%; left: 86.5%;">
                </div>
            </div>
        </div>
    </section>
    <!-- section content end -->
</main>



@endsection
