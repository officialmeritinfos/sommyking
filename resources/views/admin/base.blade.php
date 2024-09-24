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
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/images/favicon.png')}}">
    <link href="{{asset('dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/froala_editor.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/froala_style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/code_view.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/draggable.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/colors.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/emoticons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/image_manager.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/image.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/line_breaker.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/table.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/char_counter.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/video.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/fullscreen.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/file.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/quick_insert.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/help.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/third_party/spell_checker.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/editors/css/plugins/special_characters.css')}}">
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
        <a href="index" class="brand-logo">
            <!--<img class="logo-abbr" src="{{asset('dashboard/images/logo.png')}}" alt="">-->
            <!--<img class="logo-compact" src="{{asset('dashboard/images/logo-text.png')}}" alt="">-->
            <!--<img class="brand-title" src="{{asset('dashboard/images/logo-text.png')}}" alt="">-->

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
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                <div class="header-info">
                                    <span class="text-black"><strong>{{$user->name}}</strong></span>
                                    <p class="fs-12 mb-0">{{$user->userRef}}</p>
                                </div>
                                @if($user->uploaded ==1)
                                    <img src="{{asset('dashboard/images/profile/17.jpg')}}" width="20" alt=""/>
                                @else
                                    <img src="https://ui-avatars.com/api/?background=random&name={{$user->name}}" width="20"/>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('admin.setting.index')}}" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="{{route('admin.logout')}}" class="dropdown-item ai-icon">
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
                <li><a href="{{route('admin.admin.dashboard')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a href="{{route('admin.investor.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Investors</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Transactions</span>
                    </a>
                    <ul aria-expanded="false">
{{--                        <li><a href="{{route('admin.deposit.index')}}">Deposits</a></li>--}}
                        <li><a href="{{route('admin.withdrawal.index')}}">Withdrawals</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-compact-disc"></i>
                        <span class="nav-text">Investments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('admin.investment.index')}}">Investment List</a></li>
                        <li><a href="{{route('admin.package.index')}}">Investment Package</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">System</span>
                    </a>
                    <ul aria-expanded="false">
{{--                        <li><a href="{{route('admin.wallet.index')}}">System Wallets</a></li>--}}
                        <li><a href="{{route('admin.wallet.index')}}">System Wallets</a></li>
                        <li><a href="{{route('admin.support.index')}}">System Tickets</a></li>
{{--                        <li><a href="{{route('admin.mail.index')}}">System Mail</a></li>--}}
                        <li><a href="{{route('admin.notify.index')}}">System Notifications</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-notepad"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('admin.setting.index')}}">Settings</a></li>
                    </ul>
                </li>
                @if($user->is_admin ==1)
                    <li><a href="{{route('user.dashboard')}}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                            <span class="nav-text">Investor View</span>
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
<script type="text/javascript" src="{{asset('dashboard/editors/js/froala_editor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/align.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/char_counter.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/code_beautifier.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/code_view.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/colors.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/draggable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/emoticons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/entities.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/file.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/font_size.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/font_family.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/fullscreen.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/image.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/image_manager.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/line_breaker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/inline_style.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/link.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/lists.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/paragraph_format.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/paragraph_style.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/quick_insert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/quote.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/table.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/save.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/url.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/help.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/print.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/third_party/spell_checker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/special_characters.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dashboard/editors/js/plugins/word_paste.min.js')}}'"></script>
<script>
    (function () {
        new FroalaEditor("#txtEditor")
    })()
</script>
<script>
    //$('.fr-wrapper div:last').css("display","none")
    $("div:contains('Unlicensed copy of the Froala Editor. Use it legally by purchasing a license.'):first").css("display","none");
</script>
</body>
</html>
