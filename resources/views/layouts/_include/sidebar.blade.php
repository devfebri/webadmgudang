<!-- LOGO -->
<div class="topbar-left">
    <div class="text-center">
        {{-- <a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Annex</a> --}}
        <a href="{{ route(auth()->user()->role.'_dashboard') }}" class="logo"><img src="{{ asset('img/logo.png') }}" class="bg-white" height="80" alt="logo"></a>
        <h5></h5>
    </div>
</div>

<div class="sidebar-inner slimscrollleft" style="font-family:revert-layer;font-size:14px;">

    <div id="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route(auth()->user()->role.'_dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            @if(auth()->user()->role=='teknisi')
                <li>
                    <a href="{{ route(auth()->user()->role.'_workorder') }}" class="waves-effect">
                        <i class="mdi mdi-truck"></i>
                        <span> Work Order </span>
                    </a>
                </li>

            @endif
            @if(auth()->user()->role=='admin')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i> <span> User </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route(auth()->user()->role.'_teknisi') }}">Teknisi</a></li>
                        <li><a href="{{ route(auth()->user()->role.'_consumen') }}">Consumen</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route(auth()->user()->role.'_instalasi') }}" class="waves-effect">
                        <i class="mdi mdi-access-point-network"></i>
                        <span> Pengajuan Instalasi </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route(auth()->user()->role.'_workorder') }}" class="waves-effect">
                        <i class="mdi mdi-truck"></i>
                        <span> Work Order </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route(auth()->user()->role.'_item') }}" class="waves-effect">
                        <i class="mdi mdi-server"></i>
                        <span> Item </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route(auth()->user()->role.'_paket') }}" class="waves-effect">
                        <i class="mdi mdi-tablet-android"></i>
                        <span> Paket </span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i> <span> Supplier </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route(auth()->user()->role.'_supplier') }}">Barang Masuk</a></li>
                        <li><a href="{{ route(auth()->user()->role.'_barangkeluar') }}">Barang Keluar</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="{{ route(auth()->user()->role.'_laporan') }}" class="waves-effect">
                        <i class="mdi mdi-clipboard-outline"></i>
                        <span> Laporan </span>
                    </a>
                </li> --}}
            @endif


        </ul>
    </div>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
