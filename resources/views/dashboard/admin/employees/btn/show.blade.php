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
                                    <div class="tab-content p-3 border border-top-0" id="employeeTabsContent">
                                        <!-- البيانات الأساسية -->
                                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                            <form action="{{ route('admin.employee.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- البيانات الاساسية -->
                                                <h5 class="mb-3 mt-2 section-title">البيانات الأساسية</h5>
                                                <div class="row">
                                                    <!-- يمين -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">الكود</label>
                                                                <input type="text" name="code" class="form-control" value="{{ old('code', $record->code) }}" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">الباركود</label>
                                                                <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $record->barcode) }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">الاسم بالعربية</label>
                                                                <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $record->name_ar) }}">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">الاسم بالانجليزية</label>
                                                                <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $record->name_en) }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">تاريخ التعيين</label>
                                                                <input type="date" name="hiring_date" class="form-control"
                                                                    value="{{ old('hiring_date', $record->hiring_date?->format('Y-m-d')) }}">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">الحالة</label>
                                                                <input type="text" name="working_status" class="form-control"
                                                                    value="{{ \App\Enums\Employee\WorkingStatus::labels()[$record->working_status->value ?? $record->working_status] ?? '-' }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- شمال -->
                                                    <div class="col-md-6">
                                                        <div class="p-3 mb-3 text-center border rounded">
                                                            <label for="image" class="form-label fw-bold">الصوره</label>
                                                            <input class="form-control" type="file" name="employee" id="employeeInput" accept="image/*">
                                                            <div class="mt-2">
                                                                <img id="employeePreview" src="{{ $record->getMediaUrl('employee', $record, null, 'media', 'employee', true) }}"
                                                                    alt="" width="100" style="cursor: pointer;" onclick="openImageModal(this.src, 'الصوره')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel">عرض الصورة</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="text-center modal-body">
                                                                    <img id="popupImage" src="" class="rounded img-fluid" style="max-width: 100%; max-height: 80vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- بيانات الوظيفة -->
                                                <h5 class="mb-3 mt-4 section-title">بيانات الوظيفة</h5>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">المستوى</label>
                                                        <input type="text" class="form-control" value="{{ $record->level?->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">القسم</label>
                                                        <input type="text" class="form-control" value="{{ $record->section?->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">الوظيفة</label>
                                                        <input type="text" class="form-control" value="{{ $record->jobCategory?->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">جهة العمل</label>
                                                        <input type="text" class="form-control" value="{{ $record->branch?->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">الوردية</label>
                                                        <input type="text" class="form-control" value="{{ $record?->shift?->name }}" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">مكان استلام المرتب</label>
                                                        <input type="text" class="form-control" value="{{ $record->salaryPlace?->name }}" readonly>
                                                    </div>
                                                </div>

                                                <!-- زرار حفظ -->
                                                <div class="mt-4 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-success">حفظ</button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- البيانات الشخصية -->
                                        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                            <form action="{{ route('admin.employee.profile_update', $record->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <h5 class="mb-3 mt-2 section-title">البيانات الشخصية</h5>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">رقم البطاقه / جواز السفر</label>
                                                        <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', $record->identity_number) }}">
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">تاريخ الميلاد</label>
                                                        <input type="date" name="birthday_date" class="form-control"
                                                            value="{{ old('birthday_date', $record->birthday_date?->format('Y-m-d')) }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">النوع</label>
                                                        <select name="gender_id" class="form-select" required>
                                                            <option value="">-- اختر النوع --</option>
                                                            @foreach($genders as $gender)
                                                            <option value="{{ $gender->id }}" {{ $record->gender_id == $gender->id ? 'selected' : '' }}>
                                                                {{ $gender->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">محافظه الميلاد</label>
                                                        <select name="birth_governorate_id" class="form-select" required>
                                                            <option value="">-- اختر المحافظه --</option>
                                                            @foreach($governorates as $governorate)
                                                            <option value="{{ $gender->id }}" {{ $record?->profile?->birth_governorate_id == $governorate->id ? 'selected' : '' }}>
                                                                {{ $governorate->name_ar }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">الجنسيه</label>
                                                            <select name="nationality_id" class="form-select" required>
                                                                <option value="">-- اختر الجنسيه --</option>
                                                                @foreach($nationalities as $nationality)
                                                                <option value="{{ $nationality->id }}" {{ $record->nationality_id == $nationality->id ? 'selected' : '' }}>
                                                                    {{ $nationality->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">الديانه</label>
                                                            <select name="religion_id" class="form-select" required>
                                                                <option value="">-- اختر الديانه --</option>
                                                                @foreach($religions as $religion)
                                                                <option value="{{ $religion->id }}" {{ $record?->profile?->religion_id == $religion->id ? 'selected' : '' }}>
                                                                    {{ $religion->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">الحالة الاجتماعية</label>
                                                            <select name="marital_status" class="form-select" required>
                                                                <option value="">-- اختر الحالة --</option>
                                                                @foreach(\App\Enums\Employee\MaritalStatus::options() as $status)
                                                                <option value="{{ $status['value'] }}" {{ old('marital_status', $record->profile?->marital_status?->value ??
                                                                    $record->profile?->marital_status) == $status['value'] ? 'selected' : '' }}>
                                                                    {{ $status['label'] }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">فصيله الدم</label>
                                                            <select name="blood_type_id" class="form-select" required>
                                                                <option value="">-- اختر الفصيله --</option>
                                                                @foreach($bloodTypes as $bloodType)
                                                                <option value="{{ $bloodType->id }}" {{ $record?->profile?->blood_type_id == $bloodType->id ? 'selected' : '' }}>
                                                                    {{ $bloodType->name_ar }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="mb-3 mt-2 section-title">بيانات العنوان</h5>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">المحافظه</label>
                                                        <select name="address_governorate_id" class="form-select" required>
                                                            <option value="">-- اختر المحافظه --</option>
                                                            @foreach($governorates as $governorate)
                                                            <option value="{{ $governorate->id }}" {{ $record?->profile?->address_governorate_id == $governorate->id ? 'selected' : '' }}>
                                                                {{ $governorate->name_ar }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">المركز / المدينة</label>
                                                        <input type="text" name="address_city" class="form-control"
                                                            value="{{ old('address_city', $record?->profile?->address_city) }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                        <label class="form-label">العنوان</label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ old('address', $record?->profile?->address) }}">
                                                    </div>
                                                </div>
                                                <h5 class="mb-3 mt-2 section-title">بيانات الاتصال</h5>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">تليفون</label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone', $record?->profile?->phone) }}">
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">موبايل 1 / واتس اب</label>
                                                        <input type="text" name="mobile1" class="form-control"
                                                            value="{{ old('mobile1', $record?->profile?->mobile1) }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">فاكس</label>
                                                        <input type="text" name="fax" class="form-control" value="{{ old('fax', $record?->profile?->fax) }}">
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">موبايل 2</label>
                                                        <input type="text" name="mobile2" class="form-control"
                                                            value="{{ old('mobile2', $record?->profile?->mobile2) }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">البريد الالكترونى</label>
                                                        <input type="email" name="email" class="form-control" value="{{ old('email', $record?->profile?->email) }}">
                                                    </div>
                                                </div>
                                                <div class="mt-4 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-success">حفظ</button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- بيانات الخدمة العسكرية -->
                                        <div class="tab-pane fade" id="military" role="tabpanel" aria-labelledby="military-tab">
                                            <form action="{{ route('admin.employee.update_military_service', $record->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="mb-3 col-md-12">
                                                        <label class="form-label d-block">الموقف من التجنيد</label>
                                                        <div class="d-flex flex-wrap gap-3">
                                                            @foreach(\App\Enums\Employee\MilitaryStatus::options() as $status)
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="status_{{ $status['value'] }}"
                                                                    value="{{ $status['value'] }}" {{ old('status', $record->militaryService?->status) ===
                                                                $status['value'] ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="status_{{ $status['value'] }}">
                                                                    {{ $status['label'] }}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- الجزء اليمين -->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">رقم البطاقة العسكرية</label>
                                                            <input type="text" name="military_card_number" class="form-control"
                                                                value="{{ old('military_card_number', $record->militaryService?->military_card_number) }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">تاريخ الصدور</label>
                                                                <input type="date" name="issue_date" class="form-control"
                                                                    value="{{ old('issue_date', $record->militaryService?->issue_date?->format('Y-m-d')) }}">
                                                            </div>

                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">تاريخ الانتهاء</label>
                                                                <input type="date" name="expiry_date" class="form-control"
                                                                    value="{{ old('expiry_date', $record->militaryService?->expiry_date?->format('Y-m-d')) }}">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">رقم الدفعة</label>
                                                            <input type="text" name="batch_number" class="form-control"
                                                                value="{{ old('batch_number', $record->militaryService?->batch_number) }}">
                                                        </div>
                                                    </div>

                                                    <!-- الجزء الشمال -->
                                                    <div class="col-md-6">
                                                        <div class="p-3 mb-3 text-center border rounded">
                                                            <label for="image" class="form-label fw-bold">الصوره</label>
                                                            <input class="form-control" type="file" name="employeeMilitaryCertificate"
                                                                id="employeeMilitaryCertificateInput" accept="image/*">

                                                            @if($record->militaryService)
                                                                <div class="mt-2">
                                                                    <img id="employeeMilitaryCertificatePreview"
                                                                        src="{{ $record->militaryService->getMediaUrl('employeeMilitaryCertificates', $record->militaryService, null, 'media', 'employeeMilitaryCertificate') }}"
                                                                        alt="صورة" width="100" style="cursor: pointer;" onclick="openImageModal(this.src, 'الصوره')">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel">عرض الصورة</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="text-center modal-body">
                                                                    <img id="popupImage" src="" class="rounded img-fluid"
                                                                        style="max-width: 100%; max-height: 80vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 col-md-12">
                                                        <label class="form-label">معلومات أخرى</label>
                                                        <textarea name="additional_info" class="form-control"
                                                            rows="3">{{ old('additional_info', $record->militaryService?->additional_info) }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="mt-3 text-end">
                                                    <button type="submit" class="btn btn-success">حفظ البيانات</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- بيانات التعاقد -->
                                        <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract-tab">
                                            <p><strong>تاريخ التعيين:</strong> {{-- $record->hiring_date ?? '-' --}}</p>
                                            <p><strong>الوظيفة:</strong> {{-- optional($record->jobCategory)->name ?? '-' --}}</p>
                                            <p><strong>الفرع:</strong> {{-- optional($record->branch)->name ?? '-' --}}</p>
                                            <p><strong>القسم:</strong> {{-- optional($record->department)->name ?? '-' --}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>
@endsection

@push('js')
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
</script>
@endpush
