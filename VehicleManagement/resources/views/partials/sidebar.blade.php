
 <aside id="sidebar">
            <!--Sidebar Content-->
            <div class="h-100">
                <div class="sidebar-logo py-3">
                     <img src="{{ asset('images/logo.png')}}" alt="Logo" width="80" height="80" class="ms-5">
                     <br>
                    <a href="#" class="text-primary-emphasis ms-3">(Logistic Dept 2)</a>
                   
                </div>
                <ul class="sidebar-nav accordion" id="sidebarAccordion">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('pages.dashboard')}}" class="sidebar-link">
                            <i class="fa-solid fa-list"></i>
                            Dashboard
                        </a>
                    </li>
                     <li class="sidebar-header">
                
                           Fleet & Transport Operation
                      
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('vehicles.index','maintenance.index') ? '' : 'collapsed' }}"  data-bs-target="#fleet" data-bs-toggle="collapse"
                            aria-expanded="false">
                           <i class="fa-solid fa-car pe-2"></i>
                           Fleet Vehicle
                        </a>
                        <ul id="fleet" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('vehicles.index','maintenance.index') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('vehicles.index')}}" class="sidebar-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}"> - Vehicle registration</a> 
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.index')}}" class="sidebar-link {{ request()->routeIs('maintenance.index') ? 'active' : '' }}"> - Vehicle Maintenance</a>
                            </li>

                              
                        </ul>
                        
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('dispatch.index','dispatch.create','maintenance.create') ? '' : 'collapsed' }}"  data-bs-target="#dispatch" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-file pe-2"></i>
                            Dispatch
                        </a>
                        <ul id="dispatch" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('dispatch.index','dispatch.create','maintenance.create') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('dispatch.index')}}" class="sidebar-link {{ request()->routeIs('dispatch.index') ? 'active' : '' }}"> - dispatch</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('dispatch.create')}}" class="sidebar-link {{ request()->routeIs('') ? 'active' : '' }}"> - Vehicle Reservation</a>
                            </li>
                              <li class="sidebar-item">
                                <a href="{{route('maintenance.create')}}" class="sidebar-link{{ request()->routeIs('vehicle.maintenance') ? 'active' : '' }}" > - Maintenance  List</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('driver.driver_profile','driver.driver_report') ? '' : 'collapsed' }}" data-bs-target="#performance" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Driver and Trip Performance
                        </a>
                        <ul id="performance" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('driver.driver_profile','driver.driver_report') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('driver.driver_profile')}}" class="sidebar-link {{ request()->routeIs('driver.driver_profile') ? 'active' : '' }}"> - Drive Profile</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">----</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="{{route('driver.driver_report')}}" class="sidebar-link {{ request()->routeIs('driver.driver_report') ? 'active' : '' }}"> - Driver Report</a>
                            </li>
                        </ul>
                    </li>

                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('cost_optimization.analytics','fuelcost.fuel-cost') ? '' : 'collapsed' }}" data-bs-target="#analytic" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Transport Cost Analy.
                        </a>
                        <ul id="analytic" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('cost_optimization.analytics','fuelcost.fuel-cost') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('cost_optimization.analytics')}}" class="sidebar-link {{ request()->routeIs('cost_optimization.analytics') ? 'active' : '' }}"> - Analysis</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('fuelcost.fuel-cost')}}" class="sidebar-link {{ request()->routeIs('fuelcost.fuel-cost') ? 'active' : '' }}"> - Fuel Cost Analysis</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="#" class="sidebar-link"> - Maintenance Cost Reports</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="#" class="sidebar-link"> - Vehicle Utilization</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="#" class="sidebar-link"> - Budget Forecasting</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-header">
                        Multi Level Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-file pe-2"></i>
                            System
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level1"
                                    data-bs-toggle="collapse" aria-expanded="false">Team</a>

                                <ul id="level1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">about</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Members</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                         <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                           <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                         <a href="{{route('logout')}}" class="sidebar-link">
                          <i class="fa-solid fa-door-open"></i>
                            Logout
                        </a>
                    </li>
                    </li>




                </ul>
            </div>
             <span class="text-lowercase fs-6 ms-3">@auth{{auth()->user()->email}}@endauth</span>
        </aside>