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
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-sm-flex d-block border-0 pb-0">
                                    <div class="mr-auto mb-sm-0 mb-3">
                                        <p class="fs-14 mb-1">ID</p>
                                        <span class="fs-34 text-black font-w600">#{{$investment->stakeRef}}</span>
                                    </div>
                                </div>
                                <div class="card-body border-bottom">
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Investment Source</p>
                                            <span class="text-black fs-18 font-w500">{{ucfirst($investment->source)}}</span> </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Date Started</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{date('F d, Y',strtotime($investment->created_at))}}
                                            </span> </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Date Ending</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{date('F d, Y',strtotime($investment->Duration,strtotime($investment->created_at)))}}
                                            </span>
                                        </div>
                                    </div>
{{--                                    <div class="p-3 bgl-dark rounded fs-14 d-flex">--}}
{{--                                        <svg class="mr-3 min-w24" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M12 1C9.82441 1 7.69767 1.64514 5.88873 2.85384C4.07979 4.06253 2.66989 5.7805 1.83733 7.79049C1.00477 9.80047 0.786929 12.0122 1.21137 14.146C1.6358 16.2798 2.68345 18.2398 4.22183 19.7782C5.76021 21.3166 7.72022 22.3642 9.85401 22.7887C11.9878 23.2131 14.1995 22.9953 16.2095 22.1627C18.2195 21.3301 19.9375 19.9202 21.1462 18.1113C22.3549 16.3023 23 14.1756 23 12C22.9966 9.08368 21.8365 6.28778 19.7744 4.22563C17.7122 2.16347 14.9163 1.00344 12 1ZM12 21C10.22 21 8.47992 20.4722 6.99987 19.4832C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49836 4.37737 6.89471 5.63604 5.63604C6.89472 4.37737 8.49836 3.5202 10.2442 3.17293C11.99 2.82567 13.7996 3.0039 15.4442 3.68509C17.0887 4.36627 18.4943 5.51983 19.4832 6.99987C20.4722 8.47991 21 10.22 21 12C20.9971 14.3861 20.0479 16.6736 18.3608 18.3608C16.6736 20.048 14.3861 20.9971 12 21Z" fill="#A4A4A4"/>--}}
{{--                                            <path d="M12 9C11.7348 9 11.4804 9.10536 11.2929 9.29289C11.1054 9.48043 11 9.73478 11 10V17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18C12.2652 18 12.5196 17.8946 12.7071 17.7071C12.8947 17.5196 13 17.2652 13 17V10C13 9.73478 12.8947 9.48043 12.7071 9.29289C12.5196 9.10536 12.2652 9 12 9Z" fill="#A4A4A4"/>--}}
{{--                                            <path d="M12 8C12.5523 8 13 7.55228 13 7C13 6.44771 12.5523 6 12 6C11.4477 6 11 6.44771 11 7C11 7.55228 11.4477 8 12 8Z" fill="#A4A4A4"/>--}}
{{--                                        </svg>--}}
{{--                                        <p class="mb-0"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur </p>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="card-body">
                                    <h4 class="fs-20 text-black font-w600 mb-4">Details</h4>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Amount</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{number_format($investment->amount,2)}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Asset</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{$investment->asset}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Current Profit</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{number_format($investment->currentProfit,2)}}
                                            </span> </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Profit Per Return</p>
                                            <span class="text-black fs-18 font-w500">
                                                ${{number_format($investment->profitPerReturn,2)}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Number Of Return</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investment->numberOfReturn}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Current Return</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investment->currentReturn}}
                                            </span>
                                        </div>

                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Roi</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{$investment->Roi}}%
                                            </span>
                                        </div>

                                    </div>
                                    <div class="d-flex flex-wrap mb-sm-2 justify-content-between">
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Return Type</p>
                                            <span class="text-black fs-18 font-w500">
                                                Every {{$investment->returnType}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Sector</p>
                                            <span class="text-black fs-18 font-w500">
                                                 {{$investment->sector}}
                                            </span>
                                        </div>
                                        <div class="pr-3 mb-3">
                                            <p class="fs-14 mb-1">Next Time of Return</p>
                                            <span class="text-black fs-18 font-w500">
                                                {{date('F d Y h:i:s a',$investment->nextReturn)}}
                                            </span>
                                        </div>
                                    </div>
                                    @if($investment->type==1)
                                        <div class="d-flex">
                                            <div class="pr-3 mb-3">
                                                <p class="fs-14 mb-1">
                                                    You are to send exactly
                                                    $<b>{{number_format($investment->amount,2)}}</b> worth of {{$investment->asset}} to
                                                    the address below <b id="address">{{$investment->wallet}}</b>. Network is {{$investment->network}}<br/>

                                                    Alternatively, scan the barcode below to copy the wallet address:<br/>

                                                </p>
                                                <br/>
                                                <p>
                                                    <button class="btn btn-sm btn-info"
                                                            data-clipboard-action="copy"
                                                            data-clipboard-target="#address">
                                                        Copy
                                                    </button>
                                                </p>
                                                <br/><br/>
                                                <p>
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$investment->wallet}}" />
                                                </p>
                                                <p>Contact support once you have made your deposit.</p>

                                            </div>
                                            <div class="card-footer border-0 text-white">

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <div>
                                        <h4 class="fs-20 text-black">Statistics</h4>
                                        <span class="fs-12">How Far your Investment has gone</span> </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <div class="bg-primary rounded text-center p-3">
                                                <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                    <span class="donut1" data-peity='{ "fill": ["rgb(255, 255, 255)",
                                                    "rgba(255, 255, 255, 0.2)"],   "innerRadius": 33, "radius": 10}'>
                                                        {{$investment->currentReturn/$investment->numberOfReturn}}
                                                    </span>
                                                    <small class="text-white">
                                                        {{(($investment->currentReturn/$investment->numberOfReturn)*100)}}%
                                                    </small>
                                                </div>
                                                <span class="fs-14 text-white d-block">
                                                    @switch($investment->status)
                                                        @case(1)
                                                        <span class="badge badge-success">Completed</span>
                                                        @break
                                                        @case(2)
                                                        <span class="badge badge-dark">Pending Deposit</span>
                                                        @break
                                                        @case(4)
                                                        <span class="badge badge-info">Ongoing</span>
                                                        @break
                                                        @default
                                                        <span class="badge badge-danger">Cancelled</span>
                                                        @break
                                                    @endswitch
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
