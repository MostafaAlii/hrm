<div class="modal-header">
    <h5 class="modal-title">
        {{ $financialYear->display_name }} - {{ trans('dashboard/financial_year.months') }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ trans('dashboard/financial_year.month_name') }}</th>
                <th>{{ trans('dashboard/financial_year.start_date') }}</th>
                <th>{{ trans('dashboard/financial_year.end_date') }}</th>
                <th>{{ trans('dashboard/financial_year.status') }}</th>
                <th>{{ trans('dashboard/financial_year.added_by') }}</th>
                <th>{{ trans('dashboard/financial_year.updated_by') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($months as $month)
            <tr>
                <td>{{ $month->name }}</td>
                <td>{{ $month->start_date->format('d-m-Y') }}</td>
                <td>{{ $month->end_date->format('d-m-Y') }}</td>
                <td>
                    @if($month->is_closed)
                    <span class="badge bg-danger">{{ trans('dashboard/general.close') }}</span>
                    @else
                    <span class="badge bg-success">{{ trans('dashboard/general.open') }}</span>
                    @endif
                </td>
                <td>
                    @if($month->addedBy)
                    <i class="fas fa-user-plus text-success"></i>
                    {{ $month->addedBy->name }}
                    @else
                    <span class="badge bg-secondary text-center">{{ trans('dashboard/general.not_added') }}</span>
                    @endif
                </td>
                <td>
                    @if($month->updatedBy)
                    <i class="fas fa-user-edit text-primary"></i>
                    {{ $month->updatedBy->name }}
                    @else
                    <span class="badge bg-secondary text-center">{{ trans('dashboard/general.not_updated') }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>