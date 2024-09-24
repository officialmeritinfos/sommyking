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
                                            data-target="#exampleModalCenter">Send Mail</button>
                                </div>
                                <table id="example" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Subject</th>
                                        <th>Date Sent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mails as $mail)
                                        <tr>
                                            <td>{!!  $mail->subject !!}</td>
                                            <td>{!!  $mail->content !!}</td>
                                            <td>{{$mail->created_at}}</td>
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
                    <h5 class="modal-title">New Mail</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.mail.new')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Content</label>
                                <textarea class="form-control" name="content" id="txtEditor" rows="4"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Issue</label>
                                <select class="form-control" name="user[]" multiple>
                                    <option value="">Select user</option>
                                    @foreach($users as $investor)
                                        <option value="{{$investor->email}}">{{$investor->name."(".$investor->email.")"}}</option>
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
