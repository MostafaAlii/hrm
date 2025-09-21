<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\{InsuranceRegion};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class InsuranceRegionDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new InsuranceRegion);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (InsuranceRegion $insuranceRegion) {
                return view('dashboard.admin.insurance_regions.btn.actions', compact(['insuranceRegion']));
            })
            ->editColumn('created_at', function (InsuranceRegion $insuranceRegion) {
                return $this->formatTranslatedDate($insuranceRegion->created_at);
            })
            ->editColumn('updated_at', function (InsuranceRegion $insuranceRegion) {
                return $this->formatTranslatedDate($insuranceRegion->updated_at);
            })
            ->addColumn('responsible', function (InsuranceRegion $insuranceRegion) {
                $addedBy   = $insuranceRegion->addedBy?->name ? "✍️ " . $insuranceRegion->addedBy->name : null;
                $updatedBy = $insuranceRegion->updatedBy?->name ? "📝 " . $insuranceRegion->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return InsuranceRegion::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/relative_degree.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/relative_degree.name_en')],
            ['name' => 'code', 'data' => 'code', 'title' => 'كودى',],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
