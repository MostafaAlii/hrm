@extends('dashboard.layouts.master')
@section('css')
<style>
    .info-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item strong {
        color: #495057;
    }

    .info-item span {
        color: #28a745;
        font-weight: bold;
    }
</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{ $title }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.insurance-settings.index')}}">{{ $title }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="ti ti-layout-2"></i>
                    </span>
                    {{ $title }}
                </div>
                <div class="card-body">
                    <form action="{{ $insuranceSetting->exists
                                            ? route('admin.insurance-settings.update', $insuranceSetting->id)
                                            : route('admin.insurance-settings.store') }}" method="POST">

                        @csrf

                        <!-- Method Spoofing للتحديث -->
                        {{ $insuranceSetting->exists ? method_field('PUT') : '' }}

                        <div class="row g-3">
                            <!-- أقصى حد لمبلغ التأمين -->
                            <div class="col-md-6">
                                <label class="form-label">أقصى حد لمبلغ التأمين <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="max_insurance_amount" class="form-control" step="0.01" min="0"
                                        value="{{ old('max_insurance_amount', $insuranceSetting->max_insurance_amount ?? 0) }}" required>
                                    <span class="input-group-text">$</span>
                                </div>
                                @error('max_insurance_amount')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- أقل حد لمبلغ التأمين -->
                            <div class="col-md-6">
                                <label class="form-label">أقل حد لمبلغ التأمين <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="min_insurance_amount" class="form-control" step="0.01" min="0"
                                        value="{{ old('min_insurance_amount', $insuranceSetting->min_insurance_amount ?? 0) }}" required>
                                    <span class="input-group-text">$</span>
                                </div>
                                @error('min_insurance_amount')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- نسبة التأمين المخصومة من الموظف -->
                            <div class="col-md-4">
                                <label class="form-label">نسبة التأمين المخصومة من الموظف <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="employee_deduction_percentage" class="form-control" step="0.01" min="0" max="100"
                                        value="{{ old('employee_deduction_percentage', $insuranceSetting->employee_deduction_percentage ?? 0) }}"
                                        required>
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('employee_deduction_percentage')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- نسبة التأمين المخصومة من الشركة -->
                            <div class="col-md-4">
                                <label class="form-label">نسبة التأمين المخصومة من الشركة <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="company_deduction_percentage" class="form-control" step="0.01" min="0" max="100"
                                        value="{{ old('company_deduction_percentage', $insuranceSetting->company_deduction_percentage ?? 0) }}"
                                        required>
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('company_deduction_percentage')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- نسبة صندوق العاملين -->
                            <div class="col-md-4">
                                <label class="form-label">نسبة صندوق العاملين <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="employees_fund_percentage" class="form-control" step="0.01" min="0" max="100"
                                        value="{{ old('employees_fund_percentage', $insuranceSetting->employees_fund_percentage ?? 0) }}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('employees_fund_percentage')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر الحفظ/التحديث -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i>
                                    {{ $insuranceSetting->exists ? 'تحديث الإعدادات' : 'حفظ الإعدادات' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @isset($insuranceSetting)
            <div class="mt-4 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title">الإعدادات الحالية</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-item">
                                <strong>أقصى حد للتأمين:</strong>
                                <span>${{ number_format($insuranceSetting->max_insurance_amount, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <strong>أقل حد للتأمين:</strong>
                                <span>${{ number_format($insuranceSetting->min_insurance_amount, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <strong>نسبة خصم الموظف:</strong>
                                <span>{{ $insuranceSetting->employee_deduction_percentage }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <strong>نسبة خصم الشركة:</strong>
                                <span>{{ $insuranceSetting->company_deduction_percentage }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <strong>نسبة صندوق العاملين:</strong>
                                <span>{{ $insuranceSetting->employees_fund_percentage }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endisset
        </div>
    </div>
    <!-- End Content -->
</div>
@endsection

@push('js')

@endpush
