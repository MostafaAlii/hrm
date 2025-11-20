<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\LeaveVariable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class LeaveVariableDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new LeaveVariable);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (LeaveVariable $record) {
                return view('dashboard.admin.LeaveVariable.btn.actions', compact('record'));
            })
            ->editColumn('created_at', function (LeaveVariable $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (LeaveVariable $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->editColumn('deduct_from_balance', function (LeaveVariable $record) {
                return $record->deduct_from_balance_label;
            })
            ->addColumn('responsible', function (LeaveVariable $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at', 'deduct_from_balance']);
    }

    public function query(): QueryBuilder {
        $user = get_user_data()?->company_id;
        return LeaveVariable::where('company_id', $user)
            ->orderByRaw('CAST(code AS UNSIGNED) ASC')
            ->latest('id');;
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'code', 'data' => 'code', 'title' => 'كودى', 'orderable' => true, 'searchable' => true],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الوصف العربى'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الوصف الاجنبى'],
            ['name' => 'symbol', 'data' => 'symbol', 'title' => 'الرمز'],
            ['name' => 'deduct_from_balance','data' => 'deduct_from_balance', 'title' => 'يخصم من الرصيد؟', 'orderable' => false, 'searchable' => false],
            ['name' => 'deducted_value', 'data' => 'deducted_value', 'title' => 'الرصيد'],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}