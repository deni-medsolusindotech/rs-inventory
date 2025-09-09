
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

    <body data-sidebar="dark" data-layout="horizontal"  @stack('body')  {{-- data-keep-enlarged="true" class="vertical-collpsed" --}}>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar" >
                <div class="navbar-brand-box" class="text-light" >
                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <h4 class=" ms-n2">
                            <img src="/logo-2.png" class="p-auto" alt="" height="35">
                        </h4>
                    </span>
                    <span class="logo-lg">
                      <h4 class="text-light  ">
                          <img src="/logo-2.png" class="ms-n2 p-0" height="35"> 
                        INVENTARIS
                        </h4>
                    </span>
                </a>
                </div>
            </header>

    

            

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
