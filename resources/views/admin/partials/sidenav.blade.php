<!-- MENU SIDEBAR-->
    <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin_assets/images/icon/logo-white.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <!-- <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="{{asset('admin_assets/images/icon/avatar-big-01.jpg')}}" alt="John Doe" />
                    </div>
                    <h4 class="name">john doe</h4>
                    <a href="#">Sign out</a>
                </div> -->
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_active')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <!-- <span class="inbox-num">3</span> -->
                        </li>
                        <li class="@yield('category_active')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list-ul"></i>Category</a>
                            <span class="inbox-num">3</span>
                        </li>
                        <li class="@yield('coupon_active')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->