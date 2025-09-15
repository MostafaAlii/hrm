@props([
'filters' => [], // array of filters
'tableId' => null // ID of the datatable
])

<div class="datatable-filters mb-3">
    <form id="datatableFiltersForm_{{ $tableId }}" class="row g-2">
        @foreach($filters as $filter)
        <div class="col-md-{{ $filter['col'] ?? 3 }}">
            @if(isset($filter['label']))
            <label class="form-label">{{ $filter['label'] }}</label>
            @endif

            @if($filter['type'] === 'select')
            <select name="{{ $filter['name'] }}" class="form-control">
                <option value="">{{ $filter['placeholder'] ?? __('اختر') }}</option>
                @foreach($filter['options'] as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>

            @elseif($filter['type'] === 'time')
            <input type="time" name="{{ $filter['name'] }}" class="form-control time-input"
                placeholder="{{ $filter['placeholder'] ?? '' }}">

            @elseif($filter['type'] === 'text')
            <input type="text" name="{{ $filter['name'] }}" class="form-control"
                placeholder="{{ $filter['placeholder'] ?? '' }}">
            @endif
        </div>
        @endforeach

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">{{ __('بحث') }}</button>
        </div>
    </form>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let tableId = @json($tableId);

        // ⏳ فلترة بالـ AJAX
        let form = document.getElementById('datatableFiltersForm_' + tableId);
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                let table = $('#' + tableId).DataTable();

                let filters = {};
                $(form).serializeArray().forEach(function (item) {
                    filters[item.name] = item.value;
                });

                // نضيف الفلاتر في Ajax request
                table.ajax.params(filters);
                table.ajax.reload();
            });
        }

        // 🕑 فورمات الوقت صباحًا/مساءً
        document.querySelectorAll('.time-input').forEach(function(input) {
            input.addEventListener('change', function () {
                if (!this.value) return;

                let [hours, minutes] = this.value.split(':');
                hours = parseInt(hours);

                let period = hours >= 12 ? "{{ __('dashboard/shift_types.pm') }}" : "{{ __('dashboard/shift_types.am') }}";
                let displayHours = hours % 12 || 12;

                this.title = displayHours + ':' + minutes + ' ' + period;
            });
        });
    });
</script>
@endpush