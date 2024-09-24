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
            <!-- row -->
{{--            <div class="row">--}}
{{--                @foreach($balances as $balance)--}}
{{--                    <div class="col-xl-6 col-lg-6 col-sm-6">--}}
{{--                        <div class="widget-stat card bg-blue-dark">--}}
{{--                            <div class="card-body  p-4">--}}
{{--                                <div class="media">--}}
{{--                                    <span class="mr-3">--}}
{{--                                        @if($balance->isUsd==1)--}}
{{--                                            <i class="fa fa-dollar"></i>--}}
{{--                                        @else--}}
{{--                                            <i class="fa fa-btc"></i>--}}
{{--                                        @endif--}}
{{--                                    </span>--}}
{{--                                    <div class="media-body text-white text-right">--}}
{{--                                        <p class="mb-1">{{$balance->asset}}</p>--}}
{{--                                        <h3 class="text-white">--}}
{{--                                            @if($balance->isUsd==1)--}}
{{--                                                {{number_format($balance->availableBalance,2)}}--}}
{{--                                            @else--}}
{{--                                                {{number_format($balance->availableBalance,7)}}--}}
{{--                                            @endif--}}
{{--                                        </h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title">--}}
{{--                                Swaps--}}
{{--                            </h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="text-center">--}}
{{--                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"--}}
{{--                                        data-target="#exampleModalCenter">--}}
{{--                                    New Swap--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-responsive-md">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="width80"><strong>#</strong></th>--}}
{{--                                        <th><strong>Amount</strong></th>--}}
{{--                                        <th><strong>Balance From</strong></th>--}}
{{--                                        <th><strong>Balance To</strong></th>--}}
{{--                                        <th><strong>Amount Credited</strong></th>--}}
{{--                                        <th><strong>Date</strong></th>--}}
{{--                                        <th></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($swaps as $swap)--}}
{{--                                        <tr>--}}
{{--                                            <td><strong>{{$swap->id}}</strong></td>--}}
{{--                                            <td>{{$swap->amount}}</td>--}}
{{--                                            <td>{{$swap->balanceFrom}}</td>--}}
{{--                                            <td>{{$swap->balanceTo}}</td>--}}
{{--                                            <td>--}}
{{--                                                <span class="badge light badge-info">--}}
{{--                                                    {{$swap->amountCredited}}--}}
{{--                                                </span>--}}
{{--                                            </td>--}}
{{--                                            <td>{{$swap->created_at}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                                <div class="text-right">--}}
{{--                                    {{$swaps->links()}}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row">
{{--                <div class="col-xl-4 col-lg-4 col-sm-4">--}}
{{--                    <div class="widget-stat card bg-gray-dark">--}}
{{--                        <div class="card-body  p-4">--}}
{{--                            <div class="media">--}}
{{--                                    <span class="mr-3">--}}
{{--                                        <i class="fa fa-money"></i>--}}
{{--                                    </span>--}}
{{--                                <div class="media-body text-white text-right">--}}
{{--                                    <p class="mb-1">Account Balance</p>--}}
{{--                                    <h3 class="text-white">--}}
{{--                                        ${{number_format($user->balance,2)}}--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Swap</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('swap')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Balance From</label>
                                <select id="inputState" class="form-control default-select"
                                name="balanceFrom">
                                    <option value="">Choose...</option>
                                    @foreach($balances as $bal)
                                        <option value="{{$bal->asset}}">{{$bal->asset}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Balance To</label>
                                <select id="inputState" class="form-control default-select"
                                name="balanceTo">
                                    <option value="">Choose...</option>
                                    @foreach($balances as $bal)
                                        <option value="{{$bal->asset}}">{{$bal->asset}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Swap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
