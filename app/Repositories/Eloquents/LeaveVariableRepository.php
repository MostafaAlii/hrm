<?php

namespace App\Repositories\Eloquents;

use App\Models\LeaveVariable;
use App\Repositories\Contracts\LeaveVariableRepositoryInterface;
use Illuminate\Http\Request;

class LeaveVariableRepository extends BaseRepository implements LeaveVariableRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(LeaveVariable $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
            'symbol' => $request->symbol,
            'color' => $request->color,
            'deduct_from_balance' => $request->deduct_from_balance ? true : false,
            'deducted_value' => $request->deducted_value ? : 0,
            'balance' => $request->balance ? : 0,
            'ten_years_balance' => $request->ten_years_balance ? : 0,
            'fifty_years_balance' => $request->fifty_years_balance ? : 0,
            'can_transfer' => $request->can_transfer ? true : false,
            'ten_years_insurance' => $request->ten_years_insurance ? true : false,
            'fifty_years' => $request->fifty_years ? true : false,
            'affect_annual_leave' => $request->affect_annual_leave ? true : false,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'code' => $request->code,
            'symbol' => $request->symbol,
            'color' => $request->color,
            'deduct_from_balance' => $request->deduct_from_balance ? true : false,
            'deducted_value' => $request->deducted_value,
            'balance' => $request->balance,
            'ten_years_balance' => $request->ten_years_balance,
            'fifty_years_balance' => $request->fifty_years_balance,
            'can_transfer' => $request->can_transfer ? true : false,
            'ten_years_insurance' => $request->ten_years_insurance ? true : false,
            'fifty_years' => $request->fifty_years ? true : false,
            'affect_annual_leave' => $request->affect_annual_leave ? true : false,
        ];
    }
}
