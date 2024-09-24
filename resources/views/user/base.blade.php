<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="79J8KxfxbQnrCXtJAE6OvHcHGngqRAPKSZTqOLKd">
    <title>{{$pageName}} | {{$siteName}}</title>

    <meta name="description" content="Some description for the page"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('home/images/'.$web->logo)}}">
    <link href="{{asset('dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css"/>
</head>

<body>

<!--*******************
    Preloader start
********************-->
<!--<div id="preloader">-->
<!--    <div class="sk-three-bounce">-->
<!--        <div class="sk-child sk-bounce1"></div>-->
<!--        <div class="sk-child sk-bounce2"></div>-->
<!--        <div class="sk-child sk-bounce3"></div>-->
<!--    </div>-->
<!--</div>-->
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{url('account/dashboard')}}" class="brand-logo">
            <img class="logo-compact" src="{{asset('home/images/'.$web->logo)}}" alt="">
            <img class="brand-title" src="{{asset('home/images/'.$web->logo)}}" alt="">

        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->


    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">

                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6001 4.3008V1.4C12.6001 0.627199 13.2273 0 14.0001 0C14.7715 0 15.4001 0.627199 15.4001 1.4V4.3008C17.4805 4.6004 19.4251 5.56639 20.9287 7.06999C22.7669 8.90819 23.8001 11.4016 23.8001 14V19.2696L24.9327 21.5348C25.4745 22.6198 25.4171 23.9078 24.7787 24.9396C24.1417 25.9714 23.0147 26.6 21.8023 26.6H15.4001C15.4001 27.3728 14.7715 28 14.0001 28C13.2273 28 12.6001 27.3728 12.6001 26.6H6.19791C4.98411 26.6 3.85714 25.9714 3.22014 24.9396C2.58174 23.9078 2.52433 22.6198 3.06753 21.5348L4.20011 19.2696V14C4.20011 11.4016 5.23194 8.90819 7.07013 7.06999C8.57513 5.56639 10.5183 4.6004 12.6001 4.3008ZM14.0001 6.99998C12.1423 6.99998 10.3629 7.73779 9.04973 9.05099C7.73653 10.3628 7.00011 12.1436 7.00011 14V19.6C7.00011 19.817 6.94833 20.0312 6.85173 20.2258C6.85173 20.2258 6.22871 21.4718 5.57072 22.7864C5.46292 23.0034 5.47412 23.2624 5.60152 23.4682C5.72892 23.674 5.95431 23.8 6.19791 23.8H21.8023C22.0445 23.8 22.2699 23.674 22.3973 23.4682C22.5247 23.2624 22.5359 23.0034 22.4281 22.7864C21.7701 21.4718 21.1471 20.2258 21.1471 20.2258C21.0505 20.0312 21.0001 19.817 21.0001 19.6V14C21.0001 12.1436 20.2623 10.3628 18.9491 9.05099C17.6359 7.73779 15.8565 6.99998 14.0001 6.99998Z" fill="#3E4954"/>
                                </svg>
                                <span class="badge light text-white bg-primary rounded-circle">12</span>
                            </a>
{{--                            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">--}}
{{--                                    <ul class="timeline">--}}

{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media mr-2">--}}
{{--                                                    <img alt="image" width="50" src="{{asset('dashboard/images/avatar/1.jpg')}}">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Dr sultads Send you Photo</h6>--}}
{{--                                                    <small class="d-block">29 July 2020 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>--}}
{{--                            </div>--}}
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                <div class="header-info">
                                    <span class="text-black"><strong>{{$user->name}}</strong></span>
                                    <p class="fs-12 mb-0">{{$user->userRef}}</p>
                                </div>
                                @if($user->uploaded ==1)
                                    <img src="{{asset('dashboard/images/profile/17.jpg')}}" width="20" alt=""/>
                                @else
                                    <img src="https://ui-avatars.com/api/?background=random&name={{$user->name}}"
                                         width="20"/>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('setting.index')}}" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="{{route('logout')}}" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <!--**********************************
Sidebar start
***********************************-->
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li><a href="{{route('user.dashboard')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a href="{{route('user.account')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Account</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Transactions</span>
                    </a>
                    <ul aria-expanded="false">
{{--                        <li><a href="{{route('deposit.index')}}">Deposits</a></li>--}}
{{--                        <li><a href="{{route('new_deposit')}}">New Deposit</a></li>--}}
                        <li><a href="{{route('withdrawal.index')}}">Withdrawals</a></li>
                        <li><a data-toggle="modal"
                               data-target="#new_withdrawal">New Withdrawal</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-compact-disc"></i>
                        <span class="nav-text">Investments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('investment.index')}}">Investment List</a></li>
                        <li><a href="{{route('new_investment')}}">New Investment</a></li>
                    </ul>
                </li>
{{--                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">--}}
{{--                        <i class="flaticon-381-controls-3"></i>--}}
{{--                        <span class="nav-text">Support</span>--}}
{{--                    </a>--}}
{{--                    <ul aria-expanded="false">--}}
{{--                        <li><a href="{{route('support.index')}}">New Ticket</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-notepad"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('setting.index')}}">Settings</a></li>
{{--                        <li><a href="{{route('setting.kyc')}}">KYC</a></li>--}}
                        <li><a href="{{route('referral.index')}}">Referrals</a></li>

                        <li><a href="{{route('support.index')}}">Support Ticket</a></li>
                    </ul>
                </li>
                @if($user->is_admin ==1)
                    <li><a href="{{route('admin.admin.dashboard')}}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                            <span class="nav-text">Admin View</span>
                        </a>
                    </li>
                @endif
                <li><a href="{{route('logout')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-exit-2"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>

            <div class="copyright">
                <p></p>
            </div>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->        <!--**********************************
            Sidebar end
        ***********************************-->

    @yield('content')

    <!-- Modal -->
    @inject('option','App\Custom\Regular')
    <div class="modal fade" id="new_withdrawal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Withdrawal</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('withdraw.new')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control" name="wallet">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Account</label>
                                <select id="inputState" class="form-control default-select"
                                        name="account">
                                    <option value="">Choose...</option>
                                    <option value="1">Profit Balance</option>
                                    <option value="2">Referral Balance</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Asset</label>
                                <select id="inputState" class="form-control default-select"
                                        name="asset">
                                    <option value="">Choose...</option>
                                    @foreach($option->supportedCoins() as $coin)
                                        <option value="{{$coin->asset}}">{{$coin->coin}}({{$coin->network}}) </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Withdraw</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Footer start
    ***********************************-->

    <!--**********************************
Footer start
***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>
                Copyright © {{$siteName}} {{date('Y')}}
            </p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('dashboard/vendor/global/global.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/chart.js/Chart.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/owl-carousel/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/peity/jquery.peity.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/apexchart/apexchart.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/dashboard/dashboard-1.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/vendor/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/plugins-init/datatables.init.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/deznav-init.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>
    new ClipboardJS('.btn');
</script>
<!--Start of Tawk.to Script-->
// <script type="text/javascript">
// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
// (function(){
// var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
// s1.async=true;
// s1.src='https://embed.tawk.to/636eadccdaff0e1306d6fb8e/1ghk5dq7s';
// s1.charset='UTF-8';
// s1.setAttribute('crossorigin','*');
// s0.parentNode.insertBefore(s1,s0);
// })();
// </script>
<!--End of Tawk.to Script-->
<!-- Google language start -->
<style>

    #google_translate_element {
        z-index: 9999999;
        position: fixed;
        bottom: 25px;
        left: 15px;
    }

    .goog-te-gadget {
        font-family: Roboto, "Open Sans", sans-serif !important;
        text-transform: uppercase;
    }
    .goog-te-gadget-simple
    {
        padding: 0px !important;
        line-height: 1.428571429;
        color: white;
        vertical-align: middle;
        background-color: black;
        border: 1px solid #a5a5a599;
        border-radius: 4px;
        float: right;
        margin-top: -4px;
        z-index: 999999;
    }
    .goog-te-banner-frame.skiptranslate
    {
        display: none !important;
        color: white;
    }
    .goog-te-gadget-icon
    {
        background: none !important;
        display: none;
        color: white;
    }
    .goog-te-gadget-simple .goog-te-menu-value
    {
        font-size: 12px;
        color: white;
        font-family: 'Open Sans' , sans-serif;
    }
</style>
<div id="google_translate_element">
</div>
<script type="text/javascript">
    window.onload = function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Google language End -->
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '401b08dc1e2a20b0db7eaba1e0b60f358f70f8ca';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

</body>
</html>
