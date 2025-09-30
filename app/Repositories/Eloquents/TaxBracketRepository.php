<?php

namespace App\Repositories\Eloquents;

use App\Models\TaxBracket;
use App\Repositories\Contracts\TaxBracketRepositoryInterface;
use Illuminate\Http\Request;

class TaxBracketRepository extends BaseRepository implements TaxBracketRepositoryInterface
{
    protected $rules = [
        'bracket_name' => 'nullable|string|max:255',
        'value' => 'nullable|numeric|min:0',
        'percentage' => 'nullable|numeric|min:0|max:100',
        'discount_percentage' => 'nullable|numeric|min:0|max:100',
        'level' => 'nullable|in:1,2,3,4,5',
        'tax_setting_id' => 'nullable|exists:tax_settings,id',
    ];

    public function __construct(TaxBracket $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'bracket_name' => $request->bracket_name,
            'value' => $request->value,
            'percentage' => $request->percentage,
            'discount_percentage' => $request->discount_percentage,
            'level' => $request->level,
            'tax_setting_id' => $request->tax_setting_id,
            'company_id' => get_user_data()->company_id,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            //bracket_name' => $request->bracket_name,
            'value' => $request->value,
            'percentage' => $request->percentage,
            'discount_percentage' => $request->discount_percentage,
            'level' => $request->level,
        ];
    }
}
