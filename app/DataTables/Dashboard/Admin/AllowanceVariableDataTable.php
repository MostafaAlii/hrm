<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\AllowanceVariable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class AllowanceVariableDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new AllowanceVariable);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        $categories = \App\Models\AllowanceCategory::active()->get();
        return (new EloquentDataTable($query))
            ->addColumn('action', function (AllowanceVariable $record) use ($categories) {
                return view('dashboard.admin.salaries.allowance-variables.btn.actions', compact('record', 'categories'));
            })
            ->editColumn('created_at', function (AllowanceVariable $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (AllowanceVariable $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('status', function (AllowanceVariable $record) {
                return $record->status_badge;
            })
            ->addColumn('category', function (AllowanceVariable $record) {
                return $record->category?->name ?? '-';
            })
            ->addColumn('taxable', function (AllowanceVariable $record) {
                return $record->taxable_badge;
            })
            ->addColumn('health_insurance', function (AllowanceVariable $record) {
                return $record->health_insurance_badge;
            })
            ->addColumn('limits', function (AllowanceVariable $record) {
                $limits = [];
                if ($record->has_min_limit) $limits[] = $record->min_limit_badge;
                if ($record->has_max_limit) $limits[] = $record->max_limit_badge;
                return $limits ? implode(' ', $limits) : '-';
            })
            ->addColumn('responsible', function (AllowanceVariable $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'status', 'taxable', 'health_insurance', 'limits', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return AllowanceVariable::with('category')
            ->where('company_id', $user)
            ->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => 'الكود'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الوصف عربي'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الوصف إنجليزي'],
            ['name' => 'account_number', 'data' => 'account_number', 'title' => 'رقم الحساب'],
            ['name' => 'taxable', 'data' => 'taxable', 'title' => 'الضريبة', 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
