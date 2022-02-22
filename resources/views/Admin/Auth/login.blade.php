<!DOCTYPE html>
<html class="loading" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Admin - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-assets/app-assets/img/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin-assets/app-assets/img/ico/favicon-32.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/switchery.min.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/themes/layout-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/app-assets/css/plugins/switchery.min.css') }}">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" href="{{ asset('admin-assets/app-assets/css/pages/authentication.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END : Head-->

<!-- BEGIN : Body-->

<body class="vertical-layout vertical-menu 1-column auth-page navbar-static layout-dark blank-page" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Login Page Starts-->
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                                    <img src="{{ asset('admin-assets/app-assets/img/gallery/login.png') }}" alt="" class="img-fluid" width="300" height="230">
                                                </div>
                                                <div class="col-lg-6 col-12 px-4 py-3">
                                                    <h4 class="mb-2 card-title">Login</h4>
                                                    <p>Welcome back, please login to your account.</p>
                                                    <form action="{{ route('admin.login') }}" id="admin_login" method="POST">
                                                        @csrf
                                                        <input type="text" class="form-control mb-2" name="email" value="{{ old('email') }}" placeholder="Please enter email">
                                                        @error('email')
                                                        <div class="error text-danger">
                                                            {{ $message }}
                                                        </div> 
                                                        
                                                        @enderror
                                                        <input type="password" class="form-control mb-2" name="password" placeholder="Please enter Password">
                                                        @error('password')
                                                        <div class="error text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror

                                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                            <a href="javascript:;"></a>
                                                            <button class="btn btn-primary" type="submit">Login</button>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="text-primary m-0">Mine Cart</h6>
                                                            <div class="login-options">
                                                                <a class="btn btn-sm btn-social-icon btn-meetup"><span class="fa fa-meetup"></span></a>
                                                                <a class="btn btn-sm btn-social-icon btn-shopping-cart"><span class="fa fa-shopping-cart"></span></a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Login Page Ends-->
                </div>
            </div>
            <!-- END : End Main Content-->
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('admin-assets/app-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/switchery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/jquery.validate.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ asset('admin-assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/notification-sidebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/customizer.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/scroll-top.min.js') }}"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN: Custom CSS-->
    <script src="{{ asset('admin-assets/app-assets/js/scripts.js') }}"></script>
    <!-- END: Custom CSS-->

    <script>
        $("#admin_login").validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            rules: {
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "The email field is required.",
                },
                password: {
                    required: "The password field is required.",
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parents("form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            }
        });
    </script>
</body>
<!-- END : Body-->

<!-- Mirrored from pixinvent.com/apex-angular-4-bootstrap-admin-template/html-demo-2/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Dec 2021 20:13:25 GMT -->

</html>