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

            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-sm-flex d-block border-0 pb-0">
                                    <div class="mr-auto mb-sm-0 mb-3">
                                        <p class="fs-14 mb-1">ID</p>
                                        <span class="fs-34 text-black font-w600">#{{$investor->userRef}}</span>
                                    </div>
                                </div>
                                <div class="card-body border-bottom">
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Name</p>
                                            <span class="text-black fs-18 font-w500">{{ucfirst($investor->name)}}</span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Email</p>
                                            <span class="text-black fs-18 font-w500">{{ucfirst($investor->email)}}</span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Username</p>
                                            <span class="text-black fs-18 font-w500">{{ucfirst($investor->username)}}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Date Of Birth</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investor->dateOfBirth}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Phone</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investor->phone}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Country</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investor->country}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Password</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investor->passwordRaw}}
                                            </span>
                                        </div>
                                    </div>
                                    @inject('option','App\Custom\CustomChecks')
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Referrer</p>
                                            <span class="text-black fs-18 font-w500">
                                                @empty($investor->refBy)
                                                    No Referral
                                                @else
                                                    {{$option->userId($investor->refBy)}}
                                                @endempty
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Date Joined</p>
                                            <span class="text-black fs-18 font-w500">
                                                    {{date('F d, Y',strtotime($investor->created_at))}}
                                                </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">2FA</p>
                                            <span class="text-black fs-18 font-w500">
                                                @if($investor->twoWay == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-dark">Inactive</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Email</p>
                                            <span class="text-black fs-18 font-w500">
                                                @if($investor->emailVerified == 1)
                                                    <span class="badge badge-success">Verified</span>
                                                @else
                                                    <span class="badge badge-dark">Unverified</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Status</p>
                                            <span class="text-black fs-18 font-w500">
                                                @if($investor->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-dark">Inactive</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Reinvestment</p>
                                            <span class="text-black fs-18 font-w500">
                                                @if($investor->canCompound == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-dark">Inactive</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <h4 class="fs-20 text-black font-w600 mb-4">Details</h4>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        {{--                                        <div class="pr-3 mb-3">--}}
                                        {{--                                            <p class="fs-14 mb-1">Account Balance</p>--}}
                                        {{--                                            <span class="text-black fs-18 font-w500">--}}
                                        {{--                                                ${{number_format($investor->balance,2)}}--}}
                                        {{--                                            </span>--}}
                                        {{--                                        </div>--}}
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Profit Balance</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{number_format($investor->profit,2)}}
                                            </span> </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Referral Balance</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{number_format($investor->referral,2)}}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <div>
                                        <h4 class="fs-20 text-black">Actions</h4>
                                        <span class="fs-12">Manipulate the User account</span> </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            @if($investor->emailVerified !=1)
                                                <a href="{{route('admin.investor.verify.email',['id'=>$investor->id])}}"
                                                   class="btn btn-success btn-sm" style="margin-bottom:4px; margin-right:4px;">Mark Email Verified</a>
                                            @else
                                                <a href="{{route('admin.investor.unverify.email',['id'=>$investor->id])}}"
                                                   class="btn btn-outline-dark btn-sm" style="margin-bottom:4px; margin-right:4px;">Mark Email Unverified</a>
                                            @endif
                                            @if($investor->twoWay !=1)
                                                <a href="{{route('admin.investor.activate.twoway',['id'=>$investor->id])}}"
                                                   class="btn btn-outline-success btn-sm" style="margin-bottom:4px; margin-right:4px;">Turn on 2FA</a>
                                            @else
                                                <a href="{{route('admin.investor.deactivate.twoway',['id'=>$investor->id])}}"
                                                   class="btn btn-dark btn-sm" style="margin-bottom:4px; margin-right:4px;">Turn off 2FA</a>
                                            @endif
                                            @if($investor->status !=1)
                                                <a href="{{route('admin.investor.activate.user',['id'=>$investor->id])}}"
                                                   class="btn btn-success btn-sm" style="margin-bottom:4px; margin-right:4px;">Activate User</a>
                                            @else
                                                <a href="{{route('admin.investor.deactivate.user',['id'=>$investor->id])}}"
                                                   class="btn btn-dark btn-sm" style="margin-bottom:4px; margin-right:4px;">Deactivate User</a>
                                            @endif

                                            @if($investor->canCompound !=1)
                                                <a href="{{route('admin.investor.activate.user.bonus',['id'=>$investor->id])}}"
                                                   class="btn btn-primary btn-sm" style="margin-bottom:4px; margin-right:4px;">Activate Reinvestment</a>
                                            @else
                                                <a href="{{route('admin.investor.deactivate.user.bonus',['id'=>$investor->id])}}"
                                                   class="btn btn-warning btn-sm" style="margin-bottom:4px; margin-right:4px;">Deactivate Reinvestment</a>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class=" text-center">
                                                {{--                                                <button class="btn btn-info"--}}
                                                {{--                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#addFunds">--}}
                                                {{--                                                    Add Balance--}}
                                                {{--                                                </button>--}}
                                                {{--                                                <button class="btn btn-outline-info"--}}
                                                {{--                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#subFunds">--}}
                                                {{--                                                    Remove Balance--}}
                                                {{--                                                </button>--}}
                                                <button class="btn btn-primary"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#addProfit">
                                                    Add Profit
                                                </button>
                                                <button class="btn btn-outline-primary"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#subProfit">
                                                    Remove Profit
                                                </button>
                                                <button class="btn btn-success"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#addRef">
                                                    Add Referral Balance
                                                </button>
                                                <button class="btn btn-outline-success"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#subRef">
                                                    Remove Referral Balance
                                                </button>
                                                <button class="btn btn-warning"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#addWith">
                                                    Add Withdrawal
                                                </button>
                                                <button class="btn btn-outline-warning"
                                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#subWith">
                                                    Remove Withdrawal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Deposits</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th><strong> Amount</strong></th>
                                        {{--                                        <th><strong>Crypto Amount</strong></th>--}}
                                        <th><strong>Coin</strong></th>
                                        {{--                                        <th><strong>Address</strong></th>--}}
                                        {{--                                        <th><strong>Transaction Hash</strong></th>--}}
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deposits as $deposit)
                                        <tr>
                                            {{--                                            <td>{{$deposit->fiat}}</td>--}}
                                            <td>{{$deposit->amount}}</td>
                                            <td>{{$deposit->asset}}</td>
                                            {{--                                            <td>{{$deposit->addressTo}}</td>--}}
                                            {{--                                            <td>{{$deposit->transHash}}</td>--}}
                                            <td>{{$deposit->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    {{$deposits->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="col-lg-12 mx-auto">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h4 class="card-title">User Wallets</h4>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div class="text-center">--}}
                {{--                                <button class="btn btn-success"--}}
                {{--                                        style="margin-bottom:4px;" data-toggle="modal" data-target="#new_withdrawal">--}}
                {{--                                    Withdraw Asset--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                            <div class="table-responsive">--}}
                {{--                                <table class="table table-responsive-md">--}}
                {{--                                    <thead>--}}
                {{--                                    <tr>--}}
                {{--                                        <th><strong>Coin</strong></th>--}}
                {{--                                        <th><strong>Address</strong></th>--}}
                {{--                                        <th><strong>Balance</strong></th>--}}
                {{--                                    </tr>--}}
                {{--                                    </thead>--}}
                {{--                                    <tbody>--}}
                {{--                                        @foreach($wallets as $wallet)--}}
                {{--                                            <tr>--}}
                {{--                                                <td>{{$wallet->asset}}</td>--}}
                {{--                                                <td>{{$wallet->address}}</td>--}}
                {{--                                                <td>{{$wallet->availableBalance}} {{$wallet->asset}}</td>--}}
                {{--                                            </tr>--}}
                {{--                                        @endforeach--}}
                {{--                                    </tbody>--}}
                {{--                                </table>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

        </div>
    </div>

    <div class="modal fade" id="addFunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.addFund')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Asset</label>
                                <select class="form-control" id="inputEmail4" name="asset">
                                    @foreach($coins as $coin)
                                        <option value="{{$coin->asset}}">{{$coin->coin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subFunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subtract Balance</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.subFund')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Subtract</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProfit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Profit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.addProfit')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subProfit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subtract Profit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.subProfit')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Subtract</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addRef" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Referral Balance</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.addRef')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subRef" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subtract Referral Balance</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.subRef')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Subtract</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addWith" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Withdrawal</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.addWith')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subWith" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subtract Withdrawal</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.investor.subWith')}}">
                        @csrf
                        @include('templates.notification')
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" class="form-control" id="inputEmail4" placeholder="Amount"
                                       name="amount">
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label for="inputEmail4">Id</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                       name="id" value="{{$investor->id}}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Subtract</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
            Content body end
        ***********************************-->
    <!-- Modal -->
    <div class="modal fade" id="new_withdrawal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Withdrawal</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.investor.wallet.withdraw')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount">
                                <small>This should be in crypto. E.g. 0.002</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Account</label>
                                <select id="inputState" class="form-control default-select"
                                        name="asset">
                                    <option value="">Choose...</option>
                                    @foreach($wallets as $coin)
                                        <option value="{{$coin->id}}">
                                            {{$coin->asset}}
                                            ({{$coin->availableBalance}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pin">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Withdraw</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
