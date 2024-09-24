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
                            <button class="btn btn-block btn-sm btn-primary" data-toggle="modal"
                                    data-target="#new_wallet">
                                Add Wallet
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>Coin</th>
                                    <th>Asset</th>
                                    <th>Network</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wallets as $wallet)
                                    <tr>
                                        <td>{{$wallet->coin}}</td>
                                        <td>{{$wallet->asset}}</td>
                                        <td>{{$wallet->network}}</td>
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
                                            <a href="{{route('admin.wallet.delete',['id'=>$wallet->id])}}"
                                               class="btn btn-danger btn-sm">
                                                Delete
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

    <div class="modal fade" id="new_wallet">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Wallet</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.wallet.add')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Coin Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Coin Code</label>
                                <input type="text" class="form-control" name="asset">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Network</label>
                                <input type="text" class="form-control" name="network">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
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

@endsection
