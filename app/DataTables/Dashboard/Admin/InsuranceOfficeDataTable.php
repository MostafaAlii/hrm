<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\InsuranceOffice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class InsuranceOfficeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new InsuranceOffice);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (InsuranceOffice $insuranceOffice) {
                return view('dashboard.admin.insurance_offices.btn.actions', compact('insuranceOffice'));
            })
            ->editColumn('created_at', fn($office) => $this->formatTranslatedDate($office->created_at))
            ->editColumn('updated_at', fn($office) => $this->formatTranslatedDate($office->updated_at))
            ->addColumn('responsible', function (InsuranceOffice $office) {
                $addedBy   = $office->addedBy?->name ? "✍️ " . $office->addedBy->name : null;
                $updatedBy = $office->updatedBy?->name ? "📝 " . $office->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active', 'responsible']);
    }

    public function query(): QueryBuilder
    {
        $userCompanyId = get_user_data()?->company_id;
        return InsuranceOffice::where('company_id', $userCompanyId)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/insurance_office.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/insurance_office.name_en')],
            ['name' => 'code', 'data' => 'code', 'title' => trans('dashboard/insurance_office.code')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions')],
        ];
    }
}