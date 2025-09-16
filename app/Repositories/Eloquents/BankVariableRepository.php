<?php

namespace App\Repositories\Eloquents;

use App\Models\BankVariable;
use App\Repositories\Contracts\BankRepositoryInterface;
use Illuminate\Http\Request;

class BankVariableRepository extends BaseRepository implements BankRepositoryInterface {
    public function __construct(BankVariable $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'contact_person' => $request->contact_person,
            'phone_number'   => $request->phone_number,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'contact_person' => $request->contact_person,
            'phone_number'   => $request->phone_number,
        ];
    }
}
