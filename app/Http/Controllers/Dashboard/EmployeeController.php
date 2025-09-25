<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EmployeeRepository;
use App\DataTables\Dashboard\Admin\EmployeeDataTable;
use Illuminate\Http\Request;
use App\Models\{Employee, EmployeeInsurance};
use App\Models\Concerns\UploadMedia;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller {
    use UploadMedia;
    protected $repository;

    public function __construct(EmployeeRepository $repository) {
        $this->repository = $repository;
    }

    public function index(EmployeeDataTable $dataTable) {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.employees.index',
            'الموظفين '
        );
    }

    public function create() {
        return $this->repository->create(
            'dashboard.admin.employees.btn.create',
            'إضافة موظف'
        );
    }

    public function store(Request $request) {
        return $this->repository->store($request);
    }

    public function show($id) {
        return $this->repository->show(
            $id,
            'dashboard.admin.employees.btn.show',
            'تفاصيل الموظف'
        );
    }

    public function edit($id) {
        return $this->repository->edit(
            $id,
            'dashboard.admin.employees.btn.edit',
            'تعديل  موظف'
        );
    }

    public function update(Request $request, $id) {
        return $this->repository->update($request, $id);
    }

    public function destroy(Employee $employee) {
        return $this->repository->destroy($employee);
    }

    public function update_profile(Request $request, $id) {
        $validated = $request->validate([
            'identity_number'      => 'nullable|string|max:255',
            'birthday_date'        => 'nullable|date',
            'gender_id'            => 'required|exists:genders,id',
            'nationality_id'       => 'required|exists:nationalities,id',
            'birth_governorate_id' => 'nullable|exists:governorates,id',
            'address_governorate_id' => 'nullable|exists:governorates,id',
            'religion_id'          => 'nullable|exists:religions,id',
            'marital_status'       => 'nullable|string|in:single,married,divorced,widowed',
            'blood_type_id'        => 'nullable|exists:blood_types,id',
            'address_city'         => 'nullable|string',
            'address'         => 'nullable|string',
            'phone'                  => 'nullable|string|max:20',
            'mobile1'                => 'nullable|string|max:20',
            'mobile2'                => 'nullable|string|max:20',
            'fax'                    => 'nullable|string|max:20',
            'email'                  => 'nullable|email|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'identity_number' => $validated['identity_number'] ?? $employee->identity_number,
            'birthday_date'   => $validated['birthday_date'] ?? $employee->birthday_date,
            'gender_id'       => $validated['gender_id'] ?? $employee->gender_id,
            'nationality_id'  => $validated['nationality_id'] ?? $employee->nationality_id,
        ]);

        $employee->profile()->updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'identity_number'      => $validated['identity_number'] ?? $employee->profile?->identity_number,
                'birthday_date'        => $validated['birthday_date'] ?? $employee->profile?->birthday_date,
                'gender_id'            => $validated['gender_id'] ?? $employee->profile?->gender_id,
                'nationality_id'       => $validated['nationality_id'] ?? $employee->profile?->nationality_id,
                'birth_governorate_id' => $validated['birth_governorate_id'] ?? $employee->profile?->birth_governorate_id,
                'religion_id'          => $validated['religion_id'] ?? $employee->profile?->religion_id,
                'marital_status'       => $validated['marital_status'] ?? $employee->profile?->marital_status,
                'blood_type_id'        => $validated['blood_type_id'] ?? $employee->profile?->blood_type_id,
                'address_governorate_id'        => $validated['address_governorate_id'] ?? $employee->profile?->address_governorate_id,
                'address_city'        => $validated['address_city'] ?? $employee->profile?->address_city,
                'address'        => $validated['address'] ?? $employee->profile?->address,
                'phone'        => $validated['phone'] ?? $employee->profile?->phone,
                'mobile1'        => $validated['mobile1'] ?? $employee->profile?->mobile1,
                'mobile2'        => $validated['mobile2'] ?? $employee->profile?->mobile2,
                'fax'        => $validated['fax'] ?? $employee->profile?->fax,
                'email'        => $validated['email'] ?? $employee->profile?->email,

            ]
        );

        return redirect()->back()->with('success', 'تم تحديث البيانات الشخصية بنجاح');
    }

    public function update_military_service(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'military_card_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'batch_number' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
            'status' => 'nullable|string|in:' . implode(',', array_column(\App\Enums\Employee\MilitaryStatus::cases(), 'value')),
            'status' => 'nullable|string',
            'employeeMilitaryCertificate' => 'nullable|image|mimes:jpeg,png,webp|max:2048', // Validate the image
        ]);
        $militaryService = $employee->militaryService()->updateOrCreate(
            ['employee_id' => $employee->id],
            array_filter($validated, fn($key) => $key !== 'employeeMilitaryCertificate', ARRAY_FILTER_USE_KEY)
        );
        $militaryService = $employee->militaryService;
        if ($request->hasFile('employeeMilitaryCertificate')) {
            $militaryService->updateSingleMedia(
                baseFolder: 'employeeMilitaryCertificates',
                file: $request->file('employeeMilitaryCertificate'),
                model: $militaryService,
                relation: 'media',
                useStorage: true,
                generateThumbnail: true,
                collectionName: 'employeeMilitaryCertificate',
                addWatermark: false
            );
        }
        return back()->with('success', 'تم تحديث بيانات الخدمة العسكرية بنجاح');
    }

    public function contractStore(Request $request, Employee $employee) {
        $validated = $request->validate([
            'contract_type_id' => 'required|exists:contract_types,id',
            'start_date'       => 'required|date',
            'insurance_date'   => 'nullable|date',
            'renewal_date'     => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->start_date) {
                        $start = \Carbon\Carbon::parse($request->start_date);
                        $end   = \Carbon\Carbon::parse($value);

                        if ($end->lessThanOrEqualTo($start)) {
                            $fail('تاريخ التجديد يجب أن يكون بعد تاريخ بداية العقد، ولا يمكن أن يكون في نفس اليوم.');
                        }
                    }
                },
            ],
            'description'      => 'nullable|string',
        ], [
            'contract_type_id.required' => 'برجاء اختيار نوع العقد.',
            'contract_type_id.exists'   => 'نوع العقد غير صالح.',
            'start_date.required'       => 'تاريخ بداية العقد مطلوب.',
            'start_date.date'           => 'تاريخ البداية يجب أن يكون تاريخ صحيح.',
            'insurance_date.date'       => 'تاريخ التأمينات يجب أن يكون تاريخ صحيح.',
            'renewal_date.date'         => 'تاريخ التجديد يجب أن يكون تاريخ صحيح.',
        ]);

        DB::beginTransaction();
        try {
            $employee->contracts()->create(array_merge($validated, [
                'company_id'   => get_user_data()->company_id,
                'added_by_id'  => get_user_data()->id,
            ]));
            DB::commit();
            return redirect()->back()->with('success', 'تم إضافة العقد بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ العقد: ' . $e->getMessage());
        }
    }

    public function contractDestroy(Employee $employee, $contractId) {
        DB::beginTransaction();
        try {
            $contract = $employee->contracts()->findOrFail($contractId);
            $contract->delete();
            DB::commit();
            return redirect()->back()->with('success', 'تم حذف العقد بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف العقد: ' . $e->getMessage());
        }
    }

    public function updateInsurance(Request $request, Employee $employee) {
        /*$validated = $request->validate([
            'is_insured' => 'nullable|boolean',
            'salary_insurance' => 'nullable|boolean',
            'employee_fund' => 'nullable|boolean',
            'insurance_type_id' => 'nullable|exists:insurance_types,id',
            'insurance_region_id' => 'nullable|exists:insurance_regions,id',
            'insurance_office_id' => 'nullable|exists:insurance_offices,id',
            'insurance_number' => 'nullable|string|max:255',
            'insurance_date' => 'nullable|date',
            'is_health_insured' => 'nullable|boolean',
            'dependents_count' => 'nullable|integer|min:0',
            'non_dependents_count' => 'nullable|integer|min:0',
            'company_share' => 'nullable|numeric|min:0',
            'employee_share' => 'nullable|numeric|min:0',
            'insurance_amount' => 'nullable|numeric|min:0',
        ]);*/
        $insurance = EmployeeInsurance::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'is_insured' => $request->has('is_insured'),
                'salary_insurance' => $request->has('salary_insurance'),
                'employee_fund' => $request->has('employee_fund'),
                'insurance_type_id' => $request->insurance_type_id,
                'insurance_region_id' => $request->insurance_region_id,
                'insurance_office_id' => $request->insurance_office_id,
                'insurance_number' => $request->insurance_number,
                'insurance_date' => $request->insurance_date,
                'is_health_insured' => $request->has('is_health_insured'),
                'dependents_count' => $request->dependents_count ?? 0,
                'non_dependents_count' => $request->non_dependents_count ?? 0,
                'company_share' => $request->company_share ?? 0,
                'employee_share' => $request->employee_share ?? 0,
                'insurance_amount' => $request->insurance_amount ?? 0,
                'company_id'   => get_user_data()->company_id,
                'updated_by_id'  => get_user_data()->id,
            ]
        );
        return redirect()->back()->with('success', 'تم تحديث بيانات التأمين بنجاح.');
    }
}
