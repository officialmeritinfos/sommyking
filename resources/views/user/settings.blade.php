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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form method="POST" action="{{route('settings.update')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" placeholder="Name" class="form-control"
                                            name="name" value="{{$user->name}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email" class="form-control"
                                            name="email" value="{{$user->email}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="text" placeholder="Phone" class="form-control"
                                                   value="{{$user->phone}}" name="phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date of Birth</label>
                                            <input type="date" placeholder="Date of Birth" class="form-control"
                                            name="dob" value="{{$user->dateOfBirth}}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country"
                                            value="{{$user->country}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Two Factor Authentication</label>
                                            <select class="form-control default-select" id="inputState"
                                            name="twoWay">
                                                <option selected="">Choose...</option>
                                                @if($user->twoWay ==1)
                                                    <option value="1" selected>ON</option>
                                                    <option value="2">OFF</option>
                                                @else
                                                    <option value="1" >ON</option>
                                                    <option value="2" selected>OFF</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="settings-form">
                                <h4 class="text-primary">Password Setting</h4>
                                <form method="POST" action="{{route('password.update')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Old Password</label>
                                            <input type="password" placeholder="Old Password" class="form-control"
                                                   name="old_password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>New Password</label>
                                            <input type="password" placeholder="New Password" class="form-control"
                                                   name="new_password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Repeat New Password</label>
                                            <input type="password" placeholder="Repeat new Password" class="form-control"
                                                   name="new_password_confirmation">
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
