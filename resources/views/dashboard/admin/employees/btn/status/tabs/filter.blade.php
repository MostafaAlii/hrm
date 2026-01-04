<form method="POST" action="{{ route('admin.employees.status.store', $employee->id) }}">
    @csrf
    <input type="hidden" name="tab" value="{{ $tab->key() }}">

    <div class="row">
        {{-- حقل FROM --}}
        <div class="col-md-6 mb-3">
            <label>من</label>
            <input type="text" class="form-control" disabled value="{{ $tab->from($employee) ?? '-' }}">
        </div>

        {{-- حقل TO --}}
        <div class="col-md-6 mb-3">
            <label>الى</label>
            <select class="form-control" name="to_id">
                <option value="">{{ __('اختر') }}</option>
                @foreach($tab->options() as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ __('تاريخ السريان') }}</label>
            <input type="date" class="form-control" name="effective_date">
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ __('السبب') }}</label>
            <input type="text" class="form-control" name="reason">
        </div>
        <div class="col-12 mb-3">
            <label>{{ __('ملاحظات') }}</label>
            <textarea class="form-control" name="notes"></textarea>
        </div>

        <div class="col-12">
            <button class="btn btn-primary">{{ __('حفظ') }}</button>
        </div>
    </div>
</form>
