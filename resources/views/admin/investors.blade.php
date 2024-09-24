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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Reference</th>
                                        <th>Date Join</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($investors as $investor)
                                        <tr>
                                            <td>{{$investor->name}}</td>
                                            <td>{{$investor->email}}</td>
                                            <td>{{$investor->username}}</td>
                                            <td>{{$investor->userRef}}</td>
                                            <td>{{$investor->created_at}}</td>
                                            <td>
                                                <a href="{{route('admin.investor.detail',['id'=>$investor->id])}}"
                                                class="btn btn-sm btn-dark">View</a>
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
