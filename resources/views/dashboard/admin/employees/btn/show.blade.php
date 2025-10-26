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
    0%   { transform: scale(0.95); opacity: 0.5; }
    100% { transform: scale(1.02); opacity: 1; }
}

</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{trans('dashboard/sidebar.employee_page_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.employee.index')}}">{{
                    trans('dashboard/sidebar.employee_sidebar_title') }}</a>
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
                    {{ trans('dashboard/sidebar.employee_sidebar_title') }}
                </div>
                <div class="card-body">
                    <!-- Start Basic Info Accordion -->
                    <div class="accordion" id="employeeAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBasic">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasic"
                                    aria-expanded="true" aria-controls="collapseBasic">
                                    البيانات الأساسية
                                </button>
                            </h2>
                            <div id="collapseBasic" class="accordion-collapse collapse show" aria-labelledby="headingBasic"
                                data-bs-parent="#employeeAccordion">
                                <div class="accordion-body">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs" id="employeeTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                                type="button" role="tab" aria-controls="basic" aria-selected="true">البيانات
                                                الأساسية</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                                                type="button" role="tab" aria-controls="personal" aria-selected="false">البيانات
                                                الشخصية</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="military-tab" data-bs-toggle="tab" data-bs-target="#military"
                                                type="button" role="tab" aria-controls="military" aria-selected="false">بيانات الخدمة
                                                العسكرية</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contract-tab" data-bs-toggle="tab" data-bs-target="#contract"
                                                type="button" role="tab" aria-controls="contract" aria-selected="false">بيانات
                                                التعاقد</button>
                                        </li>
                                    </ul>
                                    <!-- Tabs Content -->
                                    <div class="p-3 border tab-content border-top-0" id="employeeTabsContent">
                                        <!-- البيانات الأساسية -->
                                        @include('dashboard.admin.employees.btn.tabs.general_info.basic-tab')

                                        <!-- البيانات الشخصية -->
                                        @include('dashboard.admin.employees.btn.tabs.general_info.personal-tab')

                                        <!-- بيانات الخدمة العسكرية -->
                                        @include('dashboard.admin.employees.btn.tabs.general_info.military-tab')
                                        <!-- بيانات التعاقد -->
                                        @include('dashboard.admin.employees.btn.tabs.general_info.contract-tab')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Basic Info Accordion -->
                    <br>
                    <!-- Start Salary Info Accordion -->
                    <div class="accordion" id="salaryEmployeeAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSalary">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSalary" aria-expanded="false" aria-controls="collapseSalary">
                                    بيانات الراتب
                                </button>
                            </h2>
                            <div id="collapseSalary" class="accordion-collapse collapse" aria-labelledby="headingSalary"
                                data-bs-parent="#salaryEmployeeAccordion">
                                <div class="accordion-body">
                                    <!-- Salary Info Content Here -->
                                    <ul class="nav nav-tabs" id="salaryTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="salary-details-tab" data-bs-toggle="tab"
                                                data-bs-target="#salary-details" type="button" role="tab"
                                                aria-controls="salary-details" aria-selected="true">تفاصيل الراتب</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="insurance-history-tab" data-bs-toggle="tab"
                                                data-bs-target="#insurance-history" type="button" role="tab"
                                                aria-controls="insurance-history" aria-selected="false">التامين</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="salary-advance-tab" data-bs-toggle="tab" data-bs-target="#salary-advance"
                                                type="button" role="tab" aria-controls="salary-advance" aria-selected="false">السلف</button>
                                        </li>
                                    </ul>
                                    <div class="p-3 border tab-content border-top-0" id="salaryTabsContent">
                                        <!-- Salary Details Tab -->
                                        @include('dashboard.admin.employees.btn.tabs.salary_info.salary-details-tab')

                                        <!-- Salary History Tab -->
                                        @include('dashboard.admin.employees.btn.tabs.salary_info.insurance-tab')

                                        <!-- Salary Advance Tab -->
                                        @include('dashboard.admin.employees.btn.tabs.salary_info.salary-advance-tab')

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Salary Info Accordion -->
                    <br>
                    <!-- Start Vacation Requests Accordion -->
                    <div class="accordion" id="vactionEmployeeAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingVacation">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseVacation" aria-expanded="false" aria-controls="collapseVacation">
                                    بيانات الاجازات
                                </button>
                            </h2>
                            <div id="collapseVacation" class="accordion-collapse collapse" aria-labelledby="headingVacation"
                                data-bs-parent="#vactionEmployeeAccordion">
                                <div class="accordion-body">
                                    <!-- Vacation Info Content Here -->
                                    <ul class="nav nav-tabs" id="employeeVacationTabsNav" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="employee-vacations-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-vacation" type="button" role="tab"
                                                aria-controls="employee-vacation" aria-selected="true">
                                                اجازات الموظف
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-vacation-details-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-vacation-details" type="button" role="tab"
                                                aria-controls="employee-vacation-details" aria-selected="false">
                                                رصيد اجازات الموظف
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="p-3 border tab-content border-top-0" id="employeeVacationTabsContent">
                                            @include('dashboard.admin.employees.btn.tabs.vacation_info.employee-vacations-tab')
                                            @include('dashboard.admin.employees.btn.tabs.vacation_info.employee-vacation-details-tab')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Vacation Requests Accordion -->
                    <br>
                    <!-- Start Other Information Accordion -->
                    <div class="accordion" id="otherInformationEmployeeAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOtherInformation">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOtherInformation" aria-expanded="false" aria-controls="collapseOtherInformation">
                                    معلومات اخرى
                                </button>
                            </h2>
                            <div id="collapseOtherInformation" class="accordion-collapse collapse" aria-labelledby="headingOtherInformation"
                                data-bs-parent="#otherInformationEmployeeAccordion">
                                <div class="accordion-body">
                                    <!-- Vacation Info Content Here -->
                                    <ul class="nav nav-tabs" id="employeeOtherInformationTabsNav" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="employee-qualifications-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-qualification" type="button" role="tab"
                                                aria-controls="employee-qualification" aria-selected="true">
                                                الموهل
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-family-details-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-family-details" type="button" role="tab"
                                                aria-controls="employee-family-details" aria-selected="false">
                                                العوائل
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-emergency-details-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-emergency-details" type="button" role="tab" aria-controls="employee-emergency-details"
                                                aria-selected="false">
                                                الطوارى
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-trainings-tab" data-bs-toggle="tab" data-bs-target="#employee-trainings"
                                                type="button" role="tab" aria-controls="employee-trainings" aria-selected="false">
                                                الدورات التدريبية
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-licenses-tab" data-bs-toggle="tab" data-bs-target="#employee-licenses"
                                                type="button" role="tab" aria-controls="employee-licenses" aria-selected="false">
                                                التراخيص
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-employment-documents-tab" data-bs-toggle="tab"
                                                data-bs-target="#employee-employment-documents" type="button" role="tab"
                                                aria-controls="employee-employment-documents" aria-selected="false">
                                                مصوغات التعيين
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-experiences-tab" data-bs-toggle="tab" data-bs-target="#employee-experiences"
                                                type="button" role="tab" aria-controls="employee-experiences" aria-selected="false">
                                                الخبرات
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="employee-benefits-tab" data-bs-toggle="tab" data-bs-target="#employee-benefits"
                                                type="button" role="tab" aria-controls="employee-benefits" aria-selected="false">
                                                مزايا الموظف
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="p-3 border tab-content border-top-0" id="employeeOtherInformationTabsContent">
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-qualification-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-family-details-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-emergency-details-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-tranings-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-licenses-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-employment-documents-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-employment-experiences-tab')
                                        @include('dashboard.admin.employees.btn.tabs.other_info.employee-employment-benefits-tab')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Other Information Accordion -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
<script>
    function previewImage(inputId, previewId) {
    let input = document.getElementById(inputId);
    let preview = document.getElementById(previewId);

    input.addEventListener("change", function () {
        let file = input.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    });
}
function openImageModal(src, title) {
    if (src) {
        let popupImage = document.getElementById("popupImage");
        let modalTitle = document.getElementById("imageModalLabel");
        popupImage.src = src;
        modalTitle.innerText = title;
        let imageModal = new bootstrap.Modal(document.getElementById("imageModal"));
        imageModal.show();
    }
}
previewImage("employeeInput", "employeePreview");
previewImage("employeeMilitaryCertificateInput", "employeeMilitaryCertificatePreview");
document.addEventListener("shown.bs.collapse", function (event) {
    let accordion = event.target.closest(".accordion");
    if (accordion) {
        accordion.querySelectorAll(".accordion-button").forEach(btn => {
            btn.classList.remove("bg-primary", "text-white", "animating");
        });

        let btn = event.target.previousElementSibling.querySelector(".accordion-button");
        if (btn) {
            btn.classList.add("bg-primary", "text-white", "animating");

            // شيل كلاس الأنيميشن بعد ما يخلص
            setTimeout(() => btn.classList.remove("animating"), 400);
        }
    }
});

document.addEventListener("hidden.bs.collapse", function (event) {
    let accordion = event.target.closest(".accordion");
    if (accordion) {
        let btn = event.target.previousElementSibling.querySelector(".accordion-button");
        if (btn) {
            btn.classList.remove("bg-primary", "text-white", "animating");
        }
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#basicModal .btn.btn-primary').addEventListener('click', function () {
        // خُد القيم من داخل المودال نفسه (عشان لو فيه أكتر من مودال)
        let modal = document.getElementById('basicModal');
        let allowance_variable_id = modal.querySelector('#allowanceSelect').value;
        let basic_salary = modal.querySelector('#basicSalary').value.trim();

        console.log('allowance_variable_id:', allowance_variable_id);
        console.log('basic_salary:', basic_salary);

        if (!allowance_variable_id || basic_salary === '' || basic_salary === '0') {
            alert('من فضلك اختر العلاوة وأدخل قيمة الأساسي');
            return;
        }

        fetch('{{ route("admin.employee.basic_salary.store", $record->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                allowance_variable_id,
                basic_salary
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                let modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            } else {
                alert('حدث خطأ أثناء الحفظ');
            }
        })
        .catch(error => {
            console.error(error);
            alert('حدث خطأ أثناء الاتصال بالسيرفر');
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $('#isTaxable').on('change', function() {
        const isTaxable = $(this).is(':checked') ? 1 : 0;
        const employeeId = "{{ $record->id }}"; // تأكد إن عندك $record->id
        const url = "{{ route('admin.employee.toggle_tax', ':id') }}".replace(':id', employeeId);

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_taxable: isTaxable
            },
            beforeSend: function() {
                // ممكن تحط لودينج بسيط
                $('#isTaxable').prop('disabled', true);
            },
            success: function(response) {
                $('#isTaxable').prop('disabled', false);

                if (response.success) {
                    const data = response.data;

                    // تحديث الحقول مباشرة
                    $('#taxableAmount').val(data.taxable_amount);
                    $('#taxes').val(data.tax_amount);
                    $('#netAfterDeductions').val(data.net_salary);

                    // عرض رسالة نجاح
                    Swal.fire({
                        icon: 'success',
                        title: 'تم تحديث الحالة',
                        html: `
                            💰 المبلغ الخاضع للضريبة: ${data.taxable_amount} جنيه<br>
                            📉 قيمة الضريبة الشهرية: ${data.tax_amount} جنيه<br>
                            ✅ صافي المرتب بعد الضريبة: ${data.net_salary} جنيه
                        `,
                        confirmButtonText: 'تم',
                        timer: 4000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: response.message,
                    });
                }
            },
            error: function() {
                $('#isTaxable').prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ في الاتصال',
                    text: 'حدث خطأ أثناء تحديث الحالة',
                });
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#allowanceModal .btn.btn-success').addEventListener('click', function () {
        let modal = document.getElementById('allowanceModal');
        let allowance_variable_id = modal.querySelector('#allowanceSelect').value;
        let amount = modal.querySelector('#allowanceAmount').value.trim();

        if (!allowance_variable_id || amount === '' || amount === '0') {
            alert('من فضلك اختر العلاوة وأدخل قيمتها');
            return;
        }

        fetch('{{ route("admin.employee.allowance.store", $record->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                allowance_variable_id,
                amount
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                let modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            } else {
                alert('حدث خطأ أثناء الحفظ');
            }
        })
        .catch(error => {
            console.error(error);
            alert('حدث خطأ أثناء الاتصال بالسيرفر');
        });
    });
});
</script>

<script>
document.getElementById('saveEntitlement').addEventListener('click', function () {
    let entitlement_variable_id = document.getElementById('entitlementSelect').value;
    let amount = document.getElementById('entitlementAmount').value;

    if (!entitlement_variable_id || !amount) {
        alert('من فضلك اختر الاستحقاق وأدخل القيمة');
        return;
    }

    fetch('{{ route("admin.employee.entitlement.store", $record->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            entitlement_variable_id,
            amount
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            let modal = bootstrap.Modal.getInstance(document.getElementById('entitlementModal'));
            modal.hide();
        } else {
            alert('حدث خطأ أثناء الحفظ');
        }
    })
    .catch(err => {
        console.error(err);
        alert('حدث خطأ أثناء الاتصال بالسيرفر');
    });
});
</script>

<script>
    document.getElementById('saveDeduction').addEventListener('click', function () {
        let deduction_variable_id = document.getElementById('deductionSelect').value;
        let amount = document.getElementById('deductionAmount').value;

        if (!deduction_variable_id || !amount) {
            alert('من فضلك اختر الاستقطاع وأدخل القيمة');
            return;
        }

        fetch('{{ route("admin.employee.deduction.store", $record->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                deduction_variable_id,
                amount
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                let modal = bootstrap.Modal.getInstance(document.getElementById('deductionModal'));
                modal.hide();
            } else {
                alert('حدث خطأ أثناء الحفظ');
            }
        })
        .catch(err => {
            console.error(err);
            alert('حدث خطأ أثناء الاتصال بالسيرفر');
        });
    });
</script>
<script>
    document.getElementById('saveVariableInsurance').addEventListener('click', function () {
        let type = document.getElementById('insuranceType').value;
        let value = document.getElementById('insuranceValue').value;

        if (!type || !value) {
            alert('من فضلك اختر النوع وأدخل القيمة');
            return;
        }

        fetch('{{ route("admin.employee.variable_insurance.store", $record->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ type, value })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                let modal = bootstrap.Modal.getInstance(document.getElementById('variableInsuranceModal'));
                modal.hide();
            } else {
                alert('حدث خطأ أثناء الحفظ');
            }
        })
        .catch(err => {
            console.error(err);
            alert('حدث خطأ أثناء الاتصال بالسيرفر');
        });
    });
</script>
@endpush
