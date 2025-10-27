<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\DeductionVariable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class DeductionVariableDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new DeductionVariable);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        $categories = \App\Models\DeductionVariableCategory::where('is_active', true)->get();
        $entitlementRelations = \App\Models\EntitlementTypeRelation::where('is_active', true)->get();
        $deductionTypes = \App\Models\DeductionType::where('is_active', true)->get();

        return (new EloquentDataTable($query))
            ->addColumn('action', function (DeductionVariable $record) use ($categories, $entitlementRelations, $deductionTypes) {
                return view('dashboard.admin.salaries.deduction-variables.btn.actions', compact('record', 'categories', 'entitlementRelations', 'deductionTypes'));
            })
            ->editColumn('created_at', function (DeductionVariable $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (DeductionVariable $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('status', function (DeductionVariable $record) {
                return $record->status_badge;
            })
            ->addColumn('category', function (DeductionVariable $record) {
                return $record->category?->name_ar ?? '-';
            })
            ->addColumn('entitlement_relation', function (DeductionVariable $record) {
                return $record->entitlementTypeRelation ? $record->entitlementTypeRelation->code . ' - ' . $record->entitlementTypeRelation->name_ar : '-';
            })
            ->addColumn('deduction_type', function (DeductionVariable $record) {
                return $record->deductionType?->name_ar ?? '-';
            })
            ->addColumn('nature', function (DeductionVariable $record) {
                return $record->nature_badge;
            })
            ->addColumn('taxable', function (DeductionVariable $record) {
                return $record->taxable_badge;
            })
            ->addColumn('effects', function (DeductionVariable $record) {
                return $record->effects_display;
            })
            ->addColumn('responsible', function (DeductionVariable $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'status', 'nature', 'taxable', 'effects', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return DeductionVariable::with(['category', 'entitlementTypeRelation', 'deductionType'])
            ->where('company_id', $user)
            ->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => 'الكود'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الاسم عربي'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الاسم إنجليزي'],
            ['name' => 'account_number', 'data' => 'account_number', 'title' => 'رقم الحساب'],
            ['name' => 'nature', 'data' => 'nature', 'title' => 'النوع'],
            ['name' => 'taxable', 'data' => 'taxable', 'title' => 'الضريبة', 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
