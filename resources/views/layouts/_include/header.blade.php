<div class="topbar">

    <nav class="navbar-custom">


        <ul class="list-inline float-right mb-0">
            <!-- language-->
            <span style="color: white"><b><i id="time"></i></b></span>




            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ auth()->user()->getAvatar() }}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5>{{ auth()->user()->name }}</h5>
                    </div>



                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="mdi mdi-logout m-r-5 text-muted"></i>
                        Logout</a>
                </div>
            </li>

        </ul>
        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            {{-- <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li> --}}
        </ul>



        <div class="clearfix">
        </div>

    </nav>

</div>

