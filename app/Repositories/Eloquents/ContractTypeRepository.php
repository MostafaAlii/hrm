<?php

namespace App\Repositories\Eloquents;

use App\Models\ContractType;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;
class ContractTypeRepository extends BaseRepository implements ContractTypeRepositoryInterface
{
    protected $rules = [
        'name_ar' => 'nullable|string|max:255',
        'name_en' => 'nullable|string|max:255',
        //'code'    => 'nullable|string|max:255|unique:contract_types,code',
    ];

    public function __construct(ContractType $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'code' => $request->code,
        ];
    }
}
