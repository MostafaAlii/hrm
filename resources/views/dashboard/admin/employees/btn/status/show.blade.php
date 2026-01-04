@extends('dashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- ✅ SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    #departments_datatable tbody td,
    #departments_datatable thead th {
        text-align: center !important;
    }

    #departments_datatable .dt-left,
    #departments_datatable .dt-right {
        text-align: center !important;
    }

    .accordion-button {
        transition: background-color 0.4s ease, color 0.4s ease, transform 0.3s ease;
    }

    .accordion-button.bg-primary {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .accordion-button.animating {
        animation: pulseIn 0.4s ease;
    }

    @keyframes pulseIn {
        0% {
            transform: scale(0.95);
            opacity: 0.5;
        }

        100% {
            transform: scale(1.02);
            opacity: 1;
        }
    }
</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{trans('dashboard/sidebar.employee_status_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.employees.status')}}">{{
                    trans('dashboard/sidebar.employee_status_title') }}</a>
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
                    {{ trans('dashboard/sidebar.employee_status_title') . '-' . $employee?->name_ar }}
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        @foreach($tabs as $tab)
                        <li class="nav-item">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#tab-{{ $tab->key() }}-{{ $employee->id }}">
                                {{ $tab->title() }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content mt-3">
                        @foreach($tabs as $tab)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $tab->key() }}-{{ $employee->id }}">
                            <div class="p-3 border rounded">
                                <h5>{{ $tab->title() }}</h5>
                                @include('dashboard.admin.employees.btn.status.tabs.filter')
                                <hr>
                                <div class="table-responsive">
                                    @include('dashboard.admin.employees.btn.status.tabs.table')
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
    </div>
    @endsection

    @push('js')
