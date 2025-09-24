
 <aside id="sidebar">
            <div class="h-100">
      <div class="fw-bold ms-3 justify-content-center" id="clock"></div>
                <div class="sidebar-logo py-3 text-center d-flex flex-column align-items-center">
                 
    <img src="{{ asset('images/logo.png')}}" alt="Logo" width="100" height="100" class="mb-2">
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
                        'maintenance.create','')
                         ? '' : 'collapsed' }}"  data-bs-target="#fleet" data-bs-toggle="collapse"
                            aria-expanded="false">
                           <i class="fa-solid fa-car pe-2"></i>
                           Fleet Vehicle
                        </a>
                        <ul id="fleet" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('vehicles.index','maintenance.index',
                        'maintenance.create','') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('vehicles.index')}}" class="sidebar-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}"> - Vehicle registration</a> 
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.index')}}" class="sidebar-link {{ request()->routeIs('maintenance.index') ? 'active' : '' }}"> - Vehicle Maintenance</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.create')}}" class="sidebar-link {{ request()->routeIs('maintenance.create') ? 'active' : '' }}"> - Add Maintenance  List</a>
                            </li>

                             {{-- <li class="sidebar-item">
                                <a href="{{route('reservation.index')}}" class="sidebar-link {{ request()->routeIs('reservation.index') ? 'active' : '' }}"> - Reservation list</a>
                            </li> --}}
                                   
                                   
                        </ul>
                        
                    </li>
                    

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('trip.create','trip.index','reservation.index') ? '' : 'collapsed' }}"  data-bs-target="#dispatch" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-file pe-2"></i>
                            Dispatch
                        </a>
                        <ul id="dispatch" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('trip.index','trip.create','reservation.index') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('trip.create')}}" class="sidebar-link {{ request()->routeIs('trip.create') ? 'active' : '' }}"> - Request List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('trip.index')}}" class="sidebar-link {{ request()->routeIs('trip.index') ? 'active' : '' }}"> - Dispatch List</a>
                            </li>
                              <li class="sidebar-item">
                                <a href="{{route('reservation.index')}}" class="sidebar-link {{ request()->routeIs('reservation.index') ? 'active' : '' }}" > - Reservation</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('driver.report','trips.performance') ? '' : 'collapsed' }}" data-bs-target="#performance" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Driver/Trip Performance
                        </a>
                        <ul id="performance" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('driver.report','trips.performance') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('trips.performance')}}" class="sidebar-link {{ request()->routeIs('trips.performance') ? 'active' : '' }}"> - Trips</a>
                            </li>

                             <li class="sidebar-item">
                                <a href="{{route('driver.report')}}" class="sidebar-link {{ request()->routeIs('driver.report') ? 'active' : '' }}"> - Driver Report</a>
                            </li>
                           
                        </ul>
                    </li>

                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('costanalysis.index','budget_forecasting.index') ? '' : 'collapsed' }}" data-bs-target="#analytic" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Transport Cost Analy.
                        </a>
                        <ul id="analytic" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('costanalysis.index','budget_forecasting.index') ? 'show' : 'active-parent' }}" data-bs-parent="#sidebarAccordion">
                            
                           

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
    <a href="#" 
       class="sidebar-link {{ request()->routeIs('pages.teams') ? '' : 'collapsed' }}" 
       data-bs-target="#multi" data-bs-toggle="collapse"
       aria-expanded="{{ request()->routeIs('pages.teams') ? 'true' : 'false' }}">
        <i class="fa-solid fa-file pe-2"></i>
        System
    </a>
    <ul id="multi" 
        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('pages.teams') ? 'show' : '' }}" 
        data-bs-parent="#sidebarAccordion">

        <li class="sidebar-item">
            <a href="#" 
               class="sidebar-link {{ request()->routeIs('pages.teams') ? '' : 'collapsed' }}" 
               data-bs-target="#level1" data-bs-toggle="collapse"
               aria-expanded="{{ request()->routeIs('pages.teams') ? 'true' : 'false' }}">
                Team
            </a>

            <ul id="level1" 
                class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('pages.teams') ? 'show' : '' }}">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">About</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('pages.teams') }}" 
                       class="sidebar-link {{ request()->routeIs('pages.teams') ? 'active' : '' }}">
                        Members
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

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
