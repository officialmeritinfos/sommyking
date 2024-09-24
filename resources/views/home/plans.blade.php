@extends('home.base')
@section('content')
    <!-- breadcrumb content begin -->
    <section class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative text-center">
                    <h1 class="mt-0 mb-1">{{$pageName}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        </ol>
                    </nav>
                    <img class="position-absolute card-decor animate-5" src="{{asset('home/img/in-avo-4-decor-1.svg')}}" alt="decor" style="top: 25%; left: 5%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-2.svg')}}" alt="decor" style="top: -22%; left: 30%;">
                    <img class="position-absolute card-decor animate-7" src="{{asset('home/img/in-avo-4-decor-3.svg')}}" alt="decor" style="top: -16%; left: 72%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-4.svg')}}" alt="decor" style="top: 89%; left: 94%;">
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb content end -->

    <!-- section content begin -->
    <section class="py-5 in-avo-11">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-12">
                    <h1><span class="text-highlight">Investment</span> Plans</h1>
                    <p class="lead text-muted mb-md-3">

                    </p>
                </div>
                <div class="col-lg-12 row">
                    @foreach($packages as $package)
                        <div class="col-lg-4 mt-3 mb-5 mx-auto">
                            <div class="card-badge">
                                <div class="card card-body ms-lg-5 position-relative">
                                    {{--                                    <span class="badge rounded-pill bg-primary">Low rates start from</span>--}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-display">
                                            <h3 class="mb-0 text-primary">{{$package->name}}</h3>
                                            <h1 class="fw-bold mb-0">
                                                <span class="currency"></span>{{$package->Roi}}<span class="decimal">%</span>
                                            </h1>
                                            <p class="text-muted mt-0">{{$package->returnType}}</p>
                                        </div>
                                    </div>
                                    <hr class="my-2" >
                                    <ul class="fa-ul lh-lg mt-2 mb-4">
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>Minimum</b>  ${{number_format($package->minAmount,2)}}
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>Maximum</b> @if($package->unlimited !=1)
                                                ${{number_format($package->maxAmount,2)}}
                                            @else
                                                Unlimited
                                            @endif
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>{{$package->returnType}} returns</b> at {{$package->Roi}}%
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>Referral bonus</b> {{$package->referral}}%
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>Contract</b> {{$package->Duration}}
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>
                                            <b>Total</b> {{$package->Roi*$package->numberOfReturn}}%
                                        </li>
                                    </ul>
                                    <a href="{{route('register')}}" class="btn btn-outline-primary rounded-pill">Create Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- section content end -->

@endsection
