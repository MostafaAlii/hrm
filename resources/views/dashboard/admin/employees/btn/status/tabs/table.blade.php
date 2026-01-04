<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('من') }}</th>
            <th>{{ __('إلى') }}</th>
            <th>{{ __('تاريخ السريان') }}</th>
            <th>{{ __('السبب') }}</th>
            <th>{{ __('ملاحظات') }}</th>
            <th>{{ __('تم التطبيق؟') }}</th>
            <th>{{ __('آخر تعديل') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($history[$tab->key()] ?? [] as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->name_from }}</td>
            <td>{{ $item->name_to }}</td>
            <td>{{ \Carbon\Carbon::parse($item->effective_date)->format('Y-m-d') }}</td>
            <td>{{ $item->reason }}</td>
            <td>{{ $item->notes }}</td>
            <td class="text-center">
                @if($item->applied)
                <i class="fas fa-check-circle text-success" title="{{ __('تم التطبيق') }}"></i>
                @else
                <i class="fas fa-times-warning text-danger" title="{{ __('لم يتم التطبيق بعد') }}"></i>
                @endif
            </td>
            <td>{{ $item->updated_at->format('Y-m-d') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">{{ __('لا توجد تغييرات حتى الآن') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>