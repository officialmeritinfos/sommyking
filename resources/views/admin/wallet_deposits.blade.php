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
                                    <th>Amount</th>
                                    <th>Asset</th>
                                    <th>Address</th>
                                    <th>Address From</th>
                                    <th>Transaction Hash</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td>{{$deposits->amount}}</td>
                                        <td>{{$deposits->asset}}</td>
                                        <td>{{$deposits->addressTo}}</td>
                                        <td>{{$deposits->addressFrom}}</td>
                                        <td>{{$deposits->transHash}}</td>
                                        <td>{{$deposits->created_at}}</td>
                                        <td>
                                            @switch($deposits->status)
                                                @case(1)
                                                <span class="badge badge-success">Active</span>
                                                @break

                                                @default
                                                <span class="badge badge-danger">Inactive</span>
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


@endsection
