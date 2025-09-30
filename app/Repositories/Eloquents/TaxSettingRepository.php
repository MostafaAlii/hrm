<?php
namespace App\Repositories\Eloquents;
use App\Models\TaxSetting;
use App\Repositories\Contracts\TaxSettingRepositoryInterface;
use Illuminate\Http\Request;
class TaxSettingRepository extends BaseRepository implements TaxSettingRepositoryInterface {
    protected $rules = [
        'recalculate_taxes' => 'nullable|boolean',
        'tax_exemption_limit' => 'required|numeric|min:0',
    ];

    public function __construct(TaxSetting $model) {
        parent::__construct($model);
    }

    /*protected function extraData(string $context): array {
        $data = [];
        if ($context === 'index') {
            $taxSetting = $this->model
                ->with(['taxBrackets'])
                ->where('company_id', get_user_data()->company_id)
                ->first();
            $data['taxSetting'] = $taxSetting;
            $data['taxBrackets'] = $taxSetting?->taxBrackets ?? collect();
        }
        if ($context === 'show' || $context === 'edit') {
            $routeParams = request()->route()?->parameters() ?? [];
            $id = $routeParams['id'] ?? null;
            if ($id) {
                $taxSetting = $this->model
                    ->with(['taxBrackets'])
                    ->find($id);
                $data['taxBrackets'] = $taxSetting?->taxBrackets ?? collect();
            } else {
                $data['taxBrackets'] = collect();
            }
        }
        return $data;
    }*/
    protected function extraData(string $context): array
    {
        $data = [];
        if ($context === 'index') {
            $taxSetting = $this->model
                ->with(['taxBrackets'])
                ->where('company_id', get_user_data()->company_id)
                ->first();
            $data['taxSetting'] = $taxSetting;
            $data['taxBrackets'] = $taxSetting?->taxBrackets ?? collect();
        }
        if ($context === 'show' || $context === 'edit') {
            $routeParams = request()->route()?->parameters() ?? [];
            $id = $routeParams['id'] ?? null;
            if ($id) {
                $taxSetting = $this->model
                    ->with(['taxBrackets'])
                    ->find($id);
                $data['taxBrackets'] = $taxSetting?->taxBrackets ?? collect();
            } else {
                $data['taxBrackets'] = collect();
            }
        }
        return $data;
    }


    protected function extraStoreFields(Request $request): array {
        return [
            'recalculate_taxes' => $request->has('recalculate_taxes'),
            'tax_exemption_limit' => $request->tax_exemption_limit,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array {
        return [
            'recalculate_taxes' => $request->has('recalculate_taxes'),
            'tax_exemption_limit' => $request->tax_exemption_limit,
        ];
    }

    public function store(Request $request) {
        $validated = $request->validate($this->rules);
        $existingSetting = $this->model->where('company_id', get_user_data()->company_id)->first();

        if ($existingSetting) {
            return redirect()->back()->with('error', 'إعدادات الضرائب موجودة بالفعل لهذه الشركة!');
        }

        $data = [
            'recalculate_taxes' => $request->has('recalculate_taxes'),
            'tax_exemption_limit' => $request->tax_exemption_limit,
            'company_id' => get_user_data()->company_id,
            'added_by_id' => get_user_data()->id,
        ];

        $data = array_merge($data, $this->extraStoreFields($request));
        $record = $this->model->create($data);
        $this->afterStore($record, $request);

        return redirect()->back()->with('success', 'تم حفظ إعدادات الضرائب بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules);
        $record = $this->model->findOrFail($id);

        $data = [
            'recalculate_taxes' => $request->has('recalculate_taxes'),
            'tax_exemption_limit' => $request->tax_exemption_limit,
            'updated_by_id' => get_user_data()->id,
        ];

        $data = array_merge($data, $this->extraUpdateFields($request, $id));
        $record->update($data);
        $this->afterUpdate($record, $request);

        return redirect()->back()->with('success', 'تم تحديث إعدادات الضرائب بنجاح!');
    }
}
