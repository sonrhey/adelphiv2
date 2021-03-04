<div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('template_styles/images/icon/logo.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            
                            @foreach($modules as $module)
                                @if($module->parent == 0 && $module->has_sub == 0)
                                    <li class="side-nav-item">
                                        
                                        <a href="{{ url($module->routes) }}" aria-expanded="true">
                                            @if($module->icon)
                                                <i class="{{$module->icon}}"></i>
                                            @endif
                                            {{ $module->name}}
                                        </a>
                                    </li>
                                @elseif($module->has_sub > 0 && $module->parent == 0)
                                    <li>
                                         <a href="javascript:void(0)" aria-expanded="true">
                                             @if($module->icon)
                                                <i class="{{$module->icon}}"></i>
                                            @endif
                                            {{ $module->name }}
                                            <span class="menu-arrow"></span>
                                        </a>

                                            <ul class="collapse">   
                                            @foreach($modules as $sub_module)
                                                @if($sub_module->parent == $module->id)
                                                    <li>
                                                        <a href="{{ url($sub_module->routes) }}">{{ $sub_module->name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        
                                    </li>
                                <!-- elseif ($module->has_sub > 0 && $module->parent > 0)
                                <li>
                                         <a href="javascript:void(0)" aria-expanded="true">
                                             @if($module->icon)
                                                <i class="{{$module->icon}}"></i>
                                            @endif
                                            {{ $module->name }}
                                            <span class="menu-arrow"></span>
                                        </a>

                                            <ul class="collapse">   
                                            @foreach($modules as $sub_module)
                                                @if($sub_module->parent == $module->id)
                                                    <li>
                                                        <a href="{{ url($sub_module->routes) }}">{{ $sub_module->name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        
                                    </li> -->
                                @endif

                            @endforeach
                        </ul>
                        <!-- <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Loan
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="index.html">Sub Loan Nav</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Maintenance
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="index.html">Sub Maitenance Nav</a></li>
                                </ul>
                            </li>
                        </ul> -->
                    </nav>
                </div>
            </div>
        </div>

