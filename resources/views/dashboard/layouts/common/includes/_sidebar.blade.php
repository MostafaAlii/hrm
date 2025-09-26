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
                <li class="nav-item nav-hasmenu
                    {{ is_open([
                                'admin.mainSettings.index',
                            ]) }}
                ">
                    <a href="#!" class="nav-link">
                        <span class="nav-icon"><i class="ti ti-layout-2"></i></span>
                        <span class="nav-text">{{ trans('dashboard/sidebar.admin_main_settings_sidebar_title') }}</span>
                        <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                    </a>
                    <ul class="nav-submenu">
                        <!-- Main Settings -->
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.mainSettings.index') }}"
                                href="{{ route('admin.mainSettings.index') }}">
                                {{ trans('dashboard/sidebar.main_settings_sidebar_title') }}
                            </a>
                        </li>
                        <!-- End Main Settings -->
                    </ul>
                </li>
                <!-- End AdminPanelSetting -->
                <!-- Start Employees Departments -->
                @php
                    $employeeRoutes = [
                        'admin.employee.index', 'admin.employee.show',
                        'admin.bankVariable.index', 'admin.benefitVariable.index',
                        'admin.bloodType.index', 'admin.city.index', 'admin.country.index', 'admin.governorate.index',
                        'admin.jobCategories.index', 'admin.level.index','admin.branchs.index',
                        'admin.shift-types.index','admin.departments.index','admin.section.index','admin.qualifications.index',
                        'admin.nationality.index','admin.terminationTypes.index','admin.vacations.index','admin.occasions.index',
                        'admin.family-jobs.index','admin.insurance-regions.index','admin.insurance-types.index','admin.contract-types.index',
                        'admin.financialYears.index','admin.religion.index','admin.relative-degrees.index','admin.insurance-regions.index',
                    ];

                    $variablesRoutes = [
                        'admin.bankVariable.index', 'admin.benefitVariable.index',
                        'admin.bloodType.index', 'admin.city.index', 'admin.country.index', 'admin.governorate.index',
                        'admin.jobCategories.index', 'admin.level.index','admin.branchs.index',
                        'admin.shift-types.index','admin.departments.index','admin.section.index','admin.qualifications.index',
                        'admin.nationality.index','admin.terminationTypes.index','admin.vacations.index','admin.occasions.index',
                        'admin.family-jobs.index','admin.insurance-regions.index','admin.insurance-types.index','admin.contract-types.index',
                        'admin.financialYears.index','admin.religion.index','admin.relative-degrees.index','admin.insurance-regions.index',
                    ];
                @endphp

                <!-- Employees Departments -->
                <li class="nav-item nav-hasmenu {{ in_array(Route::currentRouteName(), $employeeRoutes) ? 'custom-background nav-provoke' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="nav-icon"><i class="ti ti-layout-2"></i></span>
                        <span class="nav-text">{{ trans('dashboard/sidebar.admin_employee_sidebar_title') }}</span>
                        <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                    </a>

                    <ul class="nav-submenu">
                        <!-- Employee -->
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.employee.index') }}" href="{{ route('admin.employee.index') }}">
                                {{ trans('dashboard/sidebar.employee_sidebar_title') }}
                            </a>
                        </li>

                        <!-- Variables Dropdown -->
                        <li class="nav-item nav-hasmenu {{ in_array(Route::currentRouteName(), $variablesRoutes) ? 'custom-background nav-provoke' : '' }}">
                            <a href="#!" class="nav-link">
                                {{trans('dashboard/sidebar.variables_sidebar_title')}}
                                <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                            </a>
                            <ul class="nav-submenu">
                                <!-- BankVariable -->
                                <li class="nav-item {{ is_active('admin.bankVariable.index') ? 'custom-background' : '' }}">
                                    <a class="nav-link {{ is_active('admin.bankVariable.index') }}"
                                        href="{{ route('admin.bankVariable.index') }}">
                                        {{ trans('dashboard/sidebar.bankVariable_sidebar_title') }}
                                    </a>
                                </li>
                                <!-- End BankVariable -->

                                <!-- Start BenefitVariable -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.benefitVariable.index') }}"
                                        href="{{route('admin.benefitVariable.index')}}">{{
                                        trans('dashboard/sidebar.benefitVariable_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End BenefitVariable -->

                                <!-- Start bloodType -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.bloodType.index') }}" href="{{route('admin.bloodType.index')}}">{{
                                        trans('dashboard/sidebar.blood_type_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End bloodType -->
                                <!-- Start Country -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.country.index') }}" href="{{route('admin.country.index')}}">{{
                                        trans('dashboard/sidebar.country_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Country -->
                                <!-- Start governorate -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.governorate.index') }}" href="{{route('admin.governorate.index')}}">{{
                                        trans('dashboard/sidebar.governorate_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End governorate -->
                                <!-- Start City -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.city.index') }}" href="{{route('admin.city.index')}}">{{
                                        trans('dashboard/sidebar.city_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End City -->
                                <!-- Start JobCategory -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.jobCategories.index') }}" href="{{route('admin.jobCategories.index')}}">{{
                                        trans('dashboard/sidebar.jobCategory_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End JobCategory -->
                                <!-- Start Levels-->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.level.index') }}" href="{{route('admin.level.index')}}">{{
                                        trans('dashboard/sidebar.level_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Levels -->
                                <!-- Start Branch -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.branchs.index') }}" href="{{route('admin.branchs.index')}}">{{
                                        trans('dashboard/sidebar.branch_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Branch -->
                                <!-- Start ShiftTypes -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.shift-types.index') }}" href="{{route('admin.shift-types.index')}}">{{
                                        trans('dashboard/sidebar.shift_type_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End ShiftTypes -->
                                <!-- Start Department -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.departments.index') }}" href="{{route('admin.departments.index')}}">{{
                                        trans('dashboard/sidebar.department_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Department -->
                                <!-- Start Section -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.section.index') }}" href="{{route('admin.section.index')}}">{{
                                        trans('dashboard/sidebar.section_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Section -->
                                <!-- Start Qualifications -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.qualifications.index') }}" href="{{route('admin.qualifications.index')}}">{{
                                        trans('dashboard/sidebar.qualification_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Qualifications -->
                                <!-- Start Occasions -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.occasions.index') }}" href="{{route('admin.occasions.index')}}">{{
                                        trans('dashboard/sidebar.occasion_sidebar_title')
                                        }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.vacations.index') }}" href="{{route('admin.vacations.index')}}">{{
                                        trans('dashboard/sidebar.vacation_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Occasions -->
                                <!-- Start TerminationTypes -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.terminationTypes.index') }}"
                                        href="{{route('admin.terminationTypes.index')}}">{{
                                        trans('dashboard/sidebar.terminationType_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End TerminationTypes -->
                                <!-- Start Nationality -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.nationality.index') }}" href="{{route('admin.nationality.index')}}">{{
                                        trans('dashboard/sidebar.nationality_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Nationality -->
                                <!-- Financial Years -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.financialYears.index') }}" href="{{ route('admin.financialYears.index') }}">
                                        {{ trans('dashboard/sidebar.financialYears_sidebar_title') }}
                                    </a>
                                </li>
                                <!-- End FinancialYear -->
                                <!-- Start Religin -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.religion.index') }}" href="{{route('admin.religion.index')}}">{{
                                        trans('dashboard/sidebar.religion_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Religin -->
                                <!-- Start Relative Degrees -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.relative-degrees.index') }}"
                                        href="{{route('admin.relative-degrees.index')}}">{{
                                        trans('dashboard/sidebar.relative_degree_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Relative Degrees -->
                                <!-- Start Insurance Regions -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.insurance-regions.index') }}"
                                        href="{{route('admin.insurance-regions.index')}}">{{
                                        trans('dashboard/sidebar.insurance_region_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Insurance Regions -->
                                <!-- Start Insurance Offices -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.insurance-regions.index') }}"
                                        href="{{route('admin.insurance-offices.index')}}">{{
                                        trans('dashboard/sidebar.insurance_office_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Insurance Offices -->
                                <!-- Start Contract Types -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.contract-types.index') }}" href="{{route('admin.contract-types.index')}}">{{
                                        trans('dashboard/sidebar.contract_type_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Contract Types -->
                                <!-- Start Insurance Types -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.insurance-types.index') }}"
                                        href="{{route('admin.insurance-types.index')}}">{{
                                        trans('dashboard/sidebar.insurance_type_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Insurance Types -->
                                <!-- Start Family Jobs -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.family-jobs.index') }}" href="{{route('admin.family-jobs.index')}}">{{
                                        trans('dashboard/sidebar.family_job_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Family Jobs -->
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End Employees Departments -->









            </ul>
        </div>
    </div>
</aside>
<!-- { navigation menu } end -->
