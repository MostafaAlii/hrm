<?php
namespace App\Repositories\Eloquents;
use App\Models\DeductionType;
use App\Repositories\Contracts\DeductionTypeRepositoryInterface;
use Illuminate\Http\Request;
class DeductionTypeRepository extends BaseRepository implements DeductionTypeRepositoryInterface {
    protected $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(DeductionType $model)
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

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'is_active' => $request->has('is_active'),
        ];
    }

    public function getFixedTypes()
    {
        return $this->model->active()->fixed()->get();
    }

    public function getPercentageTypes()
    {
        return $this->model->active()->percentage()->get();
    }
}
