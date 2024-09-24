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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('templates.notification')
                        <div class="settings-form">
                            <h4 class="text-primary"></h4>
                            <form method="POST" action="{{route('admin.package.new')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" class="form-control"
                                               name="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Minimum Amount</label>
                                        <input type="number" class="form-control"
                                               name="minAmount">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Maximum Amount</label>
                                        <input type="number"  class="form-control"
                                               name="maxAmount">
                                        <small>Leave empty if you want it to be unlimited</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>ROI</label>
                                        <input type="text" placeholder="Roi" class="form-control" name="roi">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Duration</label>
                                        <input type="text" class="form-control" name="duration">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Number of Returns</label>
                                        <input type="text" class="form-control" name="numberOfReturns">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Return Type</label>
                                        <select class="form-control default-select" id="inputState"
                                                name="returnType">
                                            <option value="24 Hours">Daily</option>
                                            <option value="48 Hours">2 Days</option>
                                            <option value="72 Hours">3 Days</option>
                                            <option value="4 Days">4 Days</option>
                                            <option value="5 Days">5 Days</option>
                                            <option value="7 Days">Weekly</option>
                                            <option value="14 Days">Fortnightly</option>
                                            <option value="3 months">Quarterly</option>
                                            <option value="1 month">Monthly</option>
                                            <option value="6 months">Bi-annally</option>
                                            <option value="12 months">Annually</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select class="form-control default-select" id="inputState"
                                                name="status">
                                            <option value="">Select Option</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Is a Bonus Package</label>
                                        <select class="form-control default-select" id="inputState"
                                                name="isBonus">
                                            <option value="">Select Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
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


    </div>

@endsection
