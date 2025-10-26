<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\TaxTransactionType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class TaxTransactionTypeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new TaxTransactionType);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (TaxTransactionType $record) {
                return view('dashboard.admin.salaries.tax-transaction-types.btn.actions', compact('record'));
            })
            ->editColumn('created_at', function (TaxTransactionType $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (TaxTransactionType $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('status', function (TaxTransactionType $record) {
                return $record->is_active
                    ? '<span class="badge bg-success">نشط</span>'
                    : '<span class="badge bg-danger">غير نشط</span>';
            })
            ->addColumn('responsible', function (TaxTransactionType $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'status', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return TaxTransactionType::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => 'الكود'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الاسم عربي'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الاسم إنجليزي'],
            ['name' => 'status', 'data' => 'status', 'title' => 'الحالة', 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
