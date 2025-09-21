<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\ContractType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class ContractTypeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new ContractType);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (ContractType $contractType) {
                return view('dashboard.admin.contract_types.btn.actions', compact('contractType'));
            })
            ->editColumn('created_at', fn(ContractType $contractType) => $this->formatTranslatedDate($contractType->created_at))
            ->editColumn('updated_at', fn(ContractType $contractType) => $this->formatTranslatedDate($contractType->updated_at))
            ->addColumn('responsible', function (ContractType $contractType) {
                $addedBy   = $contractType->addedBy?->name ? "✍️ " . $contractType->addedBy->name : null;
                $updatedBy = $contractType->updatedBy?->name ? "📝 " . $contractType->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $userCompanyId = get_user_data()?->company_id;
        return ContractType::where('company_id', $userCompanyId)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/contract_type.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/contract_type.name_en')],
            ['name' => 'code', 'data' => 'code', 'title' => trans('dashboard/contract_type.code')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
