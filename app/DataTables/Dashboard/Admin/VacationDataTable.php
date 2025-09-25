<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class VacationDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Vacation);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Vacation $vacation) {
                return view('dashboard.admin.vacations.btn.actions', compact('vacation'));
            })
            ->editColumn('created_at', function (Vacation $vacation) {
                return $this->formatTranslatedDate($vacation->created_at);
            })
            ->editColumn('updated_at', function (Vacation $vacation) {
                return $this->formatTranslatedDate($vacation->updated_at);
            })
            ->addColumn('responsible', function (Vacation $vacation) {
                $addedBy   = $vacation->addedBy?->name ? "✍️ " . $vacation->addedBy->name : null;
                $updatedBy = $vacation->updatedBy?->name ? "📝 " . $vacation->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->editColumn('deduct_from_balance', function (Vacation $vacation) {
                return $vacation->deduct_from_balance_label;
            })

            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at', 'deduct_from_balance']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Vacation::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => 'الرمز'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الوصف العربى'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الوصف الاجنبى'],
            ['name' => 'deduct_from_balance', 'data' => 'deduct_from_balance', 'title' => 'يخصم من الرصيد'],
            ['name' => 'deduction_value', 'data' => 'deduction_value', 'title' => 'الرصيد'],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}