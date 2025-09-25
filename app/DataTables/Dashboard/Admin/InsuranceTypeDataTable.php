<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\InsuranceType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class InsuranceTypeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new InsuranceType);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (InsuranceType $insuranceType) {
                return view('dashboard.admin.insurance_types.btn.actions', compact('insuranceType'));
            })
            ->editColumn('created_at', fn($type) => $this->formatTranslatedDate($type->created_at))
            ->editColumn('updated_at', fn($type) => $this->formatTranslatedDate($type->updated_at))
            ->addColumn('responsible', function (InsuranceType $insuranceType) {
                $addedBy   = $insuranceType->addedBy?->name ? "✍️ " . $insuranceType->addedBy->name : null;
                $updatedBy = $insuranceType->updatedBy?->name ? "📝 " . $insuranceType->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'responsible']);
    }

    public function query(): QueryBuilder
    {
        $userCompany = get_user_data()?->company_id;
        return InsuranceType::where('company_id', $userCompany)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => trans('dashboard/insurance_type.code')],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/insurance_type.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/insurance_type.name_en')],
            ['name' => 'employee_percentage', 'data' => 'employee_percentage', 'title' => trans('dashboard/insurance_type.employee_percentage')],
            ['name' => 'company_percentage', 'data' => 'company_percentage', 'title' => trans('dashboard/insurance_type.company_percentage')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
