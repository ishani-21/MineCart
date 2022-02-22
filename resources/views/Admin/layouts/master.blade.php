<!DOCTYPE html>
<!--
Template Name: Apex - Bootstrap 4 Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/apex_admin
Renew Support: https://1.envato.market/apex_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en">
<!-- BEGIN : Head-->

<!-- Mirrored from pixinvent.com/apex-angular-4-bootstrap-admin-template/html-demo-2/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Dec 2021 20:08:11 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content={{csrf_token()}}>

    <title>Admin - @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-assets/app-assets/img/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin-assets/app-assets/img/ico/favicon-32.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/themes/layout-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/app-assets/css/plugins/switchery.min.css') }}">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/pages/dashboard1.min.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    
    <!-- END: Custom CSS-->

    <!-- datatable -->
    <link href="{{ asset('admin-assets/app-assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/app-assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/app-assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin-assets/app-assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/select2.min.css')}}">

    @stack('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/style.css') }}">



    
</head>

<body class="vertical-layout vertical-menu 2-columns  navbar-static layout-dark" data-menu="vertical-menu" data-col="2-columns">

    @include('Admin.layouts.navbar')
    <!-- Navbar (Header) Ends-->

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


        <!-- main menu-->
        <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
        @include('Admin.layouts.sidebar')

        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END : End Main Content-->

            <!-- BEGIN : Footer-->
            @include('Admin.layouts.footer')
            <!-- End : Footer-->
            <!-- Scroll to top button -->
            <button class="btn btn-primary scroll-top" type="button"><i class="ft-arrow-up"></i></button>

        </div>
    </div>
    @yield('modal')
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- START Notification Sidebar-->
    @include('Admin.layouts.sidenotification')
    <!-- END Notification Sidebar-->
    <!-- Theme customizer Starts-->
    <div class="customizer d-none d-lg-none d-xl-block"><a class="customizer-close"><i class="ft-x font-medium-3"></i></a>
        <!-- <a class="customizer-toggle bg-primary" id="customizer-toggle-icon"><i class="ft-settings font-medium-1 spinner white align-middle"></i></a> -->
        <div class="customizer-content p-3 ps-container ps-theme-dark" data-ps-id="df6a5ce4-a175-9172-4402-dabd98fc9c0a">
            <h4 class="text-uppercase">Theme Customizer</h4>
            <p>Customize & Preview in Real Time</p>
            <!-- Layout Options Starts-->
            <div class="ct-layout">
                <hr>
                <h6 class="mb-3 d-flex align-items-center"><i class="ft-layout font-medium-2 mr-2"></i><span>Layout
                        Options</span></h6>
                <div class="layout-switch">
                    <div class="radio radio-sm d-inline-block light-layout mr-3">
                        <input id="ll-switch" type="radio" name="layout-switch" checked>
                        <label for="ll-switch">Light</label>
                    </div>
                    <div class="radio radio-sm d-inline-block dark-layout mr-3">
                        <input id="dl-switch" type="radio" name="layout-switch">
                        <label for="dl-switch">Dark</label>
                    </div>
                    <div class="radio radio-sm d-inline-block transparent-layout">
                        <input id="tl-switch" type="radio" name="layout-switch">
                        <label for="tl-switch">Transparent</label>
                    </div>
                </div>
                <!-- Layout Options Ends-->
            </div>
            <!-- Navbar Types-->
            <div class="ct-navbar-type">
                <hr>
                <h6 class="mb-3 d-flex align-items-center"><i class="ft-more-horizontal- font-medium-2 mr-2"></i><span>Navbar Type</span></h6>
                <div class="navbar-switch">
                    <div class="radio radio-sm d-inline-block nav-static mr-3">
                        <input id="nav-static" type="radio" name="navbar-switch" checked="checked">
                        <label for="nav-static">Static</label>
                    </div>
                    <div class="radio radio-sm d-inline-block nav-fixed">
                        <input id="nav-fixed" type="radio" name="navbar-switch">
                        <label for="nav-fixed">Fixed</label>
                    </div>
                </div>
            </div>
            <!-- Sidebar Options Starts-->
            <div class="ct-bg-color">
                <hr>
                <h6 class="sb-options d-flex align-items-center mb-3"><i class="ft-droplet font-medium-2 mr-2"></i><span>Sidebar Color Options</span></h6>
                <div class="cz-bg-color sb-color-options">
                    <div class="row mb-3">
                        <div class="col px-2"><span class="gradient-mint d-block rounded" style="width:30px; height:30px;" data-bg-color="mint"></span></div>
                        <div class="col px-2"><span class="gradient-king-yna d-block rounded" style="width:30px; height:30px;" data-bg-color="king-yna"></span></div>
                        <div class="col px-2"><span class="gradient-ibiza-sunset d-block rounded" style="width:30px; height:30px;" data-bg-color="ibiza-sunset"></span></div>
                        <div class="col px-2"><span class="gradient-flickr d-block rounded" style="width:30px; height:30px;" data-bg-color="flickr"></span></div>
                        <div class="col px-2"><span class="gradient-purple-bliss d-block rounded" style="width:30px; height:30px;" data-bg-color="purple-bliss"></span></div>
                        <div class="col px-2"><span class="gradient-man-of-steel d-block rounded" style="width:30px; height:30px;" data-bg-color="man-of-steel"></span></div>
                        <div class="col px-2"><span class="gradient-purple-love d-block rounded" style="width:30px; height:30px;" data-bg-color="purple-love"></span></div>
                    </div>
                    <div class="row">
                        <div class="col px-2"><span class="bg-black d-block rounded" style="width:30px; height:30px;" data-bg-color="black"></span></div>
                        <div class="col px-2"><span class="bg-grey bg-lighten-3 d-block rounded" style="width:30px; height:30px;" data-bg-color="white"></span></div>
                        <div class="col px-2"><span class="bg-primary bg-darken-1 d-block rounded" style="width:30px; height:30px;" data-bg-color="primary"></span></div>
                        <div class="col px-2"><span class="bg-success bg-darken-1 d-block rounded" style="width:30px; height:30px;" data-bg-color="success"></span></div>
                        <div class="col px-2"><span class="bg-warning bg-darken-1 d-block rounded" style="width:30px; height:30px;" data-bg-color="warning"></span></div>
                        <div class="col px-2"><span class="bg-info bg-darken-1 d-block rounded" style="width:30px; height:30px;" data-bg-color="info"></span></div>
                        <div class="col px-2"><span class="bg-danger bg-darken-1 d-block rounded" style="width:30px; height:30px;" data-bg-color="danger"></span></div>
                    </div>
                </div>
                <!-- Sidebar Options Ends-->
                <!-- Transparent BG Image Ends-->
                <div class="tl-bg-img">
                    <h6 class="d-flex align-items-center mb-3"><i class="ft-star font-medium-2 mr-2"></i><span>Background Colors with Shades</span></h6>
                    <div class="cz-tl-bg-image row">
                        <div class="col-sm-3">
                            <div class="rounded bg-glass-1 ct-glass-bg" data-bg-image="bg-glass-1"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="rounded bg-glass-2 ct-glass-bg" data-bg-image="bg-glass-2"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="rounded bg-glass-3 ct-glass-bg" data-bg-image="bg-glass-3"></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="rounded bg-glass-4 ct-glass-bg" data-bg-image="bg-glass-4"></div>
                        </div>
                    </div>
                </div>
                <!-- Transparent BG Image Ends-->
            </div>
            <!-- Sidebar BG Image Starts-->
            <div class="ct-bg-image">
                <hr>
                <h6 class="sb-bg-img d-flex align-items-center mb-3"><i class="ft-sidebar font-medium-2 mr-2"></i><span>Sidebar Bg Image</span></h6>
                <div class="cz-bg-image row sb-bg-img">
                    <div class="col-2 px-2"><img class="rounded sb-bg-01" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/01.jpg') }}" alt="sidebar bg image" width="90"></div>
                    <div class="col-2 px-2"><img class="rounded sb-bg-02" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/02.jpg') }}" alt="sidebar bg image" width="90"></div>
                    <div class="col-2 px-2"><img class="rounded sb-bg-03" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/03.jpg') }}" alt="sidebar bg image" width="90"></div>
                    <div class="col-2 px-2"><img class="rounded sb-bg-04" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/04.jpg') }}" alt="sidebar bg image" width="90"></div>
                    <div class="col-2 px-2"><img class="rounded sb-bg-05" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/05.jpg') }}" alt="sidebar bg image" width="90"></div>
                    <div class="col-2 px-2"><img class="rounded sb-bg-06" src="{{ asset('admin-assets/app-assets/img/sidebar-bg/06.jpg') }}" alt="sidebar bg image" width="90"></div>
                </div>
                <!-- Transparent Layout Bg color Options-->
                <div class="tl-color-option">
                    <h6 class="tl-color-options d-flex align-items-center mb-3"><i class="ft-droplet font-medium-2 mr-2"></i><span>Background Colors</span></h6>
                    <div class="cz-tl-bg-color">
                        <div class="row">
                            <div class="col"><span class="bg-glass-hibiscus d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-hibiscus"></span></div>
                            <div class="col"><span class="bg-glass-purple-pizzazz d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-purple-pizzazz"></span>
                            </div>
                            <div class="col"><span class="bg-glass-blue-lagoon d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-blue-lagoon"></span></div>
                            <div class="col"><span class="bg-glass-electric-violet d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-electric-violet"></span>
                            </div>
                            <div class="col"><span class="bg-glass-portage d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-portage"></span></div>
                            <div class="col"><span class="bg-glass-tundora d-block rounded ct-color-bg" style="width:30px; height:30px;" data-bg-color="bg-glass-tundora"></span></div>
                        </div>
                    </div>
                </div>
                <!-- Transparent Layout Bg color Ends-->
            </div>
            <!-- Sidebar BG Image Toggle Starts-->
            <div class="ct-bg-image-toggler">
                <div class="togglebutton toggle-sb-bg-img">
                    <hr>
                    <div class="switch"><span>Sidebar Bg Image</span>
                        <div class="float-right">
                            <div class="checkbox">
                                <input class="cz-bg-image-display" id="sidebar-bg-img" type="checkbox" checked>
                                <label for="sidebar-bg-img"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar BG Image Toggle Ends-->
            <!-- Compact Menu Starts-->
            <div class="ct-compact-toggler">
                <hr>
                <div class="togglebutton">
                    <div class="switch"><span>Compact Menu</span>
                        <div class="float-right">
                            <div class="checkbox">
                                <input class="cz-compact-menu" id="cz-compact-menu" type="checkbox">
                                <label for="cz-compact-menu"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Compact Menu Ends-->
            </div>
            <!-- Sidebar Width Starts-->
            <div class="ct-sidebar-size">
                <hr>
                <p>Sidebar Width</p>
                <div class="cz-sidebar-width btn-group btn-group-toggle" id="cz-sidebar-width" data-toggle="buttons">
                    <label class="btn btn-outline-primary">
                        <input id="cz-btn-radio-1" type="radio" name="cz-btn-radio" value="small"><span>Small</span>
                    </label>
                    <label class="btn btn-outline-primary active">
                        <input id="cz-btn-radio-2" type="radio" name="cz-btn-radio" value="medium" checked><span>Medium</span>
                    </label>
                    <label class="btn btn-outline-primary">
                        <input id="cz-btn-radio-3" type="radio" name="cz-btn-radio" value="large"><span>Large</span>
                    </label>
                </div>
            </div>
            <!-- Sidebar Width Ends-->
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN VENDOR JS-->

    <!-- <script src="{{ asset('admin-assets/app-assets/js/jquery.min.js') }}"></script> -->
    <script src="{{ asset('admin-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/switchery.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('admin-assets/app-assets/vendors/js/chartist.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <!-- <script src="{{ asset('admin-assets/app-assets/js/app.js') }}"></script> -->
    <script src="{{ asset('admin-assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/notification-sidebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/customizer.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/scroll-top.min.js') }}"></script>
    <!-- END APEX JS-->

    <!-- BEGIN: Custom CSS-->
    <script src="{{ asset('admin-assets/app-assets/js/scripts.js') }}"></script>
    <!-- END: Custom CSS-->

    <!--Data Table-->
    <script src="{{ asset('admin-assets/app-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('admin-assets/app-assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/pages/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/select2.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/plugins/tinymce/tinymce.min.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            // $('form').parsley();
        });
        $(".sidebar-toggler").click(function() {
            $("#sidebar").toggleClass("active");
        });
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
        $(document).ready(function() {
            if ($("#answer").length > 0) {
                tinymce.init({
                    selector: "textarea#answer",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                });
            }
        });
        $('#select_all').on('click', function() {
            if ($('.select_row').is(':checked')) {
                $('input[type="checkbox"]').prop('checked', false);
            } else {
                $('input[type="checkbox"]').prop('checked', true);
            }
        });
    </script>
    @stack('scripts')

</body>
<!-- END : Body-->

<!-- Mirrored from pixinvent.com/apex-angular-4-bootstrap-admin-template/html-demo-2/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Dec 2021 20:08:30 GMT -->

</html>
