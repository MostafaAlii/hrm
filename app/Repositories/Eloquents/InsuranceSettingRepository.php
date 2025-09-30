<?php

namespace App\Repositories\Eloquents;

use App\Models\InsuranceSetting;
use App\Repositories\Contracts\InsuranceSettingRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceSettingRepository extends BaseRepository implements InsuranceSettingRepositoryInterface
{
    protected $rules = [
        'max_insurance_amount' => 'required|numeric|min:0',
        'min_insurance_amount' => 'required|numeric|min:0',
        'employee_deduction_percentage' => 'required|numeric|min:0|max:100',
        'company_deduction_percentage' => 'required|numeric|min:0|max:100',
        'employees_fund_percentage' => 'required|numeric|min:0|max:100',
    ];

    public function __construct(InsuranceSetting $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array
    {
        $data = [];
        if ($context === 'index') {
            $insuranceSetting = $this->model
                ->where('company_id', get_user_data()->company_id)
                ->first();

            // إذا مفيش إعدادات، نرجع instance فاضية من الـ model
            $data['insuranceSetting'] = $insuranceSetting ?? new InsuranceSetting();
        }
        return $data;
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'max_insurance_amount' => $request->max_insurance_amount,
            'min_insurance_amount' => $request->min_insurance_amount,
            'employee_deduction_percentage' => $request->employee_deduction_percentage,
            'company_deduction_percentage' => $request->company_deduction_percentage,
            'employees_fund_percentage' => $request->employees_fund_percentage,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'max_insurance_amount' => $request->max_insurance_amount,
            'min_insurance_amount' => $request->min_insurance_amount,
            'employee_deduction_percentage' => $request->employee_deduction_percentage,
            'company_deduction_percentage' => $request->company_deduction_percentage,
            'employees_fund_percentage' => $request->employees_fund_percentage,
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $existingSetting = $this->model->where('company_id', get_user_data()->company_id)->first();
        if ($existingSetting) {
            return redirect()->back()->with('error', 'إعدادات التأمينات موجودة بالفعل لهذه الشركة!');
        }
        $data = [
            'max_insurance_amount' => $request->max_insurance_amount,
            'min_insurance_amount' => $request->min_insurance_amount,
            'employee_deduction_percentage' => $request->employee_deduction_percentage,
            'company_deduction_percentage' => $request->company_deduction_percentage,
            'employees_fund_percentage' => $request->employees_fund_percentage,
            'company_id' => get_user_data()->company_id,
            'added_by_id' => get_user_data()->id,
        ];
        $data = array_merge($data, $this->extraStoreFields($request));
        $record = $this->model->create($data);
        $this->afterStore($record, $request);
        return redirect()->back()->with('success', 'تم حفظ إعدادات التأمينات بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules);
        $record = $this->model->findOrFail($id);
        $data = [
            'max_insurance_amount' => $request->max_insurance_amount,
            'min_insurance_amount' => $request->min_insurance_amount,
            'employee_deduction_percentage' => $request->employee_deduction_percentage,
            'company_deduction_percentage' => $request->company_deduction_percentage,
            'employees_fund_percentage' => $request->employees_fund_percentage,
            'updated_by_id' => get_user_data()->id,
        ];
        $data = array_merge($data, $this->extraUpdateFields($request, $id));
        $record->update($data);
        $this->afterUpdate($record, $request);
        return redirect()->back()->with('success', 'تم تحديث إعدادات التأمينات بنجاح!');
    }
}
