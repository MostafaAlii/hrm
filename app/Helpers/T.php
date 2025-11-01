<?php
class TaxHelper
{
    private static $logged = false;

    // عدلنا runAll علشان تقبل user_id
    public static function runAll($basic_salary = null, $user_id = null)
    {
        $results = [];
        $results['settings'] = self::getTaxSettingsData();

        // إذا تم تمرير basic_salary نحسب الضريبة
        if ($basic_salary !== null) {
            $taxCalculation = self::calculateProgressiveTax(
                $basic_salary,
                $results['settings']['tax_exemption_limit'],
                $results['settings']['brackets']
            );

            $results['tax_calculation'] = $taxCalculation;

            // إذا تم تمرير user_id نحفظ في الداتابيز
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

    public static function calculateProgressiveTax($monthly_salary, $tax_exemption_limit, $brackets) {
        // تحويل الراتب الشهري إلى سنوي
        $annual_salary = $monthly_salary * 12;

        // أولاً: نطرح حد الإعفاء السنوي من الراتب السنوي
        $annual_taxable_income = $annual_salary - $tax_exemption_limit;

        // إذا كان الراتب السنوي أقل من حد الإعفاء، فلا ضريبة
        if ($annual_taxable_income <= 0) {
            return [
                'annual_salary' => $annual_salary,
                'annual_taxable_income' => 0,
                'annual_tax' => 0,
                'monthly_tax' => 0,
                'brackets_breakdown' => []
            ];
        }

        $annual_tax = 0;
        $remaining_income = $annual_taxable_income;
        $brackets_breakdown = [];

        // نفرز الشرائح ترتيب تصاعدي حسب القيمة
        $sorted_brackets = $brackets->sortBy('value');

        foreach ($sorted_brackets as $bracket) {
            if ($remaining_income <= 0) break;

            $bracket_max = $bracket->value;
            $bracket_percentage = $bracket->percentage;

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
            'annual_tax' => $annual_tax,
            'monthly_tax' => $monthly_tax,
            'brackets_breakdown' => $brackets_breakdown
        ];
    }

    // دالة جديدة لحفظ الحساب في الداتابيز
    private static function saveTaxCalculation($user_id, $tax_setting_id, $monthly_salary, $taxCalculation) {
        try {
            TaxCalculation::create([
                'user_id' => $user_id,
                'tax_setting_id' => $tax_setting_id,
                'monthly_salary' => $monthly_salary,
                'annual_salary' => $taxCalculation['annual_salary'],
                'annual_taxable_income' => $taxCalculation['annual_taxable_income'],
                'annual_tax' => $taxCalculation['annual_tax'],
                'monthly_tax' => $taxCalculation['monthly_tax'],
                'brackets_breakdown' => $taxCalculation['brackets_breakdown']
            ]);

            Log::channel('tax')->info('Tax calculation saved successfully', [
                'user_id' => $user_id,
                'monthly_tax' => $taxCalculation['monthly_tax']
            ]);
        } catch (\Exception $e) {
            Log::channel('tax')->error('Failed to save tax calculation', [
                'user_id' => $user_id,
                'error' => $e->getMessage()
            ]);
        }
    }
}