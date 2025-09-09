
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title> {{ $title ?? 'Dashboard' }} | Inventaris</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/logo-2.png">

        @stack('style')
        
        <!-- Sweet Alert-->
        <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            .rtc{
                border-radius: 10px;
                padding-top: 10px;
                box-shadow: 0px -4px 6px rgba(0, 0, 0, 0.3);
            }
        </style>
        <script src="{{ asset('js/app.js') }}"></script>
        @livewireStyles()
        @livewireScripts()
       

        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <!-- Sweet Alerts js -->
        <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!-- Sweet alert init js-->
        <script>


            var isRefresh = true;

            document.addEventListener("turbolinks:before-visit", function() {
                Turbolinks.clearCache();
                isRefresh = false; // Setel isRefresh ke false saat navigasi link terjadi
            });


        </script>
        <script>
            var activeUrl = '';
           $(document).ready(function() {
            // Ambil URL saat ini
            var currentUrl = window.location.href;

            // Loop melalui setiap tautan di navigasi
            $('li a').each(function() {
                var linkUrl = $(this).attr('href');

                // Bandingkan URL saat ini dengan URL tautan
                if (currentUrl.indexOf(linkUrl) !== -1) {
                    // Tambahkan kelas 'active' ke tautan yang sesuai
                    $(this).addClass('active');
                    activeUrl = $(this).attr('href');
                }
            });
        });
            
        </script>

<script>
    $('a.waves-effect[href="'+activeUrl+'"]').addClass('active');
</script>

{{-- alert component --}}
@include('components.alert')
@stack('script')
<script id="appjs" src="/assets/js/app.js"></script>
        
    </head>

    <body data-sidebar="dark"  @stack('body')  {{-- data-keep-enlarged="true" class="vertical-collpsed" --}}>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar" >
                <div class="navbar-header" >
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" class="text-light" >
                         
                            <a href="/dashboard" class="logo logo-light">
                                <span class="logo-sm">
                                    <h4 class="mt-4 ms-n2">
                                        <img src="/logo.png" class="p-auto" alt="" height="35">
                                    </h4>
                                </span>
                                <span class="logo-lg">
                                  <h4 class="text-light mt-4 ">
                                      <img src="/logo-2.png" class="ms-n2 p-0" height="35"> 
                                      <img src="/logo.png" class="ms-n2 p-0" height="35"> 
                                    INVENTARIS
                                    </h4>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    

                       
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                @if(auth()->user()->notifikasi->where('read',false)->count())
                                    <span class="badge bg-danger rounded-pill">{{ auth()->user()->notifikasi->where('read',false)->count() }}</span>
                                @endif
                            </button>
                            @if(auth()->user()->notifikasi->where('show',false)->count())
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifikasi </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="/feedback?page=notifikasi" key="t-view-all"> Lihat Semua</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 430px;">
                                @forelse(auth()->user()->notifikasi->where('read',false) as $notif)
                                    <a href="/feedback/?page=notifikasi&&messageid={{ $notif->id }}" class="text-reset notification-item" style="hover:cursor;">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-{{ $notif->color }} rounded-circle font-size-16">
                                                    <i class="{{ $notif->icon }}"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-your-order">{{ str($notif->judul)->limit(35) }}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">{{ str($notif->pesan)->limit(30)  }}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{ $notif->waktu }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                <div class="text-muted text-center" style="min-height:100px;">
                                    <h5 class="mt-5">Belum Ada Notifikasi</h5>
                                </div>
                                @endforelse
                                </div>
                                @endif
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="/assets/{{ auth()->user()->avatar }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="/profile/edit"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Edit Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" id="logout" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" style="cursor:pointer;" onclick="$('#logout').submit()"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu" >

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    @include('layouts.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            
            {{-- 003708
            58bb44 --}}
            <div class="main-content"  style="background: linear-gradient(to bottom, #32394e 200px, transparent 50px ); /* " >

                <div class="page-content">
                    <div class="container-fluid" >

                        <div class="p-0">
                        <!-- start page title -->
                        <div class="">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between  text-light">
                                    @php if(!isset($title)): $title = 'Dashboard'; endif; @endphp
                                    <h4 class="mb-sm-0 font-size-18 text-light text-center"> <i class="bx bx-{{ $icon ?? 'home' }}"></i> {{ $subtitle ?? $title }}</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item text-light"><a href="javascript: void(0);" class="text-light">{{ (isset($subtitle)) ? $title.' > '. ($subtitle ?? '') : ''}}</a></li>
                                        </ol>
                                    </div>

                                </div>
                        </div>
                        <!-- end page title -->
                           <div>
                               {{ $slot }}
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                2023 © INVENTARIS.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Digidukun.com
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
    @stack('script-bottom')
  
    </body>
</html>
