<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\ShiftType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;
use App\Enums\ShiftType\ShiftType as ShiftTypeEnum;
class ShiftTypeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new ShiftType);
        $this->request = $request;
    }

    protected function getParameters() {
        $params = parent::getParameters();
        $params['searching'] = false;
        return $params;
    }
    
    public function dataTable($query): EloquentDataTable
    {
        $types = ShiftTypeEnum::cases();
        return (new EloquentDataTable($query))
            ->addColumn('action', function (ShiftType $shiftType) use ($types) {
                return view('dashboard.admin.shiftType.btn.actions', compact('shiftType', 'types'));
            })
            ->editColumn('is_active_label', function (ShiftType $shiftType) {
                return $shiftType->is_active_label;
            })
            ->editColumn('created_at', function (ShiftType $shiftType) {
                return $this->formatTranslatedDate($shiftType->created_at);
            })
            ->editColumn('updated_at', function (ShiftType $shiftType) {
                return $this->formatTranslatedDate($shiftType->updated_at);
            })
            ->editColumn('type', function (ShiftType $shiftType) {
                return $shiftType->type_badge;
            })
            ->editColumn('from_time', function (ShiftType $shiftType) {
                return $shiftType->from_time_formatted ?? '-';
            })
            ->editColumn('to_time', function (ShiftType $shiftType) {
                return $shiftType->to_time_formatted ?? '-';
            })
            ->editColumn('total_hour', function (ShiftType $shiftType) {
                return $shiftType->total_hour_formatted ?? '-';
            })
            ->addColumn('responsible', function (ShiftType $shiftType) {
                $addedBy   = $shiftType->addedBy?->name ? "✍️ " . $shiftType->addedBy->name : null;
                $updatedBy = $shiftType->updatedBy?->name ? "📝 " . $shiftType->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at', 'type', 'from_time', 'to_time', 'total_hour']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        $query = ShiftType::query()->where('company_id', $user);
        if (request()->filled('type')) {
            $query->where('type', request('type'));
        }

        if (request()->filled('from_time')) {
            $query->where('from_time', '>=', request('from_time'));
        }

        if (request()->filled('to_time')) {
            $query->where('to_time', '<=', request('to_time'));
        }

        return $query->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active')],
            ['name' => 'type', 'data' => 'type', 'title' => trans('dashboard/shift_types.type')], // ✅ عمود جديد

            ['name' => 'from_time', 'data' => 'from_time', 'title' => trans('dashboard/shift_types.from_time')],
            ['name' => 'to_time', 'data' => 'to_time', 'title' => trans('dashboard/shift_types.to_time')],
            ['name' => 'total_hour', 'data' => 'total_hour', 'title' => trans('dashboard/shift_types.total_hour')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}