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
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">متغيرات الاجازات</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.leave-variables.index')}}">
                    متغيرات الاجازات
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
                    متغيرات الاجازات
                    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary"
                        data-bs-toggle="modal" data-bs-target="#createBranchModal">
                        <i class="fa fa-plus"></i>
                        اضافه متغيرات الاجازات
                    </button>
                    @include('dashboard.admin.leaveVariable.btn.create')
                </div>
                <div class="card-body">
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
<script>
    document.querySelectorAll('.color-option').forEach(opt => {
    opt.addEventListener('click', function () {
        const color = this.dataset.color;
        document.getElementById('selectedColor').value = color;
        document.getElementById('colorDropdown').style.background = color;
    });
});

// فتح Color Picker عند الضغط على الأيقونة
document.getElementById('openColorPicker').addEventListener('click', function(e){
    e.stopPropagation(); // منع غلق dropdown
    document.getElementById('customColorPicker').click();
});

document.getElementById('customColorPicker').addEventListener('input', function(){
    const color = this.value;
    document.getElementById('selectedColor').value = color;
    document.getElementById('colorDropdown').style.background = color;
});

// اختيار اللون من الدائرة
document.addEventListener('click', function (e) {
if (!e.target.classList.contains('edit-color-option')) return;

const id = e.target.dataset.id;
const color = e.target.dataset.color;

document.getElementById(`editSelectedColor${id}`).value = color;
document.getElementById(`editColorDropdown${id}`).style.background = color;
});


// فتح الـ color picker
document.addEventListener('click', function (e) {
if (!e.target.classList.contains('edit-openColorPicker')) return;

e.stopPropagation();
const id = e.target.dataset.id;

document.querySelector(`.edit-customColorPicker[data-id="${id}"]`).click();
});


// اختيار اللون من الـ color picker
document.addEventListener('input', function (e) {
if (!e.target.classList.contains('edit-customColorPicker')) return;

const id = e.target.dataset.id;
const color = e.target.value;

document.getElementById(`editSelectedColor${id}`).value = color;
document.getElementById(`editColorDropdown${id}`).style.background = color;
});

document.addEventListener('shown.bs.modal', function (event) {
const modal = event.target;

const id = modal.getAttribute('id').replace('editBranchModal', '');
const color = modal.dataset.color; // هنضيفه تحت

if (color) {
document.getElementById(`editSelectedColor${id}`).value = color;
document.getElementById(`editColorDropdown${id}`).style.background = color;
}
});
</script>

<script>
    const checkbox = document.getElementById('deductCheckbox');
    const deductedInput = document.getElementById('deductedValue');
    // اظهار او اخفاء ال input بناء على حالة ال checkbox
    checkbox.addEventListener('change', function() {
        if(this.checked){
            deductedInput.style.display = 'inline-block';
        } else {
            deductedInput.style.display = 'none';
            deductedInput.value = ''; // مسح القيمة لو تم الغاء الاختيار
        }
    });
</script>

<script>
    // عند الضغط على الـ checkbox في أي مودال
    document.addEventListener('change', function(e) {
    if (!e.target.classList.contains('edit-deduct-checkbox')) return;

    const id = e.target.dataset.id;
    const input = document.getElementById(`editDeductedValue${id}`);

    if (e.target.checked) {
    input.style.display = "block";
    } else {
    input.style.display = "none";
    input.value = "";
    }
    });
</script>
@endpush