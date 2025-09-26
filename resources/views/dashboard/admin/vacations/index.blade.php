@extends('dashboard.layouts.master')
@section('css')
<style>
    #occasions_datatable tbody td,
    #occasions_datatable thead th {
        text-align: center !important;
    }

    #occasions_datatable .dt-left,
    #occasions_datatable .dt-right {
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
        <h1 class="mb-0">{{trans('dashboard/sidebar.vacation_page_title') }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.vacations.index')}}">{{
                    trans('dashboard/sidebar.vacation_sidebar_title') }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="" data-feather="zap"></i>
                    </span>
                    {{ trans('dashboard/sidebar.vacation_sidebar_title') }}
                    <button data-pc-animate="3d-sign" type="button" class="btn btn-sm btn-light btn-active-primary"
                        data-bs-toggle="modal" data-bs-target="#createVacationModal">
                        <i class="fa fa-plus"></i>
                        {{trans('dashboard/vacation.add_new_vacation')}}
                    </button>
                    @include('dashboard.admin.vacations.btn.create')
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
    document.addEventListener("DOMContentLoaded", function () {
        let checkbox = document.querySelector("input[name='deduct_from_balance']");
        let deductionWrapper = document.getElementById("deductionValueWrapper");

        checkbox.addEventListener("change", function () {
            if (this.checked) {
                deductionWrapper.classList.remove("d-none");
            } else {
                deductionWrapper.classList.add("d-none");
                deductionWrapper.querySelector("input").value = 0;
            }
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-deduction").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            let targetId = this.getAttribute("data-target");
            let wrapper = document.getElementById(targetId);
            let input   = wrapper.querySelector("input");

            if (this.checked) {
                wrapper.classList.remove("d-none");
            } else {
                wrapper.classList.add("d-none");
                input.value = 0;
            }
        });
    });
});
</script>
@endpush