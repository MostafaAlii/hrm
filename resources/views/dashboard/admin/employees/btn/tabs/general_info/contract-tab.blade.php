<div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract-tab">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="mb-3 mt-2 section-title">
            عقود الموظف
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <!-- زرار إضافة عقد -->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createContractModal">
            <i class="fas fa-plus"></i> إضافة عقد جديد
        </button>
    </div>
    <!-- Start Employee Contracts Table -->
    @if($record->contracts && $record->contracts->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>نوع العقد</th>
                <th>تاريخ بداية العقد</th>
                <th>تاريخ التأمينات</th>
                <th>تاريخ التجديد</th>
                <th>الوصف</th>
                <th>آخر تعديل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($record->contracts as $contract)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $contract->contractType?->name_ar }}</td>
                <td>{{ $contract->start_date?->format('Y-m-d') }}</td>
                <td>{{ $contract->insurance_date?->format('Y-m-d') }}</td>
                <td>{{ $contract->renewal_date?->format('Y-m-d') }}</td>
                <td>{{ $contract->description }}</td>
                <td>{{ $contract->updated_at?->format('Y-m-d') }}</td>
                @include('dashboard.admin.employees.btn.delete_contract', ['contract' => $contract])
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted">لا يوجد عقود مسجلة.</p>
    @endif
    @include('dashboard.admin.employees.btn.create_contract', ['contractTypes' => $contractTypes])
    <!-- End Employee Contracts Table -->
</div>
