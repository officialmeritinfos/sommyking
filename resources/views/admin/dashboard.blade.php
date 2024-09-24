@extends('admin.base')
@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->

        <div class="container-fluid">
            <div class="page-titles">
                <h4>{{$pageName}}</h4>
            </div>
        @include('templates.notification')
        <!-- row -->
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-info">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Total Deposits</p>
                                    <h3 class="text-white">
                                        {{$deposits->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-blue-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Total Investments</p>
                                    <h3 class="text-white">
                                        {{$investments->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-blue-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Ongoing Investments</p>
                                    <h3 class="text-white">
                                        {{$ongoingInvestments->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-blue-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Completed Investments</p>
                                    <h3 class="text-white">
                                        {{$completedInvestments->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Total Withdrawals</p>
                                    <h3 class="text-white">
                                        {{$withdrawals->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Pending Withdrawals</p>
                                    <h3 class="text-white">
                                        {{$pendingWithdrawal->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4 mx-auto">
                    <div class="widget-stat card bg-blue-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Total Investors</p>
                                    <h3 class="text-white">
                                        {{$investors->count()}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
