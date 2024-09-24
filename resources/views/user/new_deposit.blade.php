@extends('user.base')
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
            @foreach($wallets as $wallet)
                <div class="col-xl-6 mx-auto">
                    <div class="card text-white bg-blue-dark" style="font-size:14px;">
                        <div class="card-header">
                            <h5 class="card-title text-white">{{$wallet->coin}}({{$wallet->network}}) Deposit Address</h5>
                        </div>
                        <div class="card-body mb-0">
                            <p class="card-text text-center">
                                You can now easily fund your account by using your unique {{$wallet->asset}}({{$wallet->network}})
                                address. Once you make your deposit, please notify support for account crediting.
                            </p>
                            <div class="basic-form">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm text-center"
                                    value="{{$wallet->address}}" readonly style="font-size: 16px;"
                                           id="address{{$wallet->id}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-white">
                            <button class="btn btn-sm btn-info"
                                    data-clipboard-action="copy"
                                    data-clipboard-target="#address{{$wallet->id}}">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!--**********************************
        Content body end
    ***********************************-->


@endsection
