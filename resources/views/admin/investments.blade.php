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
                                        <th>Investor</th>
                                        <th>Reference</th>
                                        <th>Asset</th>
                                        <th>Amount</th>
                                        <th>Roi</th>
                                        <th>Current profit</th>
                                        <th>Sector</th>
                                        <th>Status</th>
                                        <th>Date Enrolled</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($investments as $investment)
                                        @inject('option','App\Custom\CustomChecks')
                                        <tr>
                                            <td>{{$option->userId($investment->user)}}</td>
                                            <td>{{$investment->stakeRef}}</td>
                                            <td>{{$investment->asset}}</td>
                                            <td>${{number_format($investment->amount,2)}}</td>
                                            <td>{{$investment->Roi}}%</td>
                                            <td>${{number_format($investment->currentProfit,2)}}</td>
                                            <td>{{$investment->sector}}</td>
                                            <td>
                                                @switch($investment->status)
                                                    @case(1)
                                                        <span class="badge badge-success">Completed</span>
                                                    @break
                                                    @case(2)
                                                        <span class="badge badge-dark">Pending Deposit</span>
                                                    @break
                                                    @case(4)
                                                        <span class="badge badge-info">Ongoing</span>
                                                    @break
                                                    @default
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{$investment->created_at}}</td>
                                            <td>
                                                <a href="{{route('admin.invest_detail',['id'=>$investment->id])}}"
                                                   class="btn btn-sm btn-primary">View</a>
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
    </div>
@endsection
