<?php
namespace App\Observers;
use App\Models\{Employee,Company};
use Illuminate\Support\Str;
class EmployeeObserver {
    public function creating(Employee $employee): void {
        if (empty($employee->name_en)) {
            $employee->name_en = Str::ascii($employee->name_ar);
        }
        $baseName = Str::lower(str_replace(' ', '', $employee->name_en));
        $company = Company::find($employee->company_id);
        $companyDomain = $company ? Str::slug($company->name, '') . '.com' : 'company.com';
        $email = $baseName . '@' . $companyDomain;
        $count = 1;
        $originalEmail = $email;

        while (Employee::where('email', $email)->exists()) {
            $email = $baseName . $count . '@' . $companyDomain;
            $count++;
        }

        $employee->email = $email;
        if (empty($employee->password)) {
            $employee->password = bcrypt('123456');
        }
        $employee->is_active = true;
    }
}