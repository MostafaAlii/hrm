@extends('dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    #departments_datatable tbody td,
    #departments_datatable thead th {
        text-align: center !important;
    }

    #departments_datatable .dt-left,
    #departments_datatable .dt-right {
        text-align: center !important;
    }
</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')

@php
    $routeMeta = match (Route::currentRouteName()) {
        'admin.employee.index' => [
            'title' => trans('dashboard/sidebar.employee_sidebar_title'),
            'route' => 'admin.employee.index',
            'showCreate' => true,
        ],
        'admin.employees.status' => [
            'title' => trans('dashboard/sidebar.employee_status_title'),
            'route' => 'admin.employees.status',
            'showCreate' => false,
        ],
        default => [
            'title' => trans('dashboard/sidebar.employee_sidebar_title'),
            'route' => 'admin.employee.index',
            'showCreate' => false,
        ],
    };
    $pageTitle = $routeMeta['title'];
    $pageRoute = $routeMeta['route'];
    $showCreate = $routeMeta['showCreate'] ?? false;
@endphp
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{ $pageTitle }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route($pageRoute)}}">{{ $pageTitle }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="ti ti-award"></i>
                    </span>
                    {{ $pageTitle }}
                    @if ($showCreate)
                        <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary"
                            data-bs-toggle="modal" data-bs-target="#createDepartmentModal">
                            <i class="fa fa-plus"></i>
                            {{trans('dashboard/employee.add_new_employee')}}
                        </button>
                        @include('dashboard.admin.employees.btn.create')
                    @endif
                </div>
                <div class="card-body">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-row-bordered gy-5 gs-7">
                            {!! $dataTable->table() !!}
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>
@endsection

@push('js')
{!! $dataTable->scripts() !!}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

@endpush
