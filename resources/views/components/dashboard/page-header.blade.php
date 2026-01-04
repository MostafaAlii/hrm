{{-- Breadcrumb --}}
@if ($showBreadcrumb)
<h1 class="mb-0">{{ $title }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">{{ trans('dashboard/header.main_dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route($route) }}">{{ $title }}</a>
    </li>
</ul>
@endif

{{-- زر الإضافة --}}
@if ($showButton && $showCreate)
    {{ $title }}
    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal"
        data-bs-target="#createDepartmentModal">
        <i class="fa fa-plus"></i>
        {{ trans('dashboard/employee.add_new_employee') }}
    </button>
    @include('dashboard.admin.employees.btn.create')
@endif
