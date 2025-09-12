<!-- { navigation menu } start -->
<aside class="app-sidebar app-light-sidebar">
    <div class="app-navbar-wrapper">
        <div class="brand-link brand-logo">
            <a href="{{ guard_dashboard_route() }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ $logo }}" alt="" class="logo logo-lg" width="223" height="35" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="app-navbar">
                <li class="nav-item {{ is_active('admin.dashboard') }}">
                    <a href="{{ guard_dashboard_route() }}" class="nav-link">
                        <span class="nav-icon">
                            <i class="ti ti-layout-2"></i>
                        </span>
                        <span class="nav-text">{{trans('dashboard/header.main_dashboard') }}</span>

                    </a>
                </li>
                <!-- Start AdminPanelSetting -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.mainSettings.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-layout-2"></i></span><span
                            class="nav-text">{{ trans('dashboard/sidebar.admin_main_settings_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.mainSettings.index') }}" href="{{route('admin.mainSettings.index')}}">{{ trans('dashboard/sidebar.main_settings_sidebar_title') }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End AdminPanelSetting -->
                <!-- Start FinancialYear-->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.financialYears.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-briefcase"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_financialYearMonths_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.financialYears.index') }}"
                                href="{{route('admin.financialYears.index')}}">{{ trans('dashboard/sidebar.financialYears_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End FinancialYear -->
                <!-- Start Branch -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.branchs.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-award"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_branch_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.branchs.index') }}"
                                href="{{route('admin.branchs.index')}}">{{
                                trans('dashboard/sidebar.branch_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End Branch -->
                <!-- Start ShiftTypes -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.shift-types.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-alarm"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_shift_type_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.branchs.index') }}" href="{{route('admin.shift-types.index')}}">{{
                                trans('dashboard/sidebar.shift_type_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End ShiftTypes -->
                <!-- Start Department -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.departments.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-ad-2"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_department_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.departments.index') }}" href="{{route('admin.departments.index')}}">{{
                                trans('dashboard/sidebar.department_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End Department -->
                <!-- Start JobCategory -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.jobCategories.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-tornado"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_jobCategory_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.jobCategories.index') }}"
                                href="{{route('admin.jobCategories.index')}}">{{
                                trans('dashboard/sidebar.jobCategory_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End JobCategory -->
                <!-- Start Qualifications -->
                <li class="nav-item nav-hasmenu {{ is_open(['admin.qualifications.index']) }}">
                    <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-trophy"></i></span><span class="nav-text">{{
                            trans('dashboard/sidebar.admin_qualification_sidebar_title') }}</span><span class="nav-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="nav-submenu">
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.qualifications.index') }}"
                                href="{{route('admin.qualifications.index')}}">{{
                                trans('dashboard/sidebar.qualification_sidebar_title')
                                }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End Qualifications -->
            </ul>
        </div>
    </div>
</aside>
<!-- { navigation menu } end -->
