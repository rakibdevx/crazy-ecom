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
            <li class="{{ request()->routeIs('admin.setting.index') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">settings</i></div>
                    <div class="menu-title">Sytem Settings</div>
                </a>
                <ul>
                    <li class="{{ request()->routeIs('admin.setting.index') ? 'mm-active' : '' }}">
                        <a href="{{route('admin.setting.index')}}"><i class="material-icons-outlined">arrow_right</i>General Settings</a>
                    </li>
                    <li {{ request()->routeIs('admin.setting.seo') ? 'mm-active' : '' }}>
                        <a href="{{route('admin.setting.seo')}}"><i class="material-icons-outlined">arrow_right</i>Seo Setting</a>
                    </li>
                    <li {{ request()->routeIs('admin.setting.contact') ? 'mm-active' : '' }}>
                        <a href="{{route('admin.setting.contact')}}"><i class="material-icons-outlined">arrow_right</i>Contact & Support Setting</a>
                    </li >
                    <li {{ request()->routeIs('admin.setting.mail') ? 'mm-active' : '' }}>
                        <a href="{{route('admin.setting.mail')}}"><i class="material-icons-outlined">arrow_right</i>Mail Config</a>
                    </li>
                    <li {{ request()->routeIs('admin.setting.security') ? 'mm-active' : '' }}>
                        <a href="{{route('admin.setting.security')}}"><i class="material-icons-outlined">arrow_right</i>security Setting</a>
                    </li>
                    <li {{ request()->routeIs('admin.setting.config') ? 'mm-active' : '' }}>
                        <a href="{{route('admin.setting.config')}}"><i class="material-icons-outlined">arrow_right</i>System Config</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i></div>
                    <div class="menu-title">Documentation</div>
                </a>
            </li>

        </ul>
        <!--end navigation-->
    </div>
</aside>
