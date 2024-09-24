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
                                <div class="text-center">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter">New Notification</button>
                                </div>
                                <table id="example" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Subject</th>
                                        <th>Content</th>
                                        <th>Display Type</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notifications as $ticket)
                                        @inject('injected','App\Custom\Regular')
                                        <tr>
                                            <td>{{$injected->getInvestorName($ticket->user)}}</td>
                                            <td>{{$ticket->subject}}</td>
                                            <td>{{$ticket->content}}</td>
                                            <td>
                                                @switch($ticket->showInDashboard)
                                                    @case(1)
                                                    <span class="badge badge-success">Dashboard Display</span>
                                                    @break
                                                    @case(2)
                                                    <span class="badge badge-primary">Homepage Display</span>
                                                    @break
                                                    @default
                                                    <span class="badge badge-info">Dashboard & Homepage Display</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{$ticket->created_at}}</td>
                                            <td>
                                                <a href="{{route('admin.notify.close',['id'=>$ticket->id])}}"
                                                   class="btn btn-sm btn-danger">Delete</a>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Notification</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.notify.new')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Issue</label>
                                <textarea class="form-control" name="content" rows="4"></textarea>
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label>Display Type</label>
                                <select class="form-control" name="display">
                                    <option value="">Select an option</option>
                                    <option value="1" selected>Dashboard Display</option>
{{--                                    <option value="2">Homepage Display</option>--}}
{{--                                    <option value="3">Homepage & Dashboard Display</option>--}}
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Investor</label>
                                <select class="form-control" name="user">
                                    <option value="">Select an option</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                    @endforeach
                                 </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
