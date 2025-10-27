{{-- resources/views/dashboard/admin/settings/deduction-variables/index.blade.php --}}
@extends('dashboard.layouts.master')
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
                <a href="{{route('admin.deduction-variables.index')}}">{{ $title }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">{{ $title }}</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createDeductionVariableModal">
                        <i class="fa fa-plus"></i> إضافة جديد
                    </button>
                </div>
                <div class="card-body">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal الإضافة -->
<div class="modal fade" id="createDeductionVariableModal" tabindex="-1"
    aria-labelledby="createDeductionVariableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDeductionVariableModalLabel">إضافة متغير استقطاع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.deduction-variables.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- الصف الأول -->
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>

                        <!-- الصف الثاني -->
                        <div class="col-md-6">
                            <label class="form-label">الاسم إنجليزي</label>
                            <input type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control">
                        </div>

                        <!-- الصف الثالث -->
                        <div class="col-md-4">
                            <label class="form-label">النوع</label>
                            <select name="deduction_category_id" class="form-control">
                                <option value="">اختر النوع</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">القيمة</label>
                            <input type="number" name="value" class="form-control" step="0.01" min="0" placeholder="0.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">علاقة الاستحقاق</label>
                            <select name="entitlement_type_relation_id" class="form-control">
                                <option value="">اختر علاقة الاستحقاق</option>
                                @foreach($entitlementRelations as $relation)
                                <option value="{{ $relation->id }}">
                                    {{ $relation->code }} - {{ $relation->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- الصف الرابع -->
                        <div class="col-md-6">
                            <label class="form-label">كود منظومة الضرائب</label>
                            <input type="text" name="tax_system_code" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نوع الاستقطاع</label>
                            <select name="deduction_type_id" class="form-control">
                                <option value="">اختر نوع الاستقطاع</option>
                                @foreach($deductionTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- طبيعة الاستقطاع - Checkboxes -->
                        <div class="col-md-6">
                            <label class="form-label">طبيعة الاستقطاع</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="is_fixed" id="is_fixed"
                                        value="1" checked>
                                    <label class="form-check-label" for="is_fixed">ثابت</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="is_monthly" id="is_monthly"
                                        value="1">
                                    <label class="form-check-label" for="is_monthly">شهري</label>
                                </div>
                            </div>
                        </div>

                        <!-- Checkboxes الأخرى -->
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="is_taxable" id="is_taxable"
                                    value="1">
                                <label class="form-check-label" for="is_taxable">يخضع للضريبة</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="affects_bonus" id="affects_bonus"
                                    value="1">
                                <label class="form-check-label" for="affects_bonus">يؤثر على المكافأة</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="not_affect_salary"
                                    id="not_affect_salary" value="1">
                                <label class="form-check-label" for="not_affect_salary">لا يؤثر على المرتب</label>
                            </div>
                        </div>

                        <!-- الحالة -->
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="is_active">نشط</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
{!! $dataTable->scripts() !!}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fixedCheckbox = document.getElementById('is_fixed');
        const monthlyCheckbox = document.getElementById('is_monthly');
    });
</script>
@endpush
