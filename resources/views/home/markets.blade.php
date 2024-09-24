@extends('home.base')
@section('content')
    <!-- breadcrumb content begin -->
    <section class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative text-center">
                    <h1 class="mt-0 mb-1">{{$pageName}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        </ol>
                    </nav>
                    <img class="position-absolute card-decor animate-5" src="{{asset('home/img/in-avo-4-decor-1.svg')}}" alt="decor" style="top: 25%; left: 5%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-2.svg')}}" alt="decor" style="top: -22%; left: 30%;">
                    <img class="position-absolute card-decor animate-7" src="{{asset('home/img/in-avo-4-decor-3.svg')}}" alt="decor" style="top: -16%; left: 72%;">
                    <img class="position-absolute card-decor animate-6" src="{{asset('home/img/in-avo-4-decor-4.svg')}}" alt="decor" style="top: 89%; left: 94%;">
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb content end -->


    <main>
        <!-- section content begin -->
        <section class="py-5 card-style-10">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-9 mb-2 text-center">
                        <h1 class="fw-bold mb-0">Market Trends</h1>
                     </div>
                </div>
                <div class="row  mt-3 mt-md-5 gy-4 gy-md-0">
                    <div class="col-md-12 ">
                        <div class="card card-body">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div class="tradingview-widget-container__widget"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
                                    {
                                        "symbols": [
                                        [
                                            "Apple",
                                            "AAPL|1D"
                                        ],
                                        [
                                            "Google",
                                            "GOOGL|1D"
                                        ],
                                        [
                                            "Microsoft",
                                            "MSFT|1D"
                                        ]
                                    ],
                                        "chartOnly": false,
                                        "width": "100%",
                                        "height": 500,
                                        "locale": "en",
                                        "colorTheme": "light",
                                        "autosize": false,
                                        "showVolume": false,
                                        "showMA": false,
                                        "hideDateRanges": false,
                                        "hideMarketStatus": false,
                                        "hideSymbolLogo": false,
                                        "scalePosition": "right",
                                        "scaleMode": "Normal",
                                        "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
                                        "fontSize": "10",
                                        "noTimeScale": false,
                                        "valuesTracking": "1",
                                        "changeMode": "price-and-percent",
                                        "chartType": "area",
                                        "maLineColor": "#2962FF",
                                        "maLineWidth": 1,
                                        "maLength": 9,
                                        "lineWidth": 2,
                                        "lineType": 0,
                                        "dateRanges": [
                                        "1d|1",
                                        "1m|30",
                                        "3m|60",
                                        "12m|1D",
                                        "60m|1W",
                                        "all|1M"
                                    ]
                                    }
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="card card-body">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div class="tradingview-widget-container__widget"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-quotes.js" async>
                                    {
                                        "width": "100%",
                                        "height": 490,
                                        "symbolsGroups": [
                                        {
                                            "name": "Indices",
                                            "originalName": "Indices",
                                            "symbols": [
                                                {
                                                    "name": "FOREXCOM:SPXUSD",
                                                    "displayName": "S&P 500"
                                                },
                                                {
                                                    "name": "FOREXCOM:NSXUSD",
                                                    "displayName": "US 100"
                                                },
                                                {
                                                    "name": "FOREXCOM:DJI",
                                                    "displayName": "Dow 30"
                                                },
                                                {
                                                    "name": "INDEX:NKY",
                                                    "displayName": "Nikkei 225"
                                                },
                                                {
                                                    "name": "INDEX:DEU40",
                                                    "displayName": "DAX Index"
                                                },
                                                {
                                                    "name": "FOREXCOM:UKXGBP",
                                                    "displayName": "UK 100"
                                                }
                                            ]
                                        },
                                        {
                                            "name": "Futures",
                                            "originalName": "Futures",
                                            "symbols": [
                                                {
                                                    "name": "CME_MINI:ES1!",
                                                    "displayName": "S&P 500"
                                                },
                                                {
                                                    "name": "CME:6E1!",
                                                    "displayName": "Euro"
                                                },
                                                {
                                                    "name": "COMEX:GC1!",
                                                    "displayName": "Gold"
                                                },
                                                {
                                                    "name": "NYMEX:CL1!",
                                                    "displayName": "Crude Oil"
                                                },
                                                {
                                                    "name": "NYMEX:NG1!",
                                                    "displayName": "Natural Gas"
                                                },
                                                {
                                                    "name": "CBOT:ZC1!",
                                                    "displayName": "Corn"
                                                }
                                            ]
                                        },
                                        {
                                            "name": "Bonds",
                                            "originalName": "Bonds",
                                            "symbols": [
                                                {
                                                    "name": "CBOT:ZB1!",
                                                    "displayName": "T-Bond"
                                                },
                                                {
                                                    "name": "CBOT:UB1!",
                                                    "displayName": "Ultra T-Bond"
                                                },
                                                {
                                                    "name": "EUREX:FGBL1!",
                                                    "displayName": "Euro Bund"
                                                },
                                                {
                                                    "name": "EUREX:FBTP1!",
                                                    "displayName": "Euro BTP"
                                                },
                                                {
                                                    "name": "EUREX:FGBM1!",
                                                    "displayName": "Euro BOBL"
                                                }
                                            ]
                                        },
                                        {
                                            "name": "Forex",
                                            "originalName": "Forex",
                                            "symbols": [
                                                {
                                                    "name": "FX:EURUSD",
                                                    "displayName": "EUR to USD"
                                                },
                                                {
                                                    "name": "FX:GBPUSD",
                                                    "displayName": "GBP to USD"
                                                },
                                                {
                                                    "name": "FX:USDJPY",
                                                    "displayName": "USD to JPY"
                                                },
                                                {
                                                    "name": "FX:USDCHF",
                                                    "displayName": "USD to CHF"
                                                },
                                                {
                                                    "name": "FX:AUDUSD",
                                                    "displayName": "AUD to USD"
                                                },
                                                {
                                                    "name": "FX:USDCAD",
                                                    "displayName": "USD to CAD"
                                                }
                                            ]
                                        }
                                    ],
                                        "showSymbolLogo": true,
                                        "colorTheme": "light",
                                        "isTransparent": false,
                                        "locale": "en"
                                    }
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="card card-body">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div id="tradingview_25bfa"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                    new TradingView.widget(
                                        {
                                            "autosize": false,
                                            "width":"100%",
                                            "height":490,
                                            "symbol": "NASDAQ:AAPL",
                                            "interval": "D",
                                            "timezone": "Etc/UTC",
                                            "theme": "light",
                                            "style": "1",
                                            "locale": "en",
                                            "toolbar_bg": "#f1f3f6",
                                            "enable_publishing": false,
                                            "allow_symbol_change": true,
                                            "container_id": "tradingview_25bfa"
                                        }
                                    );
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- section content end -->


@endsection
