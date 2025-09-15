@extends('dashboard.layouts.master')
@section('css')
<style>
    .bootstrap-switch .switch-group label {
        font-size: 12px !important;
        padding: 2px 6px !important;
    }
</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{trans('dashboard/sidebar.financialYears_page_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.financialYears.index')}}">{{
                    trans('dashboard/sidebar.financialYears_sidebar_title') }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="ti ti-briefcase"></i>
                    </span>
                    {{ trans('dashboard/sidebar.financialYears_sidebar_title') }}
                    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal"
                        data-bs-target="#createFinancial_year">
                        <i class="fa fa-plus"></i>
                        {{trans('dashboard/financial_year.add_new_financial_year')}}
                    </button>
                    @include('dashboard.admin.financial.financialYear.btn.create')
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
    $(document).on('click', '.show-financial-year-months', function () {
    let id = $(this).data('id');
    let url = "{{ route('admin.financialYears.months', ':id') }}".replace(':id', id);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#financialYearMonthsModal .modal-content').html(response);
            $('#financialYearMonthsModal').modal('show');
        },
        error: function () {
            alert("Error loading months.");
        }
    });
});
</script>
<script>
    $(document).on('click', '.edit-financial-year', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#editFinancialYearModal .modal-content').html(response);
            $('#editFinancialYearModal').modal('show');
        },
        error: function () {
            alert("Error loading financial year.");
        }
    });
});
</script>
<script>
    $(document).on('submit', '#editFinancialYearForm', function (e) {
    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');
    let data = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (response) {
        $('#editFinancialYearModal').modal('hide');
        $('#editFinancialYearAlert').html(
        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
            response.message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>'
        );
        
        // تحديث DataTable
        $('#financial_years_datatable').DataTable().ajax.reload(null, false);
        },
        error: function (xhr) {
            $('#editFinancialYearAlert').html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                (xhr.responseJSON?.message ?? "Error updating financial year") +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>'
            );
        }
    });
});
</script>
@endpush
