<div class="tab-pane fade show active" id="employee-vacation" role="tabpanel" aria-labelledby="employee-vacations-tab">

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>نوع الإجازة</th>
                <th>من</th>
                <th>إلى</th>
                <th>الايام</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @forelse($record->vacationRequests->where('request_type', 'vacation') as $request)
            <tr>
                <td>{{ $request->vacation?->name_ar . ' [ ' . $request->vacation?->code . ' ]' }}</td>
                <td>{{ $request->start_date?->format('Y-m-d') }}</td>
                <td>{{ $request->end_date?->format('Y-m-d') }}</td>
                <td>
                    {{ $request->duration_value }}
                    @if($request->duration_unit === 'days') يوم
                    @elseif($request->duration_unit === 'hours') ساعة
                    @elseif($request->duration_unit === 'minutes') دقيقة
                    @endif
                </td>
                <td>
                    @if ($request->status === 'pending')
                    <span class="badge bg-warning">قيد الانتظار</span>
                    @elseif ($request->status === 'approved')
                    <span class="badge bg-success">تمت الموافقة</span>
                    @elseif ($request->status === 'rejected')
                    <span class="badge bg-danger">تم الرفض</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">لا توجد طلبات إجازة</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
