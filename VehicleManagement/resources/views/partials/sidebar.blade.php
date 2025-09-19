
 <aside id="sidebar">
            
            
            <div class="h-100">
                <div class="sidebar-logo py-3 text-center d-flex flex-column align-items-center">
    <img src="{{ asset('images/logo.png')}}" alt="Logo" width="80" height="80" class="mb-2">
    <a href="#" class="text-primary-emphasis">(Logistic Dept 2)</a>
    <small class="text-lowercase">@auth{{ auth()->user()->email }}@endauth</small>
</div>

                <ul class="sidebar-nav accordion" id="sidebarAccordion">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('pages.dashboard')}}" class="sidebar-link">
                            <i class="fa-solid fa-grip"></i>
                            Dashboard
                        </a>
                    </li>
                     <li class="sidebar-header">
                
                           Fleet & Transport Operation
                      
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('vehicles.index','maintenance.index',
                        'maintenance.create','reservation.index')
                         ? '' : 'collapsed' }}"  data-bs-target="#fleet" data-bs-toggle="collapse"
                            aria-expanded="false">
                           <i class="fa-solid fa-car pe-2"></i>
                           Fleet Vehicle
                        </a>
                        <ul id="fleet" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('vehicles.index','maintenance.index',
                        'maintenance.create','reservation.index') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('vehicles.index')}}" class="sidebar-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}"> - Vehicle registration</a> 
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.index')}}" class="sidebar-link {{ request()->routeIs('maintenance.index') ? 'active' : '' }}"> - Vehicle Maintenance</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.create')}}" class="sidebar-link {{ request()->routeIs('maintenance.create') ? 'active' : '' }}"> - Add Maintenance  List</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="{{route('reservation.index')}}" class="sidebar-link {{ request()->routeIs('reservation.index') ? 'active' : '' }}"> - Reservation list</a>
                            </li>
                                   
                                   
                        </ul>
                        
                    </li>
                    

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('trip.create','trip.index','reservation.create') ? '' : 'collapsed' }}"  data-bs-target="#dispatch" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-file pe-2"></i>
                            Dispatch
                        </a>
                        <ul id="dispatch" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('trip.index','trip.create','reservation.create') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('trip.create')}}" class="sidebar-link {{ request()->routeIs('trip.create') ? 'active' : '' }}"> - Request List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('trip.index')}}" class="sidebar-link {{ request()->routeIs('trip.index') ? 'active' : '' }}"> - Dispatch List</a>
                            </li>
                              <li class="sidebar-item">
                                <a href="{{route('reservation.create')}}" class="sidebar-link {{ request()->routeIs('reservation.create') ? 'active' : '' }}" > - Reservation</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('driver.driver_report','trips.tripperformance') ? '' : 'collapsed' }}" data-bs-target="#performance" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Driver/Trip Performance
                        </a>
                        <ul id="performance" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('driver.driver_report','trips.tripperformance') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link {{ request()->routeIs('') ? 'active' : '' }}"> - Drive Profile</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('trips.tripperformance')}}" class="sidebar-link {{ request()->routeIs('trips.tripperformance') ? 'active' : '' }}"> - Trips</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="{{route('driver.driver_report')}}" class="sidebar-link {{ request()->routeIs('driver.driver_report') ? 'active' : '' }}"> - Driver Report</a>
                            </li>
                           
                        </ul>
                    </li>

                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('cost_optimization.analytics','costanalysis.index','budget_forecasting.index') ? '' : 'collapsed' }}" data-bs-target="#analytic" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Transport Cost Analy.
                        </a>
                        <ul id="analytic" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('cost_optimization.analytics','costanalysis.index','budget_forecasting.index') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('cost_optimization.analytics')}}" class="sidebar-link {{ request()->routeIs('cost_optimization.analytics') ? 'active' : '' }}"> - Analysis</a>
                            </li>
                           

                             <li class="sidebar-item">
                                <a href="{{route('costanalysis.index')}}" class="sidebar-link {{ request()->routeIs('costanalysis.index') ? 'active' : '' }}"> - OverView Of expenses</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="{{route('budget_forecasting.index')}}" class="sidebar-link {{ request()->routeIs('budget_forecasting.index') ? 'active' : '' }}"> - Budget Forecasting</a>
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
           
        </aside>
