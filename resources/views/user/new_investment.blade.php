@extends('user.base')
@section('content')
    <style>
        .card-header:first-child {
            border-radius: .25rem .25rem 0 0;
        }
        .p-3 {
            padding: 1rem!important;
        }
        .align-items-start {
            align-items: flex-start!important;
        }
        .flex-column {
            flex-direction: column!important;
        }
        .border-bottom {
            border-bottom: 1px solid #cbd5e0!important;
        }
        .card-footer, .card-header {
            display: flex;
            align-items: center;
        }
        .card-header {
            padding: .5rem 1rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 0 solid rgba(0,0,0,.125);
        }
        .card-footer:last-child {
            border-radius: 0 0 .25rem .25rem;
        }
        .h3, h3 {
            font-size: 1.75rem;
        }
        .p-3 {
            padding: 1rem!important;
        }
        .justify-content-center {
            justify-content: center!important;
        }
        .card-footer, .card-header {
            display: flex;
            align-items: center;
        }
        .card-footer {
            padding: .5rem 1rem;
            background-color: #fff;
            border-top: 0 solid rgba(0,0,0,.125);
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
    </style>
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

            <div class="row gutters-sm">
                @foreach($packages as $package)
                    <div class="col-sm-6 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-header border-bottom flex-column  p-3 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-box text-secondary h3 stroke-width-1 mb-2">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2
                                    2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                                <h4 class="text-secondary font-weight-light mb-2">{{$package->name}}</h4>
                                <p class="font-size-sm mb-0">
                                    {{$package->note}}
                                </p>
                            </div>
                            <div class="card-header border-bottom justify-content-center py-4">
                                <h1 class="pricing-price">
                                    <small class="align-self-start"></small>
                                    {{$package->Roi}}%
                                    <small class="align-self-end">/{{$package->returnType}}</small>
                                </h1>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled font-size-sm mb-0">
                                    <p>
                                        <i class="fa fa-check text-success"></i>
                                        <b>Minimum Amount:</b> ${{$package->minAmount}}
                                    </p>

                                    <p>
                                        <i class="fa fa-check text-success"></i>
                                        <b>Maximum Amount:</b>
                                        @if($package->unlimited ==1)
                                            Unlimited
                                        @else
                                            ${{$package->maxAmount}}
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-check text-success"></i>
                                        <b>Duration:</b> {{$package->Duration}}
                                    </p>
                                    <p>
                                        <i class="fa fa-check text-success"></i>
                                        <b>Cummumlative Return:</b> {{$package->Roi*$package->numberOfReturn}}%
                                    </p>
                                </ul>
                            </div>
                            <div class="card-footer justify-content-center p-3">
                                <a href="{{route('new_investment_preview',['id'=>$package->id])}}"
                                   class="btn btn-outline-secondary">SUBSCRIBE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($user->hasBonus==1)
                    @foreach($bonusPackages as $package)
                        <div class="col-sm-6 col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header border-bottom flex-column  p-3 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-box text-secondary h3 stroke-width-1 mb-2">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2
                                    2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                    <h4 class="text-secondary font-weight-light mb-2">{{$package->name}}</h4>
                                    <p class="font-size-sm mb-0">
                                        {{$package->note}}
                                    </p>
                                </div>
                                <div class="card-header border-bottom justify-content-center py-4">
                                    <h1 class="pricing-price">
                                        <small class="align-self-start"></small>
                                        {{$package->Roi}}%
                                        <small class="align-self-end">/{{$package->returnType}}</small>
                                    </h1>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled font-size-sm mb-0">
                                        <p>
                                            <i class="fa fa-check text-success"></i>
                                            <b>Minimum Amount:</b> ${{$package->minAmount}}
                                        </p>

                                        <p>
                                            <i class="fa fa-check text-success"></i>
                                            <b>Maximum Amount:</b>
                                            @if($package->unlimited ==1)
                                                Unlimited
                                            @else
                                                ${{$package->maxAmount}}
                                            @endif
                                        </p>
                                        <p>
                                            <i class="fa fa-check text-success"></i>
                                            <b>Duration:</b> {{$package->Duration}}
                                        </p>
                                        <p>
                                            <i class="fa fa-check text-success"></i>
                                            <b>Cummumlative Return:</b> {{$package->Roi*$package->numberOfReturn}}%
                                        </p>
                                    </ul>
                                </div>
                                <div class="card-footer justify-content-center p-3">
                                    <a href="{{route('new_investment_preview',['id'=>$package->id])}}"
                                       class="btn btn-outline-secondary">SUBSCRIBE</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
            </div>

        </div>
    </div>

@endsection
