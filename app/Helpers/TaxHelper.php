<?php

namespace App\Helpers;

use App\Models\TaxSetting;
use App\Models\TaxBracket;

class TaxHelper {
    /**
     * حساب الضريبة الشهرية بناءً على الراتب الأساسي
     *
     * @param float $basicSalary
     * @param int|null $companyId
     * @return array
     */
    public static function calculateMonthlyTax($basicSalary, $companyId) {
        $taxSetting = TaxSetting::where('company_id', $companyId)->first();
        
        if (!$taxSetting) {
            return [
                'taxable_amount' => 0,
                'tax_amount' => 0,
                'net_salary' => $basicSalary,
            ];
        }

        // حساب الراتب السنوي
        $annualSalary = $basicSalary * 12;
        
        // حساب المبلغ المعفى سنوياً
        $taxExemptionLimit = $taxSetting->tax_exemption_limit;
        
        // حساب المبلغ الخاضع للضريبة سنوياً
        $taxableAnnual = max($annualSalary - $taxExemptionLimit, 0);
        
        // الحصول على الشرائح الضريبية
        $brackets = TaxBracket::where('tax_setting_id', $taxSetting->id)
            ->orderBy('id', 'asc')
            ->get();

        $remaining = $taxableAnnual;
        $totalTax = 0;

        // حساب الضريبة حسب الشرائح
        foreach ($brackets as $bracket) {
            if ($remaining <= 0) break;
            
            $bracketValue = $bracket->value;
            $taxRate = $bracket->percentage / 100;
            $discountRate = $bracket->discount_percentage / 100;
            
            // إذا كانت القيمة 0 تعني الشريحة الأخيرة (لا يوجد حد أعلى)
            if ($bracketValue == 0) {
                $amountInBracket = $remaining;
            } else {
                $amountInBracket = min($remaining, $bracketValue);
            }
            
            $taxBeforeDiscount = $amountInBracket * $taxRate;
            $taxAfterDiscount = $taxBeforeDiscount * (1 - $discountRate);
            $totalTax += $taxAfterDiscount;
            $remaining -= $amountInBracket;
        }

        // التحويل إلى قيم شهرية
        $monthlyTaxable = round($taxableAnnual / 12, 2);
        $monthlyTax = round($totalTax / 12, 2);
        $netSalary = round($basicSalary - $monthlyTax, 2);

        return [
            'taxable_amount' => $monthlyTaxable, // المبلغ الخاضع للضريبة شهرياً
            'tax_amount' => $monthlyTax,         // قيمة الضريبة الشهرية
            'net_salary' => $netSalary,          // صافي المرتب بعد الضريبة
        ];
    }
}
