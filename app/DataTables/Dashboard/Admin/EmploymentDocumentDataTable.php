<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\EmploymentDocument;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class EmploymentDocumentDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new EmploymentDocument);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (EmploymentDocument $record) {
                return view('dashboard.admin.employmentDocuments.btn.actions', compact('record'));
            })
            ->editColumn('created_at', function (EmploymentDocument $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (EmploymentDocument $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('responsible', function (EmploymentDocument $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })

            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return EmploymentDocument::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الوصف العربى'],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => 'الوصف الاجنبى'],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
