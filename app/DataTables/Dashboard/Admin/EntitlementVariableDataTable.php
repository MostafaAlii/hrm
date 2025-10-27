<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\EntitlementVariable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class EntitlementVariableDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new EntitlementVariable);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        $categories = \App\Models\EntitlementVariableCategory::active()->get();
        $revenueTypes = \App\Models\RevenueType::active()->get();
        $entitlementRelations = \App\Models\EntitlementTypeRelation::where('is_active', true)->get();
        
        return (new EloquentDataTable($query))
            ->addColumn('action', function (EntitlementVariable $record) use ($categories, $revenueTypes, $entitlementRelations) {
                return view('dashboard.admin.salaries.entitlement-variables.btn.actions', compact('record', 'categories', 'revenueTypes', 'entitlementRelations'));
            })
            ->editColumn('created_at', function (EntitlementVariable $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (EntitlementVariable $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('status', function (EntitlementVariable $record) {
                return $record->status_badge;
            })
            ->addColumn('category', function (EntitlementVariable $record) {
                return $record->category?->name ?? '-';
            })
            ->addColumn('revenue_type', function (EntitlementVariable $record) {
                return $record->revenueType?->name ?? '-';
            })
            ->addColumn('nature', function (EntitlementVariable $record) {
                return $record->nature_badge;
            })
            ->addColumn('taxable', function (EntitlementVariable $record) {
                return $record->taxable_badge;
            })
            ->addColumn('health_insurance', function (EntitlementVariable $record) {
                return $record->health_insurance_badge;
            })
            ->addColumn('limits', function (EntitlementVariable $record) {
                return $record->limits_display;
            })
            ->addColumn('effects', function (EntitlementVariable $record) {
                return $record->effects_display;
            })
            ->addColumn('responsible', function (EntitlementVariable $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'status', 'nature', 'taxable', 'health_insurance', 'limits', 'effects', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return EntitlementVariable::with(['category', 'revenueType'])
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
            ['name' => 'nature', 'data' => 'nature', 'title' => 'النوع'],
            ['name' => 'taxable', 'data' => 'taxable', 'title' => 'الضريبة', 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
