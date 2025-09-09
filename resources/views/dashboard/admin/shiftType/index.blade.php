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
        <h1 class="mb-0">{{trans('dashboard/sidebar.shift_type_page_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.shift-types.index')}}">{{
                    trans('dashboard/sidebar.shift_type_sidebar_title') }}</a>
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
                    {{ trans('dashboard/sidebar.branch_sidebar_title') }}
                    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary"
                        data-bs-toggle="modal" data-bs-target="#createShiftTypeModal">
                        <i class="fa fa-plus"></i>
                        {{trans('dashboard/shift_types.add_new_shiftType')}}
                    </button>
                    @include('dashboard.admin.shiftType.btn.create')
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
    document.addEventListener('DOMContentLoaded', function () {
    const shiftTypeSelect = document.getElementById('shiftTypeSelect');
    const fromTimeField = document.getElementById('fromTimeField');
    const toTimeField = document.getElementById('toTimeField');

    function toggleTimeFields() {
        const selectedType = shiftTypeSelect.value;
        if (selectedType === 'flexible') {
            fromTimeField.style.display = 'none';
            toTimeField.style.display = 'none';
        } else {
            fromTimeField.style.display = 'block';
            toTimeField.style.display = 'block';
        }
    }

    // Run on page load to set initial state
    toggleTimeFields();

    // Run on change of select
    shiftTypeSelect.addEventListener('change', toggleTimeFields);
});
</script>
<script>
    $(document).on('shown.bs.modal', '.edit-shift-modal', function () {
    var modal = $(this);
    var select = modal.find('.shift-type-select');
    var fromField = modal.find('.from-time-field');
    var toField = modal.find('.to-time-field');
    var totalField = modal.find('.total-hour-field');

    function toggleFields() {
        if (!select.length) return;
        if (select.val() === 'flexible') {
            fromField.hide();
            toField.hide();
            totalField.show();
        } else {
            fromField.show();
            toField.show();
            totalField.show();
        }
    }

    // initial state when modal opens
    toggleFields();

    // handle change
    select.off('change.shiftToggle').on('change.shiftToggle', toggleFields);

    // cleanup once modal hidden (to avoid duplicated handlers)
    modal.one('hidden.bs.modal', function () {
        select.off('change.shiftToggle');
    });
});
</script>
@endpush
