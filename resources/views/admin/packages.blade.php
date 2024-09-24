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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('templates.notification')
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <a href="{{route('admin.package.create')}}" class="btn btn-primary btn-sm">
                                New Package
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Minimum Amount</th>
                                    <th>Maximum Amount</th>
                                    <th>Roi</th>
                                    <th>Duration</th>
                                    <th>Number Of Returns</th>
                                    <th>Return Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>{{$package->name}}</td>
                                        <td>${{number_format($package->minAmount,2)}}</td>
                                        <td>
                                            @if($package->unlimited ==1)
                                                Unlimited
                                            @else
                                                ${{number_format($package->maxAmount,2)}}
                                            @endif
                                        </td>
                                        <td>{{$package->Roi}}%</td>
                                        <td>{{$package->Duration}}</td>
                                        <td>{{$package->numberOfReturn}}</td>
                                        <td>{{$package->returnType}}</td>
                                        <td>
                                            @switch($package->status)
                                                @case(1)
                                                    <span class="badge badge-success">Active</span>
                                                @break
                                                @default
                                                    <span class="badge badge-danger">Inactive</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{route('admin.package.edit',['id'=>$package->id])}}"
                                            class="btn btn-primary btn-sm" style="margin-bottom: 5px;">
                                                Edit
                                            </a>
                                            <a href="{{route('admin.package.delete',['id'=>$package->id])}}"
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


@endsection
