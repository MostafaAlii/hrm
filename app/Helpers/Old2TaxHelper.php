<?php

namespace App\Helpers;

use App\Models\{TaxSetting, TaxBracket, EmployeeTaxCalculation};
use Illuminate\Support\Facades\Log;

class Old2TaxHelper
{
    private static $logged = false;

    public static function runAll($basic_salary = null, $user_id = null)
    {
        $results = [];
        $results['settings'] = self::getTaxSettingsData();

        if ($basic_salary !== null) {
            $taxCalculation = self::calculateProgressiveTax(
                $basic_salary,
                $results['settings']['tax_exemption_limit'],
                $results['settings']['brackets']
            );

            $results['tax_calculation'] = $taxCalculation;

            if ($user_id !== null) {
                self::saveTaxCalculation($user_id, $results['settings']['tax_setting_id'], $basic_salary, $taxCalculation);
            }
        }

        return $results;
    }

    public static function getTaxSettingsData(): array
    {
        $taxSetting = TaxSetting::where('company_id', get_user_data()->company_id)->first();
        $result = [
            'tax_setting_id' => $taxSetting->id ?? null,
            'tax_exemption_limit' => $taxSetting->tax_exemption_limit ?? null,
            'brackets' => $taxSetting ? TaxBracket::where('tax_setting_id', $taxSetting->id)->get() : []
        ];

        if (!self::$logged) {
            Log::channel('tax')->info('Tax settings data fetched successfully', [
                'tax_setting_id' => $result['tax_setting_id'],
                'tax_exemption_limit' => $result['tax_exemption_limit'],
                'brackets_count' => count($result['brackets']),
                'brackets_details' => $result['brackets']->map(function ($bracket) {
                    return [
                        'id' => $bracket->id,
                        'bracket_name' => $bracket->bracket_name,
                        'value' => $bracket->value,
                        'percentage' => $bracket->percentage
                    ];
                })->toArray()
            ]);
            self::$logged = true;
        }

        return $result;
    }

    public static function calculateProgressiveTax($monthly_salary, $annual_tax_exemption_limit, $brackets)
    {
        // 1. نحول كل شيء إلى سنوي أولاً
        $annual_salary = $monthly_salary * 12;
        $annual_taxable_income = $annual_salary - $annual_tax_exemption_limit;

        // حساب المبلغ الخاضع للضريبة شهرياً
        $monthly_taxable_income = $annual_taxable_income / 12;

        // إذا كان الراتب السنوي أقل من حد الإعفاء، فلا ضريبة
        if ($annual_taxable_income <= 0) {
            return [
                'annual_salary' => $annual_salary,
                'annual_taxable_income' => 0,
                'monthly_taxable_income' => 0,
                'annual_tax' => 0,
                'monthly_tax' => 0,
                'brackets_breakdown' => []
            ];
        }

        $annual_tax = 0;
        $remaining_income = $annual_taxable_income;
        $brackets_breakdown = [];

        // ناخد الشرائح بنفس الترتيب اللي في الداتابيز من غير ترتيب
        foreach ($brackets as $bracket) {
            if ($remaining_income <= 0) break;

            $bracket_max = $bracket->value;
            $bracket_percentage = $bracket->percentage;

            // نتأكد أن الشريحة ليست صفرية
            if ($bracket_max <= 0) continue;

            // نحدد المبلغ الخاضع للضريبة في هذه الشريحة
            $amount_in_bracket = min($remaining_income, $bracket_max);

            // نحسب الضريبة لهذه الشريحة
            $tax_in_bracket = $amount_in_bracket * ($bracket_percentage / 100);

            $annual_tax += $tax_in_bracket;
            $remaining_income -= $amount_in_bracket;

            $brackets_breakdown[] = [
                'bracket_name' => $bracket->bracket_name,
                'amount_in_bracket' => $amount_in_bracket,
                'tax_rate' => $bracket_percentage,
                'tax_amount' => $tax_in_bracket
            ];
        }

        // حساب الضريبة الشهرية
        $monthly_tax = $annual_tax / 12;

        return [
            'annual_salary' => $annual_salary,
            'annual_taxable_income' => $annual_taxable_income,
            'monthly_taxable_income' => $monthly_taxable_income,
            'annual_tax' => $annual_tax,
            'monthly_tax' => $monthly_tax,
            'brackets_breakdown' => $brackets_breakdown
        ];
    }

    // دالة جديدة لحفظ الحساب في الداتابيز
    private static function saveTaxCalculation($user_id, $tax_setting_id, $monthly_salary, $taxCalculation)
    {
        try {
            EmployeeTaxCalculation::create([
                'employee_id' => $user_id,
                'tax_setting_id' => $tax_setting_id,
                'monthly_salary' => $monthly_salary,
                'annual_salary' => $taxCalculation['annual_salary'],
                'annual_taxable_income' => $taxCalculation['annual_taxable_income'],
                'monthly_taxable_income' => $taxCalculation['monthly_taxable_income'],
                'annual_tax' => $taxCalculation['annual_tax'],
                'monthly_tax' => $taxCalculation['monthly_tax'],
                'brackets_breakdown' => $taxCalculation['brackets_breakdown']
            ]);

            Log::channel('tax')->info('Tax calculation saved successfully', [
                'employee_id' => $user_id,
                'monthly_taxable_income' => $taxCalculation['monthly_taxable_income'],
                'monthly_tax' => $taxCalculation['monthly_tax'],
                'annual_tax' => $taxCalculation['annual_tax']
            ]);
        } catch (\Exception $e) {
            Log::channel('tax')->error('Failed to save tax calculation', [
                'employee_id' => $user_id,
                'error' => $e->getMessage()
            ]);
        }
    }
}