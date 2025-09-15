<div class="modal-header">
    <h5 class="modal-title">{{ trans('dashboard/financial_year.edit_financial_year') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div id="editFinancialYearAlert"></div>
    @if($financialYear->is_active)
    <div class="alert alert-warning">
        <i class="fas fa-lock"></i> {{ trans('dashboard/financial_year.cannot_edit_open_year') }}
    </div>
    @else
    <form id="editFinancialYearForm" action="{{ route('admin.financialYears.update', $financialYear->id) }}"
        method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ trans('dashboard/financial_year.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $financialYear->name }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ trans('dashboard/financial_year.start_date') }}</label>
                <input type="date" name="start_date" class="form-control"
                    value="{{ $financialYear->start_date->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ trans('dashboard/financial_year.end_date') }}</label>
                <input type="date" name="end_date" class="form-control"
                    value="{{ $financialYear->end_date->format('Y-m-d') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ trans('dashboard/financial_year.is_active') }}</label>
            <select name="is_active" class="form-select">
                <option value="1" @selected($financialYear->is_active)>{{ trans('dashboard/general.active') }}</option>
                <option value="0" @selected(!$financialYear->is_active)>{{ trans('dashboard/general.in_active') }}
                </option>
            </select>
        </div>
    </form>
    @endif
</div>

<div class="modal-footer">
    @if(!$financialYear->is_active)
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ trans('dashboard/general.closed')
        }}</button>
    <button type="submit" form="editFinancialYearForm" class="btn btn-success">
        <i class="fa fa-save"></i> {{ trans('dashboard/general.save') }}
    </button>
    @else
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('dashboard/general.close')
        }}</button>
    @endif
</div>