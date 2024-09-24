@extends('home.base')

@section('content')

    @push('navslider')
        <div class="table" style="background-image:url({{asset('home/images/hero1.jpg')}}) no-repeat center;">
            <div class="table-cell" >
                <div class="container" >
                    <h3>{{$pageName}}<span>.</span></h3>
                </div>
                <!-- end container -->
            </div>
            <!-- end table-cell -->
        </div>
        <!-- end table -->
    @endpush

    <section class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">{{$pageName}}</li>
                    </ul>
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

@endsection
