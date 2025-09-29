<?php

namespace App\Repositories\Eloquents;

use App\Models\{
        BloodType, ContractType, InsuranceType, InsuranceRegion, InsuranceOffice, Employee,
        Religion, Governorate, Gender, Nationality, Level, Branch, Department, Section, JobCategory,
        SalaryPlace,Qualification,EducationalDegree,University,Specialization,Grade,RelativeDegree,FamilyJob,
        LicenseVariable,EmploymentDocument
    };
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Concerns\UploadMedia;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface {
    use UploadMedia;
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }
    protected function extraData(string $context): array{
        $data = [];
        if ($context === 'show') {
            $data['genders']       = Gender::active()->get(['id', 'name']);
            $data['nationalities'] = Nationality::active()->get(['id', 'name']);
            $data['levels']        = Level::active()->get(['id', 'name']);
            $data['branches']      = Branch::active()->get(['id', 'name']);
            $data['departments']   = Department::active()->get(['id', 'name', 'branch_id']);
            $data['sections']      = Section::active()->get(['id', 'name', 'department_id']);
            $data['jobCategories'] = JobCategory::active()->get(['id', 'name', 'department_id', 'section_id']);
            $data['salaryPlaces']  = SalaryPlace::active()->get(['id', 'name']);
            $data['governorates']  = Governorate::active()->get();
            $data['religions']     = Religion::active()->get();
            $data['bloodTypes']    = BloodType::active()->get();
            $routeParams = request()->route()?->parameters() ?? [];
            $id = $routeParams['id'] ?? $routeParams['employee'] ?? $routeParams['employee_id'] ?? ($routeParams ? array_values($routeParams)[0] : null);

            if ($id) {
                $employee = $this->model
                    ->with([
                        'profile', 'militaryService', 'contracts.contractType', 'insurances.insuranceType',
                        'insurances.insuranceRegion', 'insurances', 'latestInsurance', 'families.relativeDegree',
                        'families.familyJob','emergencyContacts.relativeDegree','trainings.grade',
                        'licenses.licenseVariable','employmentDocuments.employmentDocument', 'employmentDocuments.media',
                        'experiences',
                    ])
                    ->find($id);
                    $data['profile'] = $employee?->profile;
                    $data['militaryService'] = $employee?->militaryService;
                    $data['contracts'] = $employee?->contracts ?? collect();
                    $data['employeeInsurances'] = $employee?->insurances ?? collect();
                    $data['latestInsurance'] = $employee?->latestInsurance ?? collect();
                    $data['families'] = $employee?->families ?? collect();
                    $data['emergencyContacts'] = $employee?->emergencyContacts ?? collect();
                    $data['trainings'] = $employee?->trainings ?? collect();
                    $data['licenses'] = $employee?->licenses ?? collect();
                    $data['employmentDocuments'] = $employee?->employmentDocuments ?? collect();
                    $data['experiences'] = $employee?->experiences ?? collect();
            } else {
                $data['profile'] = null;
                $data['militaryService'] = null;
                $data['contracts'] = collect();
                $data['emergencyContacts'] = collect();
                $data['trainings'] = collect();
                $data['licenses'] = collect();
                $data['employmentDocuments'] = collect();
                $data['experiences'] = collect();
            }
            $data['relativeDegrees'] = RelativeDegree::select('id', 'name_ar')->get();
            $data['familyJobs']      = FamilyJob::select('id', 'name_ar')->get();
            $data['contractTypes'] = ContractType::select('id', 'name_ar')->get();
            $data['insuranceTypes']   = InsuranceType::select('id', 'name_ar')->get();
            $data['insuranceRegions'] = InsuranceRegion::select('id', 'name_ar')->get();
            $data['insuranceOffices'] = InsuranceOffice::select('id', 'name_ar')->get();
            $data['qualifications'] = Qualification::active()->select('id', 'name')->get();
            $data['educationalDegrees'] = EducationalDegree::select('id', 'name_ar')->get();
            $data['universities'] = University::select('id', 'name_ar')->get();
            $data['specializations'] = Specialization::select('id', 'name_ar')->get();
            $data['grades'] = Grade::select('id', 'name_ar')->get();
            $data['licenseVariables'] = LicenseVariable::select('id', 'name_ar')->get();
            $data['employmentDocumentsList'] = EmploymentDocument::select('id', 'name_ar')->get();
        }

        if (in_array($context, ['create', 'edit', 'index'])) {
            $data['genders']       = Gender::active()->get();
            $data['nationalities'] = Nationality::active()->get();
            $data['levels']        = Level::active()->get();
            $data['branches']      = Branch::active()->get();
            $data['departments']   = Department::active()->get();
            $data['sections']      = Section::active()->get();
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
