<aside class="left-sidebar">
        <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="../assets/images/users/1.jpg" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> {{ Auth::user()->username }} <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                    <div class="dropdown-divider"></div> <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a href="#" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Jobs </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">New job </a></li>
                        <li><a href="app-chat.html">View all jobs </a></li>
                        <li><a href="app-ticket.html">View priority jobs </a></li>
                        <li><a href="app-contact.html">Overview </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Filet Lists </span></a>
                </li>                    
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Inventory </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">New inventory item </a></li>
                        <li><a href="app-chat.html">View all items </a></li>
                        <li><a href="app-ticket.html">Release from jobs </a></li>
                        <li><a href="app-contact.html">Disks in use </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Clients </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">New client </a></li>
                        <li><a href="app-chat.html">View all clients </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">Stock </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">New stock item </a></li>
                        <li><a href="app-chat.html">View all items </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-bank"></i><span class="hide-menu">Billing </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">New invoice </a></li>
                        <li><a href="app-chat.html">View all invoices </a></li>
                        <li><a href="app-ticket.html">Bills </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users and Groups </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#" class="has-arrow">Users </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="pages-login.html">Add new user </a></li>
                                <li><a href="pages-login-2.html">View all users </a></li>
                            </ul>
                        </li>
                        <li><a href="app-chat.html">User groups </a></li>
                        <li><a href="#" class="has-arrow">Permissions </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="pages-login.html">Define new permission </a></li>
                                <li><a href="pages-login-2.html">View all permissions </a></li>
                            </ul>
                        </li>
                        <li><a href="app-contact.html">Roles </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">System settings </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">General settings </a></li>
                        <li><a href="app-chat.html">Mailing settings </a></li>
                        <li><a href="app-ticket.html">Languages </a></li>
                        <li><a href="#" class="has-arrow">Lists </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="pages-login.html">Job statuses </a></li>
                                <li><a href="pages-login-2.html">Device types </a></li>
                                <li><a href="pages-login-2.html">Job priorities </a></li>
                                <li><a href="pages-login-2.html">Device diagnosis </a></li>
                                <li><a href="pages-login-2.html">Services </a></li>
                            </ul>
                        </li>
                        <li><a href="app-ticket.html">Diller settings </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" aria-expanded="false"><i class="mdi mdi-calendar-question"></i><span class="hide-menu">About </span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>