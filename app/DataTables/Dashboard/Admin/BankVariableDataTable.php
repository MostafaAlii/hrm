<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\BankVariable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class BankVariableDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new BankVariable);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (BankVariable $bankVariable) {
                return view('dashboard.admin.bankVariables.btn.actions', compact('bankVariable'));
            })
            ->editColumn('is_active_label', function (BankVariable $bankVariable) {
                return $bankVariable->is_active_label;
            })
            ->editColumn('created_at', function (BankVariable $bankVariable) {
                return $this->formatTranslatedDate($bankVariable->created_at);
            })
            ->editColumn('updated_at', function (BankVariable $bankVariable) {
                return $this->formatTranslatedDate($bankVariable->updated_at);
            })
            ->addColumn('responsible', function (BankVariable $bankVariable) {
                $addedBy   = $bankVariable->addedBy?->name ? "✍️ " . $bankVariable->addedBy->name : null;
                $updatedBy = $bankVariable->updatedBy?->name ? "📝 " . $bankVariable->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return BankVariable::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الوصف عربى'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الوصف انجليزى'],
            ['name' => 'contact_person', 'data' => 'contact_person', 'title' => 'جهه الاتصال'],
            ['name' => 'phone_number', 'data' => 'phone_number', 'title' => 'رقم الهاتف'],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
