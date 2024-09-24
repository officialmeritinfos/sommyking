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
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Balance</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wallets as $wallet)
                                    <tr>
                                        <td>{{$wallet->asset}}</td>
                                        <td>{{$wallet->availableBalance}}</td>
                                        <td>{{$wallet->address}}</td>
                                        <td>{{$wallet->created_at}}</td>
                                        <td>
                                            @switch($wallet->status)
                                                @case(1)
                                                <span class="badge badge-success">Active</span>
                                                @break

                                                @default
                                                <span class="badge badge-danger">Inactive</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{route('admin.wallet.withdrawals',['id'=>$wallet->asset])}}"
                                               class="btn btn-success btn-sm" style="margin-bottom:5px;">
                                                View Withdrawals
                                            </a>
                                            <a href="{{route('admin.wallet.deposits',['id'=>$wallet->asset])}}"
                                               class="btn btn-info btn-sm">
                                                View Deposits
                                            </a>
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


@endsection
