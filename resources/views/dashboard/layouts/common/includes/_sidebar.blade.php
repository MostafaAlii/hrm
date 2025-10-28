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
                                'admin.mainSettings.index', 'admin.tax-settings.index', 'insurance-settings.index'
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
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.tax-settings.index') }}" href="{{ route('admin.tax-settings.index') }}">
                                اعدادات الضرائب
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ is_active('admin.insurance-settings.index') }}" href="{{ route('admin.insurance-settings.index') }}">
                                اعدادات التامينات
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
                        'admin.educational-degrees.index', 'admin.grades.index', 'admin.universities.index', 'admin.specializations.index',
                        'admin.penalty-types.index', 'admin.cost-centers.index', 'admin.salary-cards.index', 'admin.performance-report-items.index',
                        'admin.license-variables.index', 'admin.employment-documents.index',
                        // Reports ::
                        'admin.reports.employee-informations'
                    ];

                    $variablesRoutes = [
                        'admin.bankVariable.index', 'admin.benefitVariable.index',
                        'admin.bloodType.index', 'admin.city.index', 'admin.country.index', 'admin.governorate.index',
                        'admin.jobCategories.index', 'admin.level.index','admin.branchs.index',
                        'admin.shift-types.index','admin.departments.index','admin.section.index','admin.qualifications.index',
                        'admin.nationality.index','admin.terminationTypes.index','admin.vacations.index','admin.occasions.index',
                        'admin.family-jobs.index','admin.insurance-regions.index','admin.insurance-types.index','admin.contract-types.index',
                        'admin.financialYears.index','admin.religion.index','admin.relative-degrees.index','admin.insurance-regions.index',
                        'admin.educational-degrees.index', 'admin.grades.index', 'admin.universities.index', 'admin.specializations.index',
                        'admin.penalty-types.index', 'admin.cost-centers.index', 'admin.salary-cards.index', 'admin.performance-report-items.index',
                        'admin.license-variables.index', 'admin.employment-documents.index',
                        // Reports ::
                        'admin.reports.employee-informations'
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
                                <!-- Start Penalty Types -->
                                <li class="nav-item {{ is_active('admin.penalty-types.index') ? 'custom-background' : '' }}">
                                    <a class="nav-link {{ is_active('admin.penalty-types.index') }}"
                                        href="{{ route('admin.penalty-types.index') }}">
                                        الجزاءات
                                    </a>
                                </li>
                                <!-- End Penalty Types -->
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
                                <!-- Start CostCenters -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.cost-centers.index') }}" href="{{route('admin.cost-centers.index')}}">
                                        مراكز التكلفه
                                    </a>
                                </li>
                                <!-- End CostCenters -->
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
                                <!-- Start SalaryCards -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.salary-cards.index') }}" href="{{route('admin.salary-cards.index')}}">
                                        كروت المرتبات
                                    </a>
                                </li>
                                <!-- End SalaryCards -->
                                <!-- Start PerformanceReportItem -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.performance-report-items.index') }}" href="{{route('admin.performance-report-items.index')}}">
                                        عناصر تقرير الكفاءه
                                    </a>
                                </li>
                                <!-- End PerformanceReportItem -->
                                <!-- Start LicenseVariable -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.license-variables.index') }}"
                                        href="{{route('admin.license-variables.index')}}">
                                        متغيرات الرخص
                                    </a>
                                </li>
                                <!-- End LicenseVariable -->
                                <!-- Start EmploymentDocument -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.employment-documents.index') }}"
                                        href="{{route('admin.employment-documents.index')}}">
                                        مصوغات التعيين
                                    </a>
                                </li>
                                <!-- End EmploymentDocument -->
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
                                <!-- Start Educational Degrees -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.educational-degrees.index') }}"
                                        href="{{route('admin.educational-degrees.index')}}">
                                        انواع المؤهلات
                                    </a>
                                </li>
                                <!-- End Educational Degrees -->
                                <!-- Start Qualifications -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.qualifications.index') }}" href="{{route('admin.qualifications.index')}}">{{
                                        trans('dashboard/sidebar.qualification_sidebar_title')
                                        }}</a>
                                </li>
                                <!-- End Qualifications -->
                                <!-- Start Grades -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.grades.index') }}" href="{{route('admin.grades.index')}}">
                                        انواع التقديرات
                                    </a>
                                </li>
                                <!-- End Grades -->
                                <!-- Start Universities -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.universities.index') }}" href="{{route('admin.universities.index')}}">
                                        الكليات / المدارس
                                    </a>
                                </li>
                                <!-- End Universities -->
                                <!-- Start Specializations -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.specializations.index') }}" href="{{route('admin.specializations.index')}}">
                                        التخصصات
                                    </a>
                                </li>
                                <!-- End Specializations -->
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

                        <!-- Start Employee Reports تقارير شئون العاملين -->
                        <li class="nav-item nav-hasmenu {{ in_array(Route::currentRouteName(), $variablesRoutes) ? 'custom-background nav-provoke' : '' }}">
                            <a href="#!" class="nav-link">
                                تقارير شئون العاملين
                                <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                            </a>
                            <ul class="nav-submenu">
                                <li class="nav-item {{ is_active('admin.reports.employee-informations.index') ? 'custom-background' : '' }}">
                                    <a class="nav-link {{ is_active('admin.reports.employee-informations.index') }}" href="{{ route('admin.reports.employee-informations.index') }}">
                                        بيانات العاملين
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Employee Reports تقارير شئون العاملين -->
                    </ul>
                </li>
                <!-- End Employees Departments -->

                <!-- Start Employees Salary Departments -->
                @php
                $salariesRoutes = [
                    'admin.tax-transaction-types.index', 'admin.expense-types.index', 'admin.revenue-types.index',
                    'admin.deduction-types.index','admin.allowance-types.index', 'admin.entitlement-variables.index',
                    'admin.deduction-variables.index'
                ];

                $salaryVariablesRoutes = [
                    'admin.tax-transaction-types.index', 'admin.expense-types.index', 'admin.revenue-types.index',
                    'admin.deduction-types.index','admin.allowance-types.index', 'admin.entitlement-variables.index',
                    'admin.deduction-variables.index'
                ];
                @endphp
                <li
                    class="nav-item nav-hasmenu {{ in_array(Route::currentRouteName(), $salariesRoutes) ? 'custom-background nav-provoke' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="nav-icon"><i class="ti ti-cash"></i></span>
                        <span class="nav-text">المرتبات</span>
                        <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                    </a>

                    <ul class="nav-submenu">
                        <!-- Variables Dropdown -->
                        <li
                            class="nav-item nav-hasmenu {{ in_array(Route::currentRouteName(), $salaryVariablesRoutes) ? 'custom-background nav-provoke' : '' }}">
                            <a href="#!" class="nav-link">
                                متغيرات المرتبات
                                <span class="nav-arrow"><i data-feather="{{ chevron_direction() }}"></i></span>
                            </a>
                            <ul class="nav-submenu">
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.deduction-variables.index') }}"
                                        href="{{ route('admin.deduction-variables.index') }}">
                                        متغيرات الاستقطاعات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.entitlement-variables.index') }}"
                                        href="{{ route('admin.entitlement-variables.index') }}">
                                        متغيرات الاستحقاقات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.allowance-variables.index') }}"
                                        href="{{ route('admin.allowance-variables.index') }}">
                                        متغيرات العلاوات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.deduction-types.index') }}" href="{{ route('admin.deduction-types.index') }}">
                                        أنواع الاستقطاعات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.revenue-types.index') }}"
                                        href="{{ route('admin.revenue-types.index') }}">
                                        أنواع الايرادات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.expense-types.index') }}" href="{{ route('admin.expense-types.index') }}">
                                        أنواع الصرفيات
                                    </a>
                                </li>
                                <!-- Allowances -->
                                <li class="nav-item">
                                    <a class="nav-link {{ is_active('admin.tax-transaction-types.index') }}" href="{{ route('admin.tax-transaction-types.index') }}">
                                        أنواع المعاملات الضريبية
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End Employees Salary Departments -->









            </ul>
        </div>
    </div>
</aside>
<!-- { navigation menu } end -->
