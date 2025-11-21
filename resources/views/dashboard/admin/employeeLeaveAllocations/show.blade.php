@extends('dashboard.layouts.master')
@section('css')
<style>
    #branches_datatable tbody td,
    #branches_datatable thead th {
        text-align: center !important;
    }

    #branches_datatable .dt-left,
    #branches_datatable .dt-right {
        text-align: center !important;
    }
</style>
@endsection

@section('title')
{{ $title . ' - ' . ($emp_record?->code ?? '-') }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">تخصيص اجازات الموظف -  {{ $emp_record?->name_ar ?? '-' }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.employee-leave-allocation.index')}}">
                    تخصيص اجازات الموظف
                </a>
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
                    تخصيص اجازات الموظف
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div style="width: 70%; max-width: 700px;">
                            <!-- السطر الأول: الكود + الاسم -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">الكود</label>
                                    <input type="text" class="form-control text-center" value="{{ $emp_record->code }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">الاسم</label>
                                    <input type="text" class="form-control text-center" value="{{ $emp_record->name_ar }}" readonly>
                                </div>
                            </div>
                            <!-- السطر الثاني: القسم + الوظيفة -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">القسم</label>
                                    <input type="text" class="form-control text-center" value="{{ $emp_record->section?->name }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">الوظيفة</label>
                                    <input type="text" class="form-control text-center" value="{{ $emp_record->jobCategory?->name }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-success btn-lg px-5" data-bs-toggle="modal" data-bs-target="#addLeaveAllocationModal">
                            <i class="fas fa-plus"></i> إضافة تخصيص إجازة
                        </button>
                        @include('dashboard.admin.employeeLeaveAllocations.btn.show.btn.create')
                    </div>
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
@endpush
