
 <aside id="sidebar">
            <!--Sidebar Content-->
            <div class="h-100">
                <div class="sidebar-logo border-bottom border-dark py-0">
                     <img src="{{ asset('/images/logo.png')}}" alt="Logo" width="30" height="30" class="me-2">
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
                                <a href="{{route('vehicles.index')}}" class="sidebar-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}"> Vehicle registration</a> 
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('maintenance.index')}}" class="sidebar-link {{ request()->routeIs('maintenance.index') ? 'active' : '' }}">Vehicle Maintenance</a>
                            </li>

                              
                        </ul>
                        
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('dispatch.index','dispatch.create') ? '' : 'collapsed' }}"  data-bs-target="#dispatch" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-file pe-2"></i>
                            Dispatch
                        </a>
                        <ul id="dispatch" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('dispatch.index') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('dispatch.index')}}" class="sidebar-link {{ request()->routeIs('dispatch.index') ? 'active' : '' }}">dispatch</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('dispatch.create')}}" class="sidebar-link {{ request()->routeIs('dispatch.create') ? 'active' : '' }}">Page 2</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('pages.Maintenance','pages.metrics') ? '' : 'collapsed' }}" data-bs-target="#performance" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Driver and Trip Performance
                        </a>
                        <ul id="performance" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('pages.Maintenance','pages.metrics') ? 'show' : '' }}" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link {{ request()->routeIs('pages.Maintenance') ? 'active' : '' }}">Driver Performance Metrics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Page 2</a>
                            </li>
                        </ul>
                    </li>

                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#analytic" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-chart-simple pe-2"></i>
                            Transport Cost Analy.
                        </a>
                        <ul id="analytic" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebarAccordion">
                            <li class="sidebar-item">
                                <a href="{{route('pages.metrics')}}" class="sidebar-link">Driver Performance Metrics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Page 2</a>
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