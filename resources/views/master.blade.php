<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">

    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/dist/css/dropify.min.css')}}">

    <link rel="stylesheet" href="{{asset('js/dist/css/qrcode-reader.min.css')}}">

    <link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

</head>

<body class="fix-header fix-sidebar card-no-border logo-center">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar bg-coffee">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                            <img src="{{asset('assets/images/teashop.jpg')}}" class="border border-radius rounded" alt="" width="50px" height="40px">
                            <h2 class="text-white font-weight-bold font-italic ml-2">COZY OASIS</h2>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center" id="noti">
                                            <!-- Message -->
                                            

                                            

                                           
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a href="{{ url()->previous() }}" class="nav-link waves-effect waves-dark pt-2"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">

            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="{{url('/')}}">
                                <span>Home</span>
                            </a>
                        </li>
          
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <span class="hide-menu">
                                    Inventory
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('meal_list')}}">Meal List</a></li>
                                <li><a href="{{route('cuisine-type_list')}}">Cuisine Type List</a></li>
                                <li><a href="{{route('menu_item_list')}}">Menu Item List</a></li>
                            </ul>
                        </li>
                        
                        
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false">
                                <span class="hide-menu">
                                    Shop Order
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('shop_order_panel')}}">Shop Order Panel</a></li>
                                <li><a href="{{route('voucher_lists')}}">Order Voucher List</a></li>
                            </ul>
                        </li>
                        
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>

        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="noti" style="position: fixed">
                </div>

                <div class="row page-titles">

                    @yield('place')

                </div>

                @yield('content')

            </div>
            <div id="mobileprint" class="d-none">

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            {{-- <footer class="footer"> © 2018 Material Pro Admin by wrappixel.com </footer> --}}
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>

    <!--c3 JavaScript -->
    <script src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>

    <script src="{{asset('assets/plugins/c3-master/c3.min.js')}}"></script>

    <script src="{{asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>

    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>

    <script src="{{asset('assets/plugins/multiselect/js/jquery.multi-select.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('js/validation.js')}}"></script>

    <script src="{{ asset('js/dist/js/qrcode-reader.min.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/js/Chart.bundle.min.js')}}"></script>

    <script src="https://js.pusher.com/4.3.1/pusher.min.js"></script>

    @yield('js')
    <script src="{{asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>


</body>

</html>
