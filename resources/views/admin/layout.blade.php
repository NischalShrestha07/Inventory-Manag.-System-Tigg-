<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 05:15:42 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    {{-- ICON IS NOT WORKING --}}
    <link rel="icon" href="{{ asset('images/icons8-books-16.png') }}">
    <base href="{{ asset('admincss') }}/" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    {{-- tailwind li --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">

    {{--
    <link rel="stylesheet" href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


    {{-- /////TOKEN RELATED IMPORTANT POINTS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    @yield('customCss')
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        .card {
            border: 1px solid #ddd;
        }

        .card-body {
            padding: 15px;
        }

        .card h5,
        .card h4 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="Gym Logo" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">


                <li class="nav-item dropdown">

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-5">

            <a href="index3.html" class="brand-link">
                <img style="margin-left: 0" src="dist/img/avatar.png" alt="Gym Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><b style="font-family: cursive">Inventory
                    </b></span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" style="font-size: 1.1rem">Inventory Management</a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger">Admin</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Inventory
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('product.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Products</p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('varProduct.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Varient Products</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('varAttribute.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Variant Attributes</p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Product Category</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('uom.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Units Of Measurement</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('adjustment.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inventory Adjustment</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('bill.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bills Of Materials</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('order.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Production Order</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('journal.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Production Journal</p>
                                    </a>
                                </li>

                            </ul>

                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Sales
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('quotation.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Quotations</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('customer.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customers </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('salesOrder.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Orders </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('invoice.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Invoice </p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Credit Notes </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <span>Allocate Customer Payment </span>
                                    </a>
                                </li>

                            </ul>





                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Accounts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('account.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <span>Banks Accounts </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Purchase
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>


                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('supplier.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Suppliers</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('purchaseOrder.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Purchase Order</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Production Journal</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{-- class mngt --}}
                        {{--
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Membership Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.membership') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Membership</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('class.read') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Class List</p>
                                    </a>

                                </li>
                            </ul>

                        </li> --}}



                        {{-- feehead mngt --}}
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Class Schedule Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.class') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Class Schedule</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('feehead.read') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Fee Head</p>
                                    </a>

                                </li>
                            </ul>

                        </li> --}}



                        {{-- feestructure mngt --}}
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Billing & Finance Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('feestructure.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add FeeStructure</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.billing') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Billing</p>
                                    </a>

                                </li>
                            </ul>

                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Settings & Customization
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('student.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Setting</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.setting') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Setting</p>
                                    </a>

                                </li>
                            </ul>

                        </li> --}}


                        {{-- Announcement mngt --}}
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Announcement Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('announcement.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Announcement</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('announcement.read') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Announcement List</p>
                                    </a>

                                </li>
                            </ul>


                        </li> --}}



                        {{-- Assign Subject mngt --}}
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Assign Subject Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('assignSubject.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Subject to Assign</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('assignSubject.read') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Assigned Subject</p>
                                    </a>

                                </li>
                            </ul>


                        </li> --}}


                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>

                                <p>
                                    Subject Mngt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('subject.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Record</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('subject.read') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Record</p>
                                    </a>

                                </li>
                            </ul>


                        </li> --}}




                    </ul>
                </nav>

            </div>

        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io/">Inventory Management System</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="plugins/sparklines/sparkline.js"></script>

    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="plugins/summernote/summernote-bs4.min.js"></script>

    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="dist/js/adminlte2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script src="dist/js/pages/dashboard.js"></script>
    @yield('customJs')
</body>


</html>