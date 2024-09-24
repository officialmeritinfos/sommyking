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
                <div class="col-xl-12 col-xxl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="card-title">Timeline</h4>
                        </div>
                        <div class="card-body">
                            <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll height370">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge info">
                                        </div>
                                        <a class="timeline-panel text-muted" href="#">
                                            <span>{{$ticket->created_at}}</span>
                                            <h6 class="mb-0">
                                                {{$ticket->subject}}
                                            </h6>
                                            <p class="mb-0">
                                                {{$ticket->content}}
                                            </p>
                                        </a>
                                    </li>
                                    @foreach($responses as $response)
                                        @if($response->responseType==1)
                                            <li>
                                                <div class="timeline-badge primary"></div>
                                                <a class="timeline-panel text-muted" href="#">
                                                    <span>{{$response->created_at}}</span>
                                                    <h6 class="mb-0">
                                                        {{$response->response}}
                                                    </h6>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <div class="timeline-badge info">
                                                </div>
                                                <a class="timeline-panel text-muted" href="#">
                                                    <span>{{$response->created_at}}</span>

                                                    <p class="mb-0">
                                                        {{$response->response}}
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                                <div class="text-center">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter">Add Comment</button>
                                </div>
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
                    <h5 class="modal-title">Add comment</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.support.reply')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Comment</label>
                                <textarea class="form-control" name="content" rows="4"></textarea>
                            </div>
                            <div class="form-group col-md-12" style="display: none;">
                                <label>Id</label>
                                <input type="text" class="form-control" name="id" value="{{$ticket->id}}" >
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
