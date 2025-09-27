<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Qualification;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class QualificationDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Qualification);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Qualification $qualification) {
                return view('dashboard.admin.qualifications.btn.actions', compact('qualification'));
            })
            ->editColumn('is_active_label', function (Qualification $qualification) {
                return $qualification->is_active_label;
            })
            ->editColumn('created_at', function (Qualification $qualification) {
                return $this->formatTranslatedDate($qualification->created_at);
            })
            ->editColumn('updated_at', function (Qualification $qualification) {
                return $this->formatTranslatedDate($qualification->updated_at);
            })
            ->addColumn('responsible', function (Qualification $qualification) {
                $addedBy   = $qualification->addedBy?->name ? "✍️ " . $qualification->addedBy->name : null;
                $updatedBy = $qualification->updatedBy?->name ? "📝 " . $qualification->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Qualification::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => 'الموهل'],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}