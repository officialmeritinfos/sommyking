@extends('user.base')
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
            @foreach($notifications as $notify)
                <div class="alert alert-primary alert-dismissible alert-alt solid fade show text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong class="text-center">{{$notify->subject}}!</strong>
                    <p class="text-center">
                        {{$notify->content}}
                    </p>
                </div>
        @endforeach

        <!-- row -->
            <div class="row">
                
                
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card bg-gray-dark">
                        <div class="card-body p-4">
                            <div class="col-md-12">
                                <a href="{{route('new_investment')}}" class="btn btn-primary">New Deposit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card bg-gray-dark ">
                        <div class="card-body p-4">
                            <div class="col-md-12">
                                <a data-toggle="modal"
                                   data-target="#new_withdrawal" class="btn btn-dark">New Withdrawal</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-gray-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-money"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Profit Balance</p>
                                    <h3 class="text-white">
                                        ${{number_format($user->profit,2)}}
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
                    <div class="widget-stat card bg-blue-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-btc"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Ongoing Investments</p>
                                    <h3 class="text-white">
                                        ${{$ongoingInvestments}}
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
                                    <p class="mb-1">Pending Deposit</p>
                                    <h3 class="text-white">
                                        ${{$deposits}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="widget-stat card bg-dark">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-money"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Referral Balance</p>
                                    <h3 class="text-white">
                                        ${{number_format($user->referral,2)}}
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
