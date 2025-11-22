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
        <h1 class="mb-0">القواعد العامه لاداره الوقت</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.time-managment.general-guideline.index')}}">
                    القواعد العامة لإدارة الوقت
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
                        <i class="ti ti-clock"></i>
                    </span>
                    القواعد العامة لإدارة الوقت
                </div>
                <div class="card-body">
                    @php
                    $weekDays = \App\Facades\CustomMonth::getWeekDaysArabicWithColor(); // أيام الأسبوع مع اللون
                    $monthsWithDays = \App\Facades\CustomMonth::getMonthsWithDays(); // الشهور مع الأيام
                    $weekDayMap = [];
                    foreach($weekDays as $w){
                    $weekDayMap[$w['dayOfWeek']] = $w['color'];
                    }
                    @endphp
                    <!-- سطر أيام الأسبوع -->
                    <div class="mb-3 d-flex">
                        @foreach($weekDays as $day)
                        <div class="p-2 text-center me-1" style="background: {{ $day['color'] }}; color:black; flex:1; border-radius:5px;">
                            {{ $day['name'] }}
                        </div>
                        @endforeach
                    </div>
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="monthTabs" role="tablist">
                        @foreach($monthsWithDays as $month => $days)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($loop->first) active @endif" id="tab-{{ $loop->index }}" data-bs-toggle="tab"
                                data-bs-target="#month-{{ $loop->index }}" type="button" role="tab">
                                {{ $month }}
                            </button>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Tab content -->
                    <div class="mt-3 tab-content" id="monthTabsContent">
                        @foreach($monthsWithDays as $month => $days)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="month-{{ $loop->index }}" role="tabpanel">
                            <div class="flex-wrap d-flex">
                                @php
                                $startDate = \Carbon\Carbon::createFromFormat('Y-m-d',
                                \App\Facades\CustomMonth::getCurrentMonthRange()['start'])->startOfMonth();
                                @endphp
                                @foreach($days as $day)
                                @php
                                $date = $startDate->copy()->addDays($day - 1);
                                $dayOfWeek = $date->dayOfWeek; // 0 = الأحد ... 6 = السبت
                                $color = $weekDayMap[$dayOfWeek] ?? '#fff';
                                @endphp
                                <div class="p-2 m-1 text-center"
                                    style="background: {{ $color }}; color:black; width:40px; border-radius:5px;">
                                    {{ $day }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- Tabs --}}
                    <ul class="mb-4 nav nav-tabs" id="generalTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-general" data-bs-toggle="tab" data-bs-target="#general"
                                type="button" role="tab" aria-controls="general" aria-selected="true">البيانات العامة</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-second" data-bs-toggle="tab" data-bs-target="#second" type="button"
                                role="tab" aria-controls="second" aria-selected="false">قواعد العمل</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-third" data-bs-toggle="tab" data-bs-target="#third" type="button"
                                role="tab" aria-controls="third" aria-selected="false">المراجعه</button>
                        </li>
                    </ul>
                    {{-- Tabs Content --}}
                    <div class="tab-content" id="generalTabsContent">
                        {{-- ===================== TAB 1 ===================== --}}
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            @include('dashboard.admin.time-managment.general-guidelines.tabs.general_info')
                            <!-- End Form -->
                        </div>
                        {{-- ===================== TAB 2 ===================== --}}
                        <div class="tab-pane fade" id="second" role="tabpanel">
                            @include('dashboard.admin.time-managment.general-guidelines.tabs.work_rules')
                        </div>
                        {{-- ===================== TAB 3 ===================== --}}
                        <div class="tab-pane fade" id="third" role="tabpanel">
                            @include('dashboard.admin.time-managment.general-guidelines.tabs.review_rules')
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
    document.getElementById('attendance_color').addEventListener('input', function() {
        document.getElementById('attendance_color_preview').style.backgroundColor = this.value;
    });
    document.getElementById('attendance_holiday_color').addEventListener('input', function() {
        document.getElementById('attendance_holiday_color_preview').style.backgroundColor = this.value;
    });
    document.getElementById('attendance_weekly_color').addEventListener('input', function() {
        document.getElementById('attendance_weekly_color_preview').style.backgroundColor = this.value;
    });
</script>
@endpush
