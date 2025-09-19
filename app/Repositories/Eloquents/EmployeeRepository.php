<?php

namespace App\Repositories\Eloquents;

use App\Models\{BloodType, Employee, Religion, Governorate, Gender, Nationality, Level, Branch, Department, Section, JobCategory, SalaryPlace};
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Concerns\UploadMedia;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface {
    use UploadMedia;
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array {
        $data = [];
        if ($context === 'show') {
            $data['genders']       = Gender::active()->get();
            $data['nationalities'] = Nationality::active()->get();
            $data['levels']        = Level::active()->get();
            $data['branches']      = Branch::active()->get();
            $data['departments']   = Department::active()->get();
            $data['sections']      = Section::active()->get();
            $data['jobCategories'] = JobCategory::active()->get();
            $data['salaryPlaces']  = SalaryPlace::active()->get();
            $data['governorates']  = Governorate::active()->get();
            $data['religions']  = Religion::active()->get();
            $data['bloodTypes']  = BloodType::active()->get();
            if (request()->route('id')) {
                $employee = $this->model->with(['profile', 'militaryService'])->find(request()->route('id'));
                $data['profile'] = $employee?->profile;
                $data['militaryService'] = $employee?->militaryService;
            }
        }
        if (in_array($context, ['create', 'edit', 'index'])) {
            $data['genders']      = Gender::active()->get();
            $data['nationalities'] = Nationality::active()->get();
            $data['levels']       = Level::active()->get();
            $data['branches']     = Branch::active()->get();
            $data['departments']  = Department::active()->get();
            $data['sections']     = Section::active()->get();
            $data['jobCategories'] = JobCategory::active()->get();
            $data['salaryPlaces']  = SalaryPlace::active()->get();
        }
        return $data;
    }

    protected function extraStoreFields(Request $request): array {

        return [
            'code'   => $request->code,
            'barcode'   => $request->barcode,
            'email'   => $request->email,
            'password'   => bcrypt($request->password),
            'gender_id'   => $request->gender_id,
            'nationality_id'   => $request->nationality_id,
            'level_id'   => $request->level_id,
            'branch_id'   => $request->branch_id,
            'department_id'   => $request->department_id,
            'section_id'   => $request->section_id,
            'job_category_id'   => $request->job_category_id,
            'salary_place_id'   => $request->salary_place_id,
            'hiring_date'       => $request->hiring_date,
            'birthday_date'       => $request->birthday_date,
            'identity_number'       => $request->identity_number,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array {
        $record = $this->model->findOrFail($id);
        $data = [
            'hiring_date'       => $request->hiring_date,
            'birthday_date'       => $request?->birthday_date,
            'identity_number'       => $request?->identity_number,
            'gender_id'       => $request?->gender_id,
            'nationality_id'       => $request?->nationality_id,
        ];
        if ($request->hasFile('employee')) {
            $fileName = $record->updateSingleMedia('employee', $request->file('employee'), $record, null, 'media', true);
            $data['employee'] = $fileName;
        }
        return $data;
    }

    protected function afterStore($employee, Request $request): void {
        event(new \App\Events\EmployeeSaved($employee));
    }
}
