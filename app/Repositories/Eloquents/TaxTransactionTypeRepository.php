<?php

namespace App\Repositories\Eloquents;

use App\Models\TaxTransactionType;
use App\Repositories\Contracts\TaxTransactionTypeRepositoryInterface;
use Illuminate\Http\Request;

class TaxTransactionTypeRepository extends BaseRepository implements TaxTransactionTypeRepositoryInterface
{
    protected $rules = [
        'code' => 'required|string|max:50',
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(TaxTransactionType $model)
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
        //$rules['code'] = 'required|string|max:50|unique:tax_transaction_types,code,' . $id;

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->has('is_active'),
        ];
    }
}