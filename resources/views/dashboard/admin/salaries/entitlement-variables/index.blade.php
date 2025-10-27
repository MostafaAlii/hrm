{{-- resources/views/dashboard/admin/settings/entitlement-variables/index.blade.php --}}
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
                <a href="{{route('admin.entitlement-variables.index')}}">{{ $title }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">{{ $title }}</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createEntitlementVariableModal">
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
<div class="modal fade" id="createEntitlementVariableModal" tabindex="-1"
    aria-labelledby="createEntitlementVariableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEntitlementVariableModalLabel">إضافة متغير استحقاق</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.entitlement-variables.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- الصف الأول -->
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>

                        <!-- الصف الثاني -->
                        <div class="col-md-6">
                            <label class="form-label">الوصف إنجليزي</label>
                            <input type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control">
                        </div>

                        <!-- الصف الثالث -->
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="entitlement_category_id" class="form-control">
                                <option value="">اختر النوع</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">قيمة النوع</label>
                            <input type="text" name="category_value" class="form-control">
                        </div>

                        <!-- ✅ نضيف هنا -->
                        <div class="col-md-6">
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

                        <div class="col-md-6">
                            <label class="form-label">كود منظومة الضرائب</label>
                            <input type="text" name="tax_system_code" class="form-control">
                        </div>

                        <!-- الصف الرابع -->
                        <div class="col-md-6">
                            <label class="form-label">نوع الإيراد</label>
                            <select name="revenue_type_id" class="form-control">
                                <option value="">اختر نوع الإيراد</option>
                                @foreach($revenueTypes as $revenueType)
                                <option value="{{ $revenueType->id }}">{{ $revenueType->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">طبيعة الاستحقاق <span class="text-danger">*</span></label>
                            <select name="nature" class="form-control" required>
                                <option value="fixed">ثابت</option>
                                <option value="monthly">شهري</option>
                            </select>
                        </div>

                        <!-- Checkboxes - الصف الأول -->
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="affected_by_deductions"
                                    id="affected_by_deductions" value="1">
                                <label class="form-check-label" for="affected_by_deductions">يتأثر بالاستقطاعات</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="not_affected_by_work_days"
                                    id="not_affected_by_work_days" value="1">
                                <label class="form-check-label" for="not_affected_by_work_days">لا يتأثر بعدد أيام
                                    العمل</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="not_affect_entitlements"
                                    id="not_affect_entitlements" value="1">
                                <label class="form-check-label" for="not_affect_entitlements">لا يؤثر على
                                    الاستحقاقات</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_health_insurance"
                                    id="is_health_insurance" value="1">
                                <label class="form-check-label" for="is_health_insurance">يخضع للتأمين الصحي
                                    الشامل</label>
                            </div>
                        </div>

                        <!-- الضريبة -->
                        <div class="col-md-6">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_taxable" id="is_taxable"
                                    value="1">
                                <label class="form-check-label" for="is_taxable">يخضع للضريبة</label>
                            </div>
                        </div>

                        <!-- حقول الضريبة - ستظهر فقط عند تفعيل الـ checkbox -->
                        <div class="col-md-6 tax-fields" style="display: none;">
                            <label class="form-label">المبلغ المعفى من الضريبة</label>
                            <input type="number" name="tax_exempt_amount" class="form-control" step="0.01" min="0"
                                placeholder="المبلغ المعفى">
                        </div>
                        <div class="col-md-6 tax-fields" style="display: none;">
                            <label class="form-label">أقصى مبلغ خاضع للضريبة</label>
                            <input type="number" name="max_taxable_amount" class="form-control" step="0.01" min="0"
                                placeholder="أقصى مبلغ خاضع">
                        </div>

                        <!-- الحدود -->
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_min_limit" id="has_min_limit"
                                    value="1">
                                <label class="form-check-label" for="has_min_limit">الحد الأدنى</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_max_limit" id="has_max_limit"
                                    value="1">
                                <label class="form-check-label" for="has_max_limit">الحد الأقصى</label>
                            </div>
                        </div>

                        <!-- حقول قيم الحدود - ستظهر فقط عند تفعيل الـ checkbox -->
                        <div class="col-md-6 min-limit-field" style="display: none;">
                            <label class="form-label">قيمة الحد الأدنى</label>
                            <input type="number" name="min_limit_value" class="form-control" step="0.01" min="0"
                                placeholder="أدخل قيمة الحد الأدنى">
                        </div>
                        <div class="col-md-6 max-limit-field" style="display: none;">
                            <label class="form-label">قيمة الحد الأقصى</label>
                            <input type="number" name="max_limit_value" class="form-control" step="0.01" min="0"
                                placeholder="أدخل قيمة الحد الأقصى">
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
        // التحكم في إظهار/إخفاء حقول الضريبة
        const taxableCheckbox = document.getElementById('is_taxable');
        const taxFields = document.querySelectorAll('.tax-fields');

        function toggleTaxFields() {
            if (taxableCheckbox && taxFields) {
                taxFields.forEach(field => {
                    field.style.display = taxableCheckbox.checked ? 'block' : 'none';
                    if (!taxableCheckbox.checked && field.querySelector('input')) {
                        field.querySelector('input').value = '';
                    }
                });
            }
        }

        if (taxableCheckbox) {
            taxableCheckbox.addEventListener('change', toggleTaxFields);
        }

        // التحكم في إظهار/إخفاء حقول الحدود (نفس كود العلاوات)
        const minLimitCheckbox = document.getElementById('has_min_limit');
        const maxLimitCheckbox = document.getElementById('has_max_limit');
        const minLimitField = document.querySelector('.min-limit-field');
        const maxLimitField = document.querySelector('.max-limit-field');

        function toggleLimitField(checkbox, field) {
            if (checkbox && field) {
                if (checkbox.checked) {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                    if (field.querySelector('input')) {
                        field.querySelector('input').value = '';
                    }
                }
            }
        }

        if (minLimitCheckbox && minLimitField) {
            minLimitCheckbox.addEventListener('change', function() {
                toggleLimitField(this, minLimitField);
            });
        }

        if (maxLimitCheckbox && maxLimitField) {
            maxLimitCheckbox.addEventListener('change', function() {
                toggleLimitField(this, maxLimitField);
            });
        }

        // JavaScript ديناميكي لجميع modals التعديل
        function initializeEditModals() {
            document.querySelectorAll('[id^="editEntitlementVariableModal"]').forEach(modal => {
                const recordId = modal.id.replace('editEntitlementVariableModal', '');

                // العناصر داخل هذا الـ modal المحدد
                const taxableCheckbox = document.getElementById('is_taxable_' + recordId);
                const taxFields = modal.querySelectorAll('.tax-fields');
                const minLimitCheckbox = document.getElementById('has_min_limit_' + recordId);
                const maxLimitCheckbox = document.getElementById('has_max_limit_' + recordId);
                const minLimitField = modal.querySelector('.min-limit-field');
                const maxLimitField = modal.querySelector('.max-limit-field');

                // التحكم في حقول الضريبة
                if (taxableCheckbox && taxFields) {
                    taxableCheckbox.addEventListener('change', function() {
                        taxFields.forEach(field => {
                            field.style.display = this.checked ? 'block' : 'none';
                            if (!this.checked && field.querySelector('input')) {
                                field.querySelector('input').value = '';
                            }
                        });
                    });
                }

                // التحكم في حقول الحدود
                if (minLimitCheckbox && minLimitField) {
                    minLimitCheckbox.addEventListener('change', function() {
                        toggleLimitField(this, minLimitField);
                    });
                }

                if (maxLimitCheckbox && maxLimitField) {
                    maxLimitCheckbox.addEventListener('change', function() {
                        toggleLimitField(this, maxLimitField);
                    });
                }
            });
        }

        // التهيئة الأولية وإعادة التهيئة
        initializeEditModals();
        document.addEventListener('draw.dt', () => setTimeout(initializeEditModals, 100));
        document.addEventListener('show.bs.modal', () => setTimeout(initializeEditModals, 100));
    });
</script>
@endpush
