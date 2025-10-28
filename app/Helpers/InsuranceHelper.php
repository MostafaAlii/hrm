<?php
namespace App\Helpers;

use App\Models\{Employee,InsuranceSetting, EmployeeInsurance, EmployeeVariableInsurance, EmployeeSocialInsurance};

class InsuranceHelper {
    public static function getSettingsByEmployee(int $employeeId): ?array {
        $employee = Employee::find($employeeId);
        if (! $employee) {
            return null;
        }
        $isInsured = self::isEmployeeInsured($employeeId);
        $companyId = $employee->company_id ?? null;
        if (! $companyId) {
            return [
                'is_insured' => $isInsured,
                'settings' => null,
            ];
        }
        $settings = self::getSettingsByCompany($companyId);
        return [
            'is_insured' => $isInsured,
            'settings' => $settings,
        ];
    }

    public static function getSettingsByCompany(int $companyId): ?array {
        $setting = InsuranceSetting::where('company_id', $companyId)->first();
        if (! $setting) {
            return null;
        }
        return [
            'company_id' => (int) $companyId,
            'max_insurance_amount' => $setting->max_insurance_amount,
            'min_insurance_amount' => $setting->min_insurance_amount,
            'employee_deduction_percentage' => $setting->employee_deduction_percentage,
            'company_deduction_percentage' => $setting->company_deduction_percentage,
        ];
    }

    public static function isEmployeeInsured(int $employeeId): bool {
        $insurance = EmployeeInsurance::where('employee_id', $employeeId)->first();
        return $insurance && $insurance->is_insured == 1;
    }

    /**
     * 🔹 حساب التأمين الصحي الشامل للموظف
     */
    public static function calculateComprehensiveHealthInsurance(int $employeeId): float {
        if (! self::isEmployeeInsured($employeeId)) {
            return 0.0;
        }
        $totalValue = EmployeeVariableInsurance::where('employee_id', $employeeId)->sum('value');
        if ($totalValue <= 0) {
            return 0.0;
        }
        $employee = Employee::find($employeeId);
        if (! $employee || ! $employee->company_id) {
            return 0.0;
        }
        $setting = InsuranceSetting::where('company_id', $employee->company_id)->first();
        if (! $setting || ! $setting->employee_deduction_percentage) {
            return 0.0;
        }
        $deductionPercentage = $setting->employee_deduction_percentage / 100;
        $comprehensiveInsurance = $totalValue * $deductionPercentage;
        return round($comprehensiveInsurance, 2);
    }

    /**
     * 🔹 حساب التأمين الاجتماعي للموظف
     */
    public static function calculateSocialInsurance(int $employeeId): float {
        $employee = Employee::find($employeeId);
        if (! $employee || ! $employee->company_id) {
            return 0.0;
        }
        $companyId = $employee->company_id;
        $setting = InsuranceSetting::where('company_id', $companyId)->first();
        if (! $setting) {
            return 0.0;
        }
        $minInsurance = $setting->min_insurance_amount ?? 0;
        $maxInsurance = $setting->max_insurance_amount ?? INF;
        $deductionPercentage = 0.10;
        $socialInsuranceSum = EmployeeSocialInsurance::where('employee_id', $employeeId)
            ->where('company_id', $companyId)
            ->sum('value');
        if ($socialInsuranceSum <= 0) {
            return round($minInsurance * $deductionPercentage, 2);
        }
        if ($socialInsuranceSum < $minInsurance) {
            $socialInsuranceSum = $minInsurance;
        } elseif ($socialInsuranceSum > $maxInsurance) {
            $socialInsuranceSum = $maxInsurance;
        }
        $insuranceValue = $socialInsuranceSum * $deductionPercentage;
        return round($insuranceValue, 2);
    }
}
