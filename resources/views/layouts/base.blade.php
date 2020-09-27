<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rasis</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('lte/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/chart.js/Chart.css')}}">
    <link href="{{asset('font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('font-awesome-4.7/css/font-awesome.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('lte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Custom Style -->
    <style>.gap {margin-bottom: 1rem;}</style>
    <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('lte/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('lte/plugins/jquery/jquery.js')}}"></script>
    <script src="{{asset('lte/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('lte/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://kit.fontawesome.com/151659c1af.js" crossorigin="anonymous"></script>
    <script src="{{asset('lte/plugins/select2/js/select2.full.min.js')}}"></script>

    
    @stack('custom-style')

</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="/img/covid.png" alt="o" class="brand-image">
                <span class="brand-text font-weight-light">Rasis</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/img/covid.png"alt="Img">
                    </div>
                    <div class="info">
                        <a class="d-block">Covid-19</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">NAVIGASI</li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <!--
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-pencil-alt"></i>
                                <p>
                                    fitur baru
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/aritmatika" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Aritmatika</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/geometri" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Geometri</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-pencil-alt"></i>
                                <p>
                                    Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/covid-dunia" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dunia</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/covid-negara" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Negara</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/covid-indoprov" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Indo Prov</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
        </div>

        @yield('content-modal')
    </div>
    <!-- jQuery -->
</body>
</html>
