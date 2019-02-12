<aside class="left-sidebar">
        <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Jobs </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('show_all_job') }}">All jobs </a></li>
                        <li><a href="{{ route('show_add_job', ['client_id' => 0 ]) }}">New job </a></li>
                        <li><a href="{{ route('show_all_priority_job') }}">Priority jobs </a></li>
                        <li><a href="{{ route('show_overview')}}">Overview </a></li>
                    </ul>
                </li>  
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Clients </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('allclients') }}">All clients </a></li>
                        <li><a href="{{ route('addClinet') }}">New client </a></li>
                    </ul>
                </li>  
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-comments"></i><span class="hide-menu">Quotes </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL::to('quote/allview') }}">All Quotes </a></li>
                    <li><a href="{{ URL::to('quote/add') }}">New Quote </a></li>
                    </ul>
                </li>            
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-bank"></i><span class="hide-menu">Billing </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL::to('invoice/allview') }}">All invoices </a></li>
                        <li><a href="{{ URL::to('invoice/add') }}">New invoice </a></li>
                        <li><a href="{{ URL::to('invoice/allview') }}">Unpaid invoices </a></li>
                        <li><a href="{{ URL::to('invoice/allview') }}">Paid invoices </a></li>
                    </ul>
                </li>  
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">Stock </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL::to('stock/allview') }}">All Stocks </a></li>
                        <li><a href="{{URL::to('stock/create')}}">New Stock </a></li>
                    </ul>
                </li>  
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-archive"></i><span class="hide-menu">Expenses </span></a>
                    <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ URL::to('expense/allview') }}">All Expenses </a></li>
                        <li><a href="{{ URL::to('expense/add') }}">New Expense </a></li>
                    </ul>
                </li>   
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Inventory </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('show_all_inventory') }}">All Inventories </a></li>
                        <li><a href="{{ route('show_add_inventory') }}">New item </a></li>
                        <li><a href="{{ route('show_release_from_job') }}">Release from jobs </a></li>
                        <li><a href="{{ route('show_inventory_use') }}">Disks in use </a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users and Groups </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#" class="has-arrow">Users </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('show_add_user') }}">Add new user </a></li>
                                <li><a href="{{ route('show_all_user') }}">View all users </a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="has-arrow">User Groups </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('show_add_user_group') }}">Add new user group</a></li>
                                <li><a href="{{ route('show_all_user_group') }}">View all user groups </a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="has-arrow">Permissions </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('show_add_Permission') }}">Define new permission </a></li>
                                <li><a href="{{ route('show_all_Permission') }}">View all permissions </a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="has-arrow">Roles </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('show_add_role') }}">Define new role </a></li>
                                <li><a href="{{ route('show_all_role') }}">View all roles </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">System settings </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">General settings </a></li>
                        <li><a href="#">Mailing settings </a></li>
                        <li><a href="#">Languages </a></li>
                        <li><a href="#" class="has-arrow">Lists </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/settings/lists/basejobstatues')}}">Job statuses </a></li>
                                <li><a href="{{URL::to('/settings/lists/devicetypes')}}">Device types </a></li>
                                <li><a href="{{URL::to('/settings/lists/jobpriorities')}}">Job priorities </a></li>
                                <li><a href="{{URL::to('/settings/lists/devicediagnosis')}}">Device diagnosis </a></li>
                                <li><a href="{{URL::to('/settings/lists/services')}}">Services </a></li>
                            </ul>
                        </li>
                        <li><a href="#">Diller settings </a></li>
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
</aside>