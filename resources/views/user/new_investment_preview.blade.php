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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form method="POST" action="{{route('investment.new')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Minimum Amount ($)</label>
                                            <input type="text" placeholder="Name" class="form-control"
                                                   value="{{$package->minAmount}}" disabled/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Maximum Maximum Amount($)</label>
                                            <input type="text"  class="form-control"
                                                   value="{{$package->maxAmount}}" disabled/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" placeholder="Amount" class="form-control"
                                                   name="amount" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Account</label>
                                            <select class="form-control default-select" id="inputState"
                                                    name="account">
                                                <option selected="">Choose...</option>
                                                <option value="1">New Deposit</option>
                                                <option value="2">Reinvest from Profit Balance</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Payment Method</label>
                                            <select class="form-control default-select" id="inputState"
                                                    name="asset">
                                                <option selected="">Choose...</option>
                                                @foreach($assets as $asset)
                                                    <option value="{{$asset->asset}}">{{$asset->coin}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Investment Sector</label>
                                            <select class="form-control default-select" id="inputState"
                                                    name="sector">
                                                <option selected="">Choose...</option>
                                                <option>Cryptocurrency Mining</option>
                                                <option>Cryptocurrency</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" style="display: none;">
                                            <label>Package</label>
                                            <input type="text" class="form-control" name="package"
                                                   value="{{$package->id}}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

