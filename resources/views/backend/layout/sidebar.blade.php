<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img id="logo" class="logo-img" src="{{ asset(setting('site_logo_light')) }}" alt="{{ setting('site_title') }}">
        </div>

        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            @if(request()->is('admin/*'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
                <ul>
                    <li>
                        <a href="index.html"><i class="material-icons-outlined">arrow_right</i>eCommerce</a>
                    </li>
                    <li>
                        <a href="index2.html"><i class="material-icons-outlined">arrow_right</i>Alternate</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('admin.user.*') ? 'mm-active' : '' }}">
                <a href="{{route('admin.user.index')}}">
                    <div class="parent-icon"><i class="material-icons-outlined">person_outline</i></div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.vendor.*') ? 'mm-active' : '' }}">
                <a href="{{route('admin.vendor.index')}}">
                    <div class="parent-icon"><i class="material-icons-outlined">person_outline</i></div>
                    <div class="menu-title">Vendors</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">lock</i></div>
                    <div class="menu-title">Role Management</div>
                </a>
                <ul>
                    <li class="{{ request()->routeIs('admin.permission.*') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.permission.index')}}"><i class="material-icons-outlined">arrow_right</i>Permissions</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.role.*') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.role.index')}}"><i class="material-icons-outlined">arrow_right</i>Role</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.admin.*') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.admin.index')}}"><i class="material-icons-outlined">arrow_right</i>Users</a>
                    </li>
                </ul>
            </li>


            <li class="{{ request()->routeIs('admin.setting.*') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">settings</i></div>
                    <div class="menu-title">Sytem Settings</div>
                </a>
                <ul>
                    <li class="{{ request()->routeIs('admin.setting.index') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.index')}}"><i class="material-icons-outlined">arrow_right</i>General Settings</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.seo') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.seo')}}"><i class="material-icons-outlined">arrow_right</i>Seo Setting</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.contact') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.contact')}}"><i class="material-icons-outlined">arrow_right</i>Contact & Support Setting</a>
                    </li >
                    <li class="{{ request()->routeIs('admin.setting.mail') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.mail')}}"><i class="material-icons-outlined">arrow_right</i>Mail Config</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.security') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.security')}}"><i class="material-icons-outlined">arrow_right</i>security Setting</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.config') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.config')}}"><i class="material-icons-outlined">arrow_right</i>Configerations</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.system') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.system')}}"><i class="material-icons-outlined">arrow_right</i>System Configerations</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.image') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.image')}}"><i class="material-icons-outlined">arrow_right</i>Image Setting</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.setting.mail.template.*') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.mail.template.index')}}"><i class="material-icons-outlined">arrow_right</i>Mail Template</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.profile.index.*') ? 'mm-active' : '' }}">
                <a href="{{route('admin.profile.index')}}">
                    <div class="parent-icon"><i class="material-icons-outlined">person_outline</i></div>
                    <div class="menu-title">Profile</div>
                </a>
            </li>
            @endif




            {{---------------------------------------------- Vendor Routes-------------------------------------------- --}}
            @if(request()->is('vendor/*'))
            <li class="{{ request()->routeIs('vendor.dashboard') ? 'mm-active' : '' }}">
                <a href="{{route('vendor.dashboard')}}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ request()->routeIs('vendor.profile.index.*') ? 'mm-active' : '' }}"">
                <a href="{{route('vendor.profile.index')}}">
                    <div class="parent-icon"><i class="material-icons-outlined">person_outline</i></div>
                    <div class="menu-title">Profile</div>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>
