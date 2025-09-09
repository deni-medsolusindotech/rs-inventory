
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | Inventory </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->        
        <link rel="shortcut icon" href="/image/logo.png">


        <!-- owl.carousel css -->
        <link rel="stylesheet" href="/assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="/assets/libs/owl.carousel/assets/owl.theme.default.min.css">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-xl-9">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
    
                                    <div class="p-4 my-auto">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-7">
                                                <div class="text-center">
                                                    
                                                    <div class="image mb-3">
                                                        <img src="/image/logo.png" alt="" height="180" class="auth-logo-dark"> 
                                                        <img src="/logo.png" alt="" height="180" class="auth-logo-dark"> 
                                                    </div>
                                                    <h3 class="">RSUD Malangbong</h3>
                                                    {{-- <h3 class="">SMP-SMK</h3>     
                                                    <h3 class="">TINTA EMAS INDONESIA</h3>         --}}
                                                    Jl. Raya Malangbong - Ciawi, Sukamanah, Kec. Malangbong, Kabupaten Garut, Jawa Barat 44188
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <div class="flex justify-center mb-3">
                                            <img src="/logo.png" alt="" height="60" class="auth-logo-dark"> 
                                            <img src="/image/logo.png" alt="" height="60" class="auth-logo-dark"> 
                                        </div>
                                        <h2 class="">
                                            <b class="font-size-1">
                                                <u>

                                                    INVENTORY
                                                </u>
                                        </b>
                                    </h2>
                                    </div>
                                    <div class="my-auto">
                                        
                                        <div>
                                            <h5 class="text-primary">Selamat Datang !</h5>
                                        </div>
            
                                        <div class="mt-4">
                                            <form action="{{ Route('login') }} " method="POST">
                                            @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Email" type="text" id="username" name="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        {{-- <a href="auth-recoverpw-2.html" class="text-muted">Lupa Kata Sandi?</a> --}}
                                                    </div>
                                                    <label class="form-label">Kata Sandi</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" id="password" class="form-control @error('email') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Masukan kata sandi" aria-label="Password" aria-describedby="password-addon">
                                                        <button  data-show="0" data-target="password"  class="input-group-text button-show-password btn btn-light"  type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>
                        
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Masuk</button>
                                                </div>
                    
                                                
                                    

                                            </form>
                                            
                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-5 text-center">
                                        <a href="https:\\digidukun.com" target="_blank" class="text-dark mb-0">© <script>document.write(new Date().getFullYear())</script> Inventaris. Crafted with <i class="mdi mdi-heart text-danger"></i> by Digidukun.com</a>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>

        <!-- owl.carousel js -->
        <script src="/assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- auth-2-carousel init -->
        <script src="/assets/js/pages/auth-2-carousel.init.js"></script>
        
        <!-- App js -->
        <script src="/assets/js/app.js"></script>
        <script>
             $('.button-show-password').on('click', function(){
                let status = $(this).attr('data-show');
                
                if(status == 1){
                    $(this).attr('data-show',0)
                    $(this).html("<i class='mdi mdi-eye-outline'></i>")
                    $('#password').attr('type','password')
                }else{
                    $(this).html("<i class='mdi mdi-eye-off-outline'></i>")
                    $(this).attr('data-show',1)
                    $('#password').attr('type','text')
                }
            });
        </script>
    </body>
</html>
