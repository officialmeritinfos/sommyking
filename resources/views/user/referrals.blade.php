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
        <!-- row -->
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-4 mx-auto">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body  p-4">
                            <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-money"></i>
                                    </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Referral Balance</p>
                                    <h3 class="text-white">
                                        ${{number_format($user->referral,2)}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                {{$pageName}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th class="width80"><strong>Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Username</strong></th>
                                        <th><strong>Date</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($referrals as $referral)
                                        <tr>
                                            <td><strong>{{$referral->name}}</strong></td>
                                            <td>{{$referral->email}}</td>
                                            <td>{{$referral->username}}</td>
                                            <td>{{$referral->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    {{$referrals->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6 mx-auto">
                                    <label for="inputEmail4">Referral Link</label>
                                    <input type="text" class="form-control" id="inputEmail4"
                                           value="{{route('register',['referral'=>$user->username])}}" readonly>
                                </div>
                            </div>
                            <div class="text-center">
                                <button  class="btn btn-primary copy"
                                         data-clipboard-target="#inputEmail4">copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
