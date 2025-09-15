@extends('dashboard.layouts.master')
@section('css')
<style>
    #jobCategories_datatable tbody td,
    #jobCategories_datatable thead th {
        text-align: center !important;
    }

    #jobCategories_datatable .dt-left,
    #jobCategories_datatable .dt-right {
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
        <h1 class="mb-0">{{trans('dashboard/sidebar.jobCategory_page_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.jobCategories.index')}}">{{
                    trans('dashboard/sidebar.jobCategory_sidebar_title') }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="ti ti-tornado"></i>
                    </span>
                    {{ trans('dashboard/sidebar.jobCategory_sidebar_title') }}
                    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary"
                        data-bs-toggle="modal" data-bs-target="#createJobCategoryModal">
                        <i class="fa fa-plus"></i>
                        {{trans('dashboard/jobCategory.add_new_jobCategory')}}
                    </button>
                    @include('dashboard.admin.jobCategories.btn.create')
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
    document.getElementById('department_id').addEventListener('change', function() {
        let departmentId = this.value;
        let sectionSelect = document.getElementById('section_id');
        sectionSelect.innerHTML = '<option value="">-- اختر القسم --</option>';
        if (departmentId) {
            let url = "{{ route('admin.departments.sections', ':id') }}";
            url = url.replace(':id', departmentId);
    
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    data.forEach(section => {
                        let option = document.createElement('option');
                        option.value = section.id;
                        option.textContent = section.name;
                        sectionSelect.appendChild(option);
                    });
                });
        }
    });
</script>
{{--<script>
    document.getElementById('department_id_edit{{ $jobCategory->id }}').addEventListener('change', function() {
    let departmentId = this.value;
    let sectionSelect = document.getElementById('section_id_edit{{ $jobCategory->id }}');
    sectionSelect.innerHTML = '<option value="">-- اختر القسم --</option>';

    if (departmentId) {
        let url = "{{ route('admin.departments.sections', ':id') }}";
        url = url.replace(':id', departmentId);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.forEach(section => {
                    let option = document.createElement('option');
                    option.value = section.id;
                    option.textContent = section.name;
                    sectionSelect.appendChild(option);
                });
            });
    }
});
</script>--}}
<script>
    (function() {
  // قالب الـ route ونستبدل :id ديناميكياً
  const sectionsUrlTemplate = "{{ route('admin.departments.sections', ':id') }}";

  // عندما يتغير selector لأي department
  document.addEventListener('change', function(e) {
    if (!e.target.classList.contains('department-select')) return;

    const departmentId = e.target.value;
    const jobId = e.target.dataset.jobId;
    const sectionSelect = document.querySelector(`#section_id_edit${jobId}`);
    if (!sectionSelect) return;

    sectionSelect.innerHTML = '<option value="">-- اختر القسم --</option>';

    if (!departmentId) return;

    const url = sectionsUrlTemplate.replace(':id', departmentId);

    fetch(url)
      .then(response => response.json())
      .then(data => {
        data.forEach(section => {
          const option = document.createElement('option');
          option.value = section.id;
          option.textContent = section.name;
          sectionSelect.appendChild(option);
        });
      })
      .catch(err => console.error('Failed to fetch sections:', err));
  });

  // عند فتح الـ modal (Bootstrap event) — نحمّل الأقسام الحالية ونعلّم القسم المختار
  document.addEventListener('shown.bs.modal', function(event) {
    const modal = event.target;
    // ابحث داخل المودال عن department-select و section-select
    const dept = modal.querySelector('.department-select');
    if (!dept) return;

    const jobId = dept.dataset.jobId;
    const sectionSelect = modal.querySelector(`#section_id_edit${jobId}`);
    if (!sectionSelect) return;

    const selectedSectionId = sectionSelect.dataset.selected || '';
    const departmentId = dept.value;
    if (!departmentId) return; // لو ما فيش إدارة مختارة، لا نفعل fetch

    const url = sectionsUrlTemplate.replace(':id', departmentId);

    fetch(url)
      .then(response => response.json())
      .then(data => {
        sectionSelect.innerHTML = '<option value="">-- اختر القسم --</option>';
        data.forEach(section => {
          const option = document.createElement('option');
          option.value = section.id;
          option.textContent = section.name;
          if (selectedSectionId && String(section.id) === String(selectedSectionId)) {
            option.selected = true;
          }
          sectionSelect.appendChild(option);
        });
      })
      .catch(err => console.error('Failed to fetch sections on modal show:', err));
  });

})();
</script>
@endpush