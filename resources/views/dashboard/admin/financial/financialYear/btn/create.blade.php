<!-- Modal -->
<div class="modal fade" id="createFinancial_year" tabindex="-1" aria-labelledby="createFinancialYearLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createFinancialYearLabel">
                    {{ trans('dashboard/financial_year.add_new_financial_year') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="financialYearForm" action="{{ route('admin.financialYears.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">{{ trans('dashboard/financial_year.name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ trans('dashboard/financial_year.start_date') }}</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ trans('dashboard/financial_year.end_date') }}</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ trans('dashboard/financial_year.is_active') }}</label>
                        <select name="is_active" class="form-select">
                            <option value="1">{{ trans('dashboard/general.active') }}</option>
                            <option value="0">{{ trans('dashboard/general.in_active') }}</option>
                        </select>
                    </div>

                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">
                    {{ trans('dashboard/general.closed') }}
                </button>
                <button type="submit" form="financialYearForm" class="btn btn-success">
                    <i class="fa fa-save"></i> {{ trans('dashboard/general.save') }}
                </button>
            </div>

        </div>
    </div>
</div>
