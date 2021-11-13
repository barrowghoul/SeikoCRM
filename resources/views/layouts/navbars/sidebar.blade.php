<div class="sidebar" data-color="brown" data-active-color="danger">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="http://www.seikosoluciones.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('img/logo-small.png') }}">
            </div>
        </a>
        <a href="http://www.seikosoluciones.com" class="simple-text logo-normal">
            {{ __('Seiko Soluciones') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                @if (isset(auth()->user()->picture))
                    <img src="{{ asset(auth()->user()->picture) }}">
                @else
                    <img class="avatar border-gray" src="{{ asset('img/No Profile Picture.png') }}" alt="...">
                @endif
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ auth()->user()->name }}
                    <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse {{ $folderActive == 'profile' ? 'show' : '' }}" id="collapseExample">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'edit-profile' ? 'active' : '' }}">
                            <a href="#">
                                <span class="sidebar-mini-icon">{{ __('MP') }}</span>
                                <span class="sidebar-normal">{{ __('My Profile') }}</span>
                            </a>
                        </li>
                        <li>
                            <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOutSidebar" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a onclick="document.getElementById('formLogOutSidebar').submit();">
                                <span class="sidebar-mini-icon">{{ __('LO') }}</span>
                                <span class="sidebar-normal">{{ __('Log Out') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if (Auth::user()->hasPermissionTo('ver prospectos') || Auth::user()->hasPermissionTo('ver clientes') || Auth::user()->hasPermissionTo('ver diagnosticos'))
                <li class="{{ $folderActive == 'customers' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#customerElement">
                        <i class="nc-icon nc-user"></i>
                        <p>
                                {{ __('Customers') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExamples">
                        <ul class="nav">
                            @if (Auth::user()->hasPermissionTo('ver prospectos'))
                                <li class="{{ $elementActive == 'prospectElement' ? 'active' : '' }}">
                                    <a href="{{ route('prospects.index') }}">
                                        <span class="sidebar-mini-icon">{{ __('P') }}</span>
                                        <span class="sidebar-normal">{{ __('Prospects') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->hasPermissionTo('ver diagnosticos'))
                                <li class="{{ $elementActive == 'diagnosticElement' ? 'active' : '' }}">
                                    <a href="{{ route('diagnostics.index') }}">
                                        <span class="sidebar-mini-icon">{{ __('D') }}</span>
                                        <span class="sidebar-normal">{{ __('Diagnostics') }}</span>
                                    </a>
                                </li>
                            @endif                            
                            @if (Auth::user()->hasPermissionTo('ver clientes'))
                                <li class="{{ $elementActive == 'customerElement' ? 'active' : '' }}">
                                    <a href="{{ route('customers.index') }}">
                                        <span class="sidebar-mini-icon">{{ __('C') }}</span>
                                        <span class="sidebar-normal">{{ __('Customers') }}</span>
                                    </a>
                                </li>
                            @endif                            
                        </ul>
                    </div>
                </li>
            @endif
 
            <li class="{{ $folderActive == 'settings' ? 'active' : '' }}">
                <a data-toggle="collapse" href="#settingsElements" aria-expanded="{{ $folderActive == 'settings' ? 'true' :''}}">
                    <i class="nc-icon nc-settings-gear-65"></i>
                    <p>
                            {{ __('Settings') }}
                        <b class="caret"></b>
                    </p>                    
                </a>
                <div class="collapse {{ $folderActive == 'settings' ? 'show' : ''}}" id="settingsElements">
                    <ul class="nav">
                        @can('ver roles')
                            <li class="{{ $elementActive == 'roleElement' ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}">
                                    <span class="sidebar-mini-icon">{{ __('RM') }}</span>
                                    <span class="sidebar-nomral">{{ __('Role Management') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('ver usuarios')
                            <li class="{{ $elementActive == 'userElement' ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}">
                                    <span class="sidebar-mini-icon">{{ __('UM') }}</span>
                                    <span class="sidebar-nomral">{{ __('User Management') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>