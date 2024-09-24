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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="text-center">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter">New Ticket</button>
                                </div>
                                <table id="example" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{$ticket->reference}}</td>
                                            <td>{{$ticket->subject}}</td>
                                            <td>
                                                @switch($ticket->status)
                                                    @case(1)
                                                    <span class="badge badge-success">Closed</span>
                                                    @break
                                                    @case(2)
                                                    <span class="badge badge-dark">Client Response</span>
                                                    @break
                                                    @default
                                                    <span class="badge badge-primary">Support Response</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{$ticket->created_at}}</td>
                                            <td>
                                                <a href="{{route('ticket_detail',['id'=>$ticket->reference])}}"
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('support.new')}}">
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
