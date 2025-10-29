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

        <!-- فلتر مكان استلام المرتب -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_salary_place_checkbox"
                        name="filter_by_salary_place" value="1">
                    <label class="form-check-label" for="filter_by_salary_place_checkbox">
                        مكان استلام المرتب
                    </label>
                </div>

                <div id="salaryPlaceFields" class="filter-fields mt-2" style="display: none;">
                    <select name="salary_place_id" id="salary_place_id" class="form-select form-select-sm">
                        <option value="">اختر مكان الاستلام</option>
                        @foreach(salary_place_options() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
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

        <!-- فلتر الإدارة -->
        <div class="col-md">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_department_checkbox"
                        name="filter_by_department" value="1">
                    <label class="form-check-label" for="filter_by_department_checkbox">
                        الإدارة
                    </label>
                </div>

                <div id="departmentFields" class="filter-fields mt-2" style="display: none;">
                    <select name="department_id" id="department_id" class="form-select form-select-sm">
                        <option value="">اختر الإدارة</option>
                        @foreach(department_options() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 align-items-end mb-3">
        <!-- فلتر الأقسام -->
        <div class="col-md-2">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_section_checkbox" name="filter_by_section"
                        value="1">
                    <label class="form-check-label" for="filter_by_section_checkbox">
                        القسم
                    </label>
                </div>

                <div id="sectionFields" class="filter-fields mt-2" style="display: none;">
                    <select name="section_id" id="section_id" class="form-select form-select-sm">
                        <option value="">اختر القسم</option>
                        @foreach(section_options() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- فلتر حالة العمل -->
        <div class="col-md-2">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_working_status_checkbox"
                        name="filter_by_working_status" value="1">
                    <label class="form-check-label" for="filter_by_working_status_checkbox">
                        حالة العمل
                    </label>
                </div>

                <div id="workingStatusFields" class="filter-fields mt-2" style="display: none;">
                    <select name="working_status" id="working_status" class="form-select form-select-sm">
                        <option value="">اختر حالة العمل</option>
                        @foreach(working_status_options() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- فلتر حالة التأمين -->
        <div class="col-md-2">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_insurance_checkbox" name="filter_by_insurance"
                        value="1">
                    <label class="form-check-label" for="filter_by_insurance_checkbox">
                        مؤمن عليه
                    </label>
                </div>

                <div id="insuranceFields" class="filter-fields mt-2" style="display: none;">
                    <select name="is_insured" id="is_insured" class="form-select form-select-sm">
                        <option value="">اختر حالة التأمين</option>
                        @foreach(insurance_status_options() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- فلتر الفئة الوظيفية -->
        <div class="col-md-2">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_job_category_checkbox"
                        name="filter_by_job_category" value="1">
                    <label class="form-check-label" for="filter_by_job_category_checkbox">
                        الوظيفه
                    </label>
                </div>

                <div id="jobCategoryFields" class="filter-fields mt-2" style="display: none;">
                    <select name="job_category_id" id="job_category_id" class="form-select form-select-sm">
                        <option value="">اختر الفئة الوظيفية</option>
                        @foreach(job_category_options() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- فلتر المستوى -->
        <div class="col-md-2">
            <div class="filter-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="filter_by_level_checkbox" name="filter_by_level"
                        value="1">
                    <label class="form-check-label" for="filter_by_level_checkbox">
                        المستوى
                    </label>
                </div>

                <div id="levelFields" class="filter-fields mt-2" style="display: none;">
                    <select name="level_id" id="level_id" class="form-select form-select-sm">
                        <option value="">اختر المستوى</option>
                        @foreach(level_options() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
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
        initSalaryPlaceFilter();
        initShiftTypeFilter();
        initDepartmentFilter();
        initSectionFilter();
        initWorkingStatusFilter();
        initInsuranceFilter();
        initJobCategoryFilter();
        initLevelFilter();
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

    // دالة خاصة بفلتر مكان استلام المرتب
    function initSalaryPlaceFilter() {
        const salaryPlaceCheckbox = document.getElementById('filter_by_salary_place_checkbox');
        const salaryPlaceFields = document.getElementById('salaryPlaceFields');
        const salaryPlaceSelect = document.getElementById('salary_place_id');

        salaryPlaceCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, salaryPlaceFields, salaryPlaceSelect);
        });

        if (salaryPlaceCheckbox.checked) {
            toggleFilterFields(true, salaryPlaceFields, salaryPlaceSelect);
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

    // دالة خاصة بفلتر الإدارة
    function initDepartmentFilter() {
        const departmentCheckbox = document.getElementById('filter_by_department_checkbox');
        const departmentFields = document.getElementById('departmentFields');
        const departmentSelect = document.getElementById('department_id');

        departmentCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, departmentFields, departmentSelect);
        });

        if (departmentCheckbox.checked) {
            toggleFilterFields(true, departmentFields, departmentSelect);
        }
    }

    // دالة خاصة بفلتر الأقسام
    function initSectionFilter() {
        const sectionCheckbox = document.getElementById('filter_by_section_checkbox');
        const sectionFields = document.getElementById('sectionFields');
        const sectionSelect = document.getElementById('section_id');

        sectionCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, sectionFields, sectionSelect);
        });

        if (sectionCheckbox.checked) {
            toggleFilterFields(true, sectionFields, sectionSelect);
        }
    }

    // دالة خاصة بفلتر حالة العمل
    function initWorkingStatusFilter() {
        const workingStatusCheckbox = document.getElementById('filter_by_working_status_checkbox');
        const workingStatusFields = document.getElementById('workingStatusFields');
        const workingStatusSelect = document.getElementById('working_status');

        workingStatusCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, workingStatusFields, workingStatusSelect);
        });

        if (workingStatusCheckbox.checked) {
            toggleFilterFields(true, workingStatusFields, workingStatusSelect);
        }
    }

    // دالة خاصة بفلتر حالة التأمين مؤمن عليه - غير مؤمن عليه
    function initInsuranceFilter() {
        const insuranceCheckbox = document.getElementById('filter_by_insurance_checkbox');
        const insuranceFields = document.getElementById('insuranceFields');
        const insuranceSelect = document.getElementById('is_insured');

        insuranceCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, insuranceFields, insuranceSelect);
        });

        if (insuranceCheckbox.checked) {
            toggleFilterFields(true, insuranceFields, insuranceSelect);
        }
    }

    // دالة خاصة بفلتر الفئة الوظيفية
    function initJobCategoryFilter() {
        const jobCategoryCheckbox = document.getElementById('filter_by_job_category_checkbox');
        const jobCategoryFields = document.getElementById('jobCategoryFields');
        const jobCategorySelect = document.getElementById('job_category_id');

        jobCategoryCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, jobCategoryFields, jobCategorySelect);
        });

        if (jobCategoryCheckbox.checked) {
            toggleFilterFields(true, jobCategoryFields, jobCategorySelect);
        }
    }

    // دالة خاصة بفلتر المستوى
    function initLevelFilter() {
        const levelCheckbox = document.getElementById('filter_by_level_checkbox');
        const levelFields = document.getElementById('levelFields');
        const levelSelect = document.getElementById('level_id');

        levelCheckbox.addEventListener('change', function () {
            toggleFilterFields(this.checked, levelFields, levelSelect);
        });

        if (levelCheckbox.checked) {
            toggleFilterFields(true, levelFields, levelSelect);
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
