@extends('admin.base')
@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->

        <!-- row -->
        <div class="container-fluid">
            <div class= "page-titles form-head d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h2 class="text-black font-w600 mb-0 mr-auto mb-2 pr-3">{{$pageName}}</h2>
            </div>
        </div>
        @include('templates.notification')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#new_withdrawal">
                                New Withdrawal
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>Crypto Amount</th>
                                    <th>Asset</th>
                                    <th>Address</th>
                                    <th>Fiat Amount</th>
                                    <th>Transaction Hash</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{$withdrawal->amount}}</td>
                                        <td>{{$withdrawal->asset}}</td>
                                        <td>{{$withdrawal->addressTo}}</td>
                                        <td>${{number_format($withdrawal->fiatAmount,2)}}</td>
                                        <td>{{$withdrawal->transHash}}</td>
                                        <td>{{$withdrawal->created_at}}</td>
                                        <td>
                                            @switch($withdrawal->status)
                                                @case(1)
                                                <span class="badge badge-success">Completed</span>
                                                @break
                                                @case(2)
                                                <span class="badge badge-info">Pending</span>
                                                @break
                                                @case(4)
                                                <span class="badge badge-primary">
                                                    Pending Blockchain Confirmation
                                                </span>
                                                @break
                                                @default
                                                <span class="badge badge-danger">Cancelled</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <form method="POST" action="{{route('admin.wallet.withdraw')}}">
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
                                    @foreach($balances as $coin)
                                        <option value="{{$coin->asset}}">
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
