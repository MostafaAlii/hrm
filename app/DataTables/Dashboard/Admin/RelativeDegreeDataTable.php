<?php
namespace App\DataTables\Dashboard\Admin;
use App\DataTables\Base\BaseDataTable;
use App\Models\{RelativeDegree};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class RelativeDegreeDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new RelativeDegree);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (RelativeDegree $relativeDegree) {
                return view('dashboard.admin.relative_degrees.btn.actions', compact(['relativeDegree']));
            })
            ->editColumn('created_at', function (RelativeDegree $relativeDegree) {
                return $this->formatTranslatedDate($relativeDegree->created_at);
            })
            ->editColumn('updated_at', function (RelativeDegree $relativeDegree) {
                return $this->formatTranslatedDate($relativeDegree->updated_at);
            })
            ->addColumn('responsible', function (RelativeDegree $relativeDegree) {
                $addedBy   = $relativeDegree->addedBy?->name ? "✍️ " . $relativeDegree->addedBy->name : null;
                $updatedBy = $relativeDegree->updatedBy?->name ? "📝 " . $relativeDegree->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return RelativeDegree::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/relative_degree.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/relative_degree.name_en')],
            ['name' => 'insurance_percentage', 'data' => 'insurance_percentage', 'title' => trans('dashboard/relative_degree.insurance_percentage')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
