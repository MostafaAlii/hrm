<div class="filters-container">
    <!-- الصف الأول -->
    <div class="row g-3 align-items-end mb-3">
        <!-- فلتر كود الموظف -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_code_checkbox" name="filter_by_code"
                        value="1">
                    <label class="form-check-label" for="filter_by_code_checkbox">
                        كود الموظف
                    </label>
                </div>

                <div id="codeRangeFields" class="filter-fields mt-2" style="display: none;">
                    <div class="row g-2">
                        <div class="col">
                            <label for="code_from" class="form-label mb-0">من</label>
                            <input type="number" name="code_from" id="code_from" class="form-control form-control-sm"
                                placeholder="من">
                        </div>
                        <div class="col">
                            <label for="code_to" class="form-label mb-0">إلى</label>
                            <input type="number" name="code_to" id="code_to" class="form-control form-control-sm"
                                placeholder="إلى">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- فلتر تاريخ التعيين -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_hiring_date_checkbox"
                        name="filter_by_hiring_date" value="1">
                    <label class="form-check-label" for="filter_by_hiring_date_checkbox">
                        تاريخ التعيين
                    </label>
                </div>

                <div id="hiringDateFields" class="filter-fields mt-2" style="display: none;">
                    <div class="row g-2">
                        <div class="col">
                            <label for="hiring_date_from" class="form-label mb-0">من</label>
                            <input type="date" name="hiring_date_from" id="hiring_date_from"
                                class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label for="hiring_date_to" class="form-label mb-0">إلى</label>
                            <input type="date" name="hiring_date_to" id="hiring_date_to"
                                class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- فلتر الاسم (مثال إضافي) -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_name_checkbox" name="filter_by_name"
                        value="1">
                    <label class="form-check-label" for="filter_by_name_checkbox">
                        اسم الموظف
                    </label>
                </div>

                <div id="nameFields" class="filter-fields mt-2" style="display: none;">
                    <input type="text" name="employee_name" id="employee_name" class="form-control form-control-sm"
                        placeholder="ادخل الاسم">
                </div>
            </div>
        </div>

        <!-- فلتر الوردية (shiftType) -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_shift_type_checkbox"
                        name="filter_by_shift_type" value="1">
                    <label class="form-check-label" for="filter_by_shift_type_checkbox">
                        الوردية
                    </label>
                </div>

                <div id="shiftTypeFields" class="filter-fields mt-2" style="display: none;">
                    <select name="shift_type_id" id="shift_type" class="form-select form-select-sm">
                        <option value="">اختر الوردية</option>
                        @foreach(all_shift_type_options() as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- فلتر الراتب (مثال إضافي) -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_salary_checkbox"
                        name="filter_by_salary" value="1">
                    <label class="form-check-label" for="filter_by_salary_checkbox">
                        الراتب
                    </label>
                </div>

                <div id="salaryFields" class="filter-fields mt-2" style="display: none;">
                    <div class="row g-2">
                        <div class="col">
                            <label for="salary_from" class="form-label mb-0">من</label>
                            <input type="number" name="salary_from" id="salary_from"
                                class="form-control form-control-sm" placeholder="من">
                        </div>
                        <div class="col">
                            <label for="salary_to" class="form-label mb-0">إلى</label>
                            <input type="number" name="salary_to" id="salary_to" class="form-control form-control-sm"
                                placeholder="إلى">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الصف الثاني (إذا زاد عدد الفلاتر عن 5) -->
    <!--
    <div class="row g-3 align-items-end mb-3">
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_status_checkbox" name="filter_by_status" value="1">
                    <label class="form-check-label" for="filter_by_status_checkbox">
                        الحالة
                    </label>
                </div>
                <div id="statusFields" class="filter-fields mt-2" style="display: none;">
                    <select name="status" id="status" class="form-select form-select-sm">
                        <option value="">اختر الحالة</option>
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    -->
</div>

<hr class="my-3">

<style>
    .filter-group {
        padding: 10px;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    .filter-fields {
        transition: all 0.3s ease;
    }

    .form-check {
        margin-bottom: 0;
    }
</style>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // تهيئة جميع فلاتر البحث
        initCodeFilter();
        initHiringDateFilter();
        initNameFilter();
        initShiftTypeFilter();
        initSalaryFilter();
        // initStatusFilter(); // إذا أضفت فلتر الحالة
    });

    // دالة خاصة بفلتر كود الموظف
    function initCodeFilter() {
        const checkbox = document.getElementById('filter_by_code_checkbox');
        const rangeContainer = document.getElementById('codeRangeFields');
        const fromInput = document.getElementById('code_from');
        const toInput = document.getElementById('code_to');

        checkbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, rangeContainer, fromInput, toInput);
        });

        if (checkbox.checked) {
            toggleFilterFields(true, rangeContainer, fromInput, toInput);
        }
    }

    // دالة خاصة بفلتر تاريخ التعيين
    function initHiringDateFilter() {
        const hiringCheckbox = document.getElementById('filter_by_hiring_date_checkbox');
        const hiringDateFields = document.getElementById('hiringDateFields');
        const hiringFrom = document.getElementById('hiring_date_from');
        const hiringTo = document.getElementById('hiring_date_to');

        hiringCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, hiringDateFields, hiringFrom, hiringTo);
        });

        if (hiringCheckbox.checked) {
            toggleFilterFields(true, hiringDateFields, hiringFrom, hiringTo);
        }
    }

    // دالة خاصة بفلتر الاسم
    function initNameFilter() {
        const nameCheckbox = document.getElementById('filter_by_name_checkbox');
        const nameFields = document.getElementById('nameFields');
        const nameInput = document.getElementById('employee_name');

        nameCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, nameFields, nameInput);
        });

        if (nameCheckbox.checked) {
            toggleFilterFields(true, nameFields, nameInput);
        }
    }

    // دالة خاصة بفلتر الوردية
    function initShiftTypeFilter() {
        const shiftTypeCheckbox = document.getElementById('filter_by_shift_type_checkbox');
        const shiftTypeFields = document.getElementById('shiftTypeFields');
        const shiftTypeSelect = document.getElementById('shift_type');

        shiftTypeCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, shiftTypeFields, shiftTypeSelect);
        });

        if (shiftTypeCheckbox.checked) {
            toggleFilterFields(true, shiftTypeFields, shiftTypeSelect);
        }
    }

    // دالة خاصة بفلتر الراتب
    function initSalaryFilter() {
        const salaryCheckbox = document.getElementById('filter_by_salary_checkbox');
        const salaryFields = document.getElementById('salaryFields');
        const salaryFrom = document.getElementById('salary_from');
        const salaryTo = document.getElementById('salary_to');

        salaryCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, salaryFields, salaryFrom, salaryTo);
        });

        if (salaryCheckbox.checked) {
            toggleFilterFields(true, salaryFields, salaryFrom, salaryTo);
        }
    }

    // دالة عامة للتحكم في إظهار/إخفاء حقول الفلتر
    function toggleFilterFields(isChecked, container, ...inputs) {
        if (isChecked) {
            container.style.display = 'block';
            inputs.forEach(input => {
                if (input) input.required = true;
            });
        } else {
            container.style.display = 'none';
            inputs.forEach(input => {
                if (input) input.required = false;
            });
        }
    }
</script>
@endpush
