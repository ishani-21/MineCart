<!DOCTYPE html>

<html class="loading" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('saller-assets/app-assets/img/ico/letter-s.jpg') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/chartist.min.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/themes/layout-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/plugins/switchery.min.css') }}">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/pages/dashboard1.min.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/assets/css/style.css') }}"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
    <style>
        .error {
            color: red;
        }

        .errorMsg {
            border: 1px solid red;
        }

        .is-invalid {
            border: red 3px solid !important;
        }

        .validation {
            color: red;
        }
    </style>
    <!-- END: Custom CSS-->
</head>
<!-- END : Head-->

<!-- BEGIN : Body-->

<body class="vertical-layout vertical-menu 2-columns  navbar-sticky" data-menu="vertical-menu" data-col="2-columns">

    @include('Seller.layouts.navbar')
    <!-- Navbar (Header) Ends-->

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


        <!-- main menu-->
        <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
        {{-- sidebar start --}}
        @include('Seller.layouts.sidebar')
        {{-- sidebar end --}}

        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">

                @yield('content')
            </div> <!-- END : End Main Content-->

            <!-- BEGIN : Footer-->
            <!-- End : Footer-->
            <!-- Scroll to top button -->
            <!-- <button class="btn btn-primary scroll-top" type="button"><i class="ft-arrow-up"></i></button> -->
        </div>
        @include('Seller.layouts.footer')
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- START Notification Sidebar-->
    {{-- @include('Seller.layouts.sidenotification') --}}
    <div class="buy-now">
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->

    <script src="{{ asset('saller-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- ---------------------------------------------datatable------------------------------ -->
    <script src="{{ asset('saller-assets/app-assets/vendors/js/switchery.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/vendors/js/chartist.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/notification-sidebar.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/customizer.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/scroll-top.min.js') }}"></script>
    <!-- <script src="{{ asset('saller-assets/app-assets/js/scripts.js') }}"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->

    <!-- ---------------------------------------------datatable------------------------------ -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
    </script>  -->
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- ---------------------------------------------jquery------------------------------ -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    @stack('js')
    <!-- END: Custom CSS-->
</body>

</html>
