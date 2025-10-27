<?php

namespace App\Repositories\Eloquents;

use App\Models\RevenueType;
use App\Repositories\Contracts\RevenueTypeRepositoryInterface;
use Illuminate\Http\Request;

class RevenueTypeRepository extends BaseRepository implements RevenueTypeRepositoryInterface
{
    protected $rules = [
        'name_ar' => 'nullable|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(RevenueType $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array
    {
        return [];
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->has('is_active'),
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        $record = $this->model->findOrFail($id);

        $rules = $this->rules;
        //$rules['code'] = 'nullable|string|max:50|unique:revenue_types,code,' . $id;

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->has('is_active'),
        ];
    }
}
