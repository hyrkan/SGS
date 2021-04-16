        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(/assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="{{asset('/assets/images/users/profile.png')}}" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"></a>
                        <div class="dropdown-menu animated flipInY"> <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-power-off"></i> Logout</a> </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a href="/home" aria-expanded="false"><i class="fas fa-home"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fab fa-envira"></i><span class="hide-menu">Seed Cultivation</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/seed_sowing">Monitor Seedbed</a></li>
                                <li><a href="/seed_plot">Monitor Plots</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="/seed_management" aria-expanded="false"><i class="fas fa-seedling"></i><span class="hide-menu">Seed Management</span></a>
                        </li>
                        <li>
                            <a href="/seedbed_management" aria-expanded="false"><i class="fab fa-pagelines"></i><span class="hide-menu">Seedbed Management</span></a>
                        </li>
                        <li>
                            <a href="/plot_management" aria-expanded="false"><i class="fas fa-leaf"></i><span class="hide-menu">Plot Management</span></a>
                        </li>
                        <li>
                            <a href="/product_inventory" aria-expanded="false"><i class="fas fa-file-alt"></i><span class="hide-menu">Product Inventory</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-flask"></i><span class="hide-menu">Chemicals</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/fertilizer">Fertilizer</a></li>
                                <li><a href="/pesticide">Pesticides</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/staff_management" aria-expanded="false"><i class="fas fa-user-secret"></i><span class="hide-menu">Staff Management</span></a>
                        </li>
                        <li>
                            <a href="#" aria-expanded="false"><i class="fas fa-history"></i><span class="hide-menu">History</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="{{ route('logout') }}"  data-toggle="tooltip" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout"><i class="mdi mdi-power"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
            <!-- End Bottom points-->
        </aside>