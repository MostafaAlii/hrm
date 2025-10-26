{{-- resources/views/dashboard/admin/settings/allowance-variables/index.blade.php --}}
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
                <a href="{{route('admin.allowance-variables.index')}}">{{ $title }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">{{ $title }}</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createAllowanceVariableModal">
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
<div class="modal fade" id="createAllowanceVariableModal" tabindex="-1"
    aria-labelledby="createAllowanceVariableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAllowanceVariableModalLabel">إضافة متغير علاوة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.allowance-variables.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف إنجليزي</label>
                            <input type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="allowance_category_id" class="form-control">
                                <option value="">اختر النوع</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">قيمة النوع</label>
                            <input type="text" name="category_value" class="form-control">
                        </div>

                        


                        <!-- Checkboxes -->
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
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_taxable" id="is_taxable"
                                    value="1">
                                <label class="form-check-label" for="is_taxable">يخضع للضريبة</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_health_insurance"
                                    id="is_health_insurance" value="1">
                                <label class="form-check-label" for="is_health_insurance">يخضع للتأمين الصحي</label>
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
        // دالة عامة للتحقق من النماذج
        function validateAllowanceForm(form, minCheckbox, maxCheckbox) {
            const minLimitValue = form.querySelector('input[name="min_limit_value"]')?.value;
            const maxLimitValue = form.querySelector('input[name="max_limit_value"]')?.value;

            // التحقق فقط إذا كان الـ checkbox مفعل
            if (minCheckbox?.checked && !minLimitValue) {
                alert('يرجى إدخال قيمة للحد الأدنى');
                return false;
            }

            if (maxCheckbox?.checked && !maxLimitValue) {
                alert('يرجى إدخال قيمة للحد الأقصى');
                return false;
            }

            // التحقق من أن الحد الأقصى أكبر من الأدنى فقط إذا كان كلاهما مدخل
            if (minLimitValue && maxLimitValue && parseFloat(minLimitValue) >= parseFloat(maxLimitValue)) {
                alert('قيمة الحد الأقصى يجب أن تكون أكبر من قيمة الحد الأدنى');
                return false;
            }

            return true;
        }

        // JavaScript الخاص بـ modal الإضافة
        const createMinCheckbox = document.getElementById('has_min_limit');
        const createMaxCheckbox = document.getElementById('has_max_limit');
        const createMinField = document.querySelector('.min-limit-field');
        const createMaxField = document.querySelector('.max-limit-field');
        const createForm = document.querySelector('#createAllowanceVariableModal form');

        // التحكم في إظهار/إخفاء الحقول للإضافة
        function toggleCreateLimitField(checkbox, field) {
            if (checkbox && field) {
                field.style.display = checkbox.checked ? 'block' : 'none';
                if (!checkbox.checked && field.querySelector('input')) {
                    field.querySelector('input').value = '';
                }
            }
        }

        if (createMinCheckbox && createMinField) {
            createMinCheckbox.addEventListener('change', () => toggleCreateLimitField(createMinCheckbox, createMinField));
        }

        if (createMaxCheckbox && createMaxField) {
            createMaxCheckbox.addEventListener('change', () => toggleCreateLimitField(createMaxCheckbox, createMaxField));
        }

        if (createForm) {
            createForm.addEventListener('submit', function(e) {
                if (!validateAllowanceForm(this, createMinCheckbox, createMaxCheckbox)) {
                    e.preventDefault();
                }
            });
        }

        // JavaScript ديناميكي لجميع modals التعديل
        function initializeEditModals() {
            document.querySelectorAll('[id^="editAllowanceVariableModal"]').forEach(modal => {
                const recordId = modal.id.replace('editAllowanceVariableModal', '');
                const minCheckbox = document.getElementById('has_min_limit_' + recordId);
                const maxCheckbox = document.getElementById('has_max_limit_' + recordId);
                const minField = modal.querySelector('.min-limit-field');
                const maxField = modal.querySelector('.max-limit-field');
                const editForm = modal.querySelector('form');

                // التحكم في إظهار/إخفاء الحقول للتعديل
                function toggleEditLimitField(checkbox, field) {
                    if (checkbox && field) {
                        field.style.display = checkbox.checked ? 'block' : 'none';
                        if (!checkbox.checked && field.querySelector('input')) {
                            field.querySelector('input').value = '';
                        }
                    }
                }

                if (minCheckbox && minField) {
                    minCheckbox.addEventListener('change', () => toggleEditLimitField(minCheckbox, minField));
                }

                if (maxCheckbox && maxField) {
                    maxCheckbox.addEventListener('change', () => toggleEditLimitField(maxCheckbox, maxField));
                }

                if (editForm) {
                    editForm.addEventListener('submit', function(e) {
                        if (!validateAllowanceForm(this, minCheckbox, maxCheckbox)) {
                            e.preventDefault();
                        }
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
