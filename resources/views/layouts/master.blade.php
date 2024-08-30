<!DOCTYPE html>
<html>

<head>
    {{-- febri developer --}}
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>PT Telkom Akses Jambi</title>

    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('image/logo-png.png') }}">

    <link href="{{ asset('template/assets/plugins/morris/morris.css') }}" rel="stylesheet">

    <link href="{{ asset('template/assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="{{asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('template/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Alertify css -->
    <link href="{{ asset('template/assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('template/assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
    <style>
        .modal-backdrop {
            opacity: 0 !important;
        }

    </style>


    @yield('css')



</head>


<body class="fixed-left" >


    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            @include('layouts._include.sidebar')
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                @include('layouts._include.header')
                <!-- Top Bar End -->
                @yield('content')
            </div> <!-- content -->

            <footer class="footer">
                © 2024 PT. Telkom Jambi | Bug Report Unit IT.
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/detect.js') }}"></script>
    <script src="{{ asset('template/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('template/assets/js/waves.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.scrollTo.min.js') }}"></script>


    <!-- Required datatable js -->
    <script src="{{asset('template/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('template/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('template/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('template/assets/pages/datatables.init.js')}}"></script>
    <!-- Alertify js -->
    <script src="{{ asset('template/assets/plugins/alertify/js/alertify.js') }}"></script>
    <script src="{{ asset('template/assets/pages/alertify-init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('template/assets/js/app.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>



    @yield('javascript')

    <script>
        @if(Session::has('pesan'))

        alertify.success("{{ Session::get('pesan') }}");
        @endif

        var timeDisplay = document.getElementById("time");


        function refreshTime() {
            var dateString = new Date().toLocaleString("id-ID", {
                timeZone: "Asia/Jakarta"
            });
            var formattedString = dateString.replace(", ", " - ");
            timeDisplay.innerHTML = formattedString;
        }

        setInterval(refreshTime, 1000);

    </script>


</body>

</html>
