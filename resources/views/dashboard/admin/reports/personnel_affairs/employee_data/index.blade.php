@extends('dashboard.layouts.master')
@section('css')

@endsection

@section('title')
شئون العاملين
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">شئون العاملين</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.reports.employee-informations.index')}}">
                    بيانات العاملين
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
                        <i class="ti ti-users"></i>
                    </span>
                    بيانات العاملين
                </div>
                <div class="card-body">
                    {{-- داخل ملف index --}}
                    <form id="reportFilterForm" action="{{ route('admin.reports.employee.filter') }}" method="GET">
                        @include('dashboard.admin.reports.personnel_affairs.employee_data.filter.filter')
                        {{-- باقي الفلاتر --}}
                        <div class="mt-3">
                            <button class="btn btn-primary">عرض التقرير</button>
                        </div>
                    </form>
                    @isset($employees)
                        <hr>
                        <h5 class="mt-4 mb-3">نتائج التقرير</h5>
                        @if($employees->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>كود الموظف</th>
                                        <th>الاسم</th>
                                        <th>تاريخ التعيين</th>
                                        <th>المستوى</th>
                                        <th>الوظيفة</th>
                                        <th>القسم</th>
                                        <th>الإدارة</th>
                                        <th>جهة العمل</th>
                                        <th>مكان استلام المرتب</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $emp)
                                    <tr>
                                        <td>{{ $emp->code }}</td>
                                        <td>{{ $emp->name_ar }}</td>
                                        <td>{{ $emp->hiring_date?->format('Y-m-d') }}</td>
                                        <td>{{ $emp->level?->name ?? '-' }}</td>
                                        <td>{{ $emp->jobCategory?->name ?? '-' }}</td>
                                        <td>{{ $emp->section?->name ?? '-' }}</td>
                                        <td>{{ $emp->department?->name ?? '-' }}</td>
                                        <td>{{ $emp?->branch?->name ?? '-' }}</td>
                                        <td>{{ $emp?->salaryPlace?->name ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-danger mt-3">لا توجد بيانات مطابقة للفلتر المحدد.</p>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>
@endsection

@push('js')

@endpush
