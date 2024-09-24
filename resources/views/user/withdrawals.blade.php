@extends('user.base')
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
                                    <th>Amount</th>
{{--                                    <th>Crypto Amount</th>--}}
                                    <th>Asset</th>
                                    <th>Address To</th>
                                    <th>Date Requested</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>${{number_format($withdrawal->fiatAmount,2)}}</td>
{{--                                        <td>{{$withdrawal->amount}}</td>--}}
                                        <td>{{$withdrawal->asset}}</td>
                                        <td>{{$withdrawal->addressTo}}</td>
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
                                                    <span class="badge badge-primary">Queued</span>
                                                @break
                                                @default
                                                    <span class="badge badge-danger">Cancelled</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($withdrawal->status !=1 && $withdrawal->status !=3)
                                                <a href="{{route('withdraw.cancel',['id'=>$withdrawal->id])}}"
                                                class="btn btn-danger btn-sm">
                                                    Cancel
                                                </a>
                                            @endif
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
