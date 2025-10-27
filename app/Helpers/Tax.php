<?php

namespace App\Helpers;

use App\Models\TaxSetting;
use App\Models\TaxBracket;

class Tax
{
    public static function calculateMonthlyTax($basicSalary, $companyId)
    {
        $taxSetting = TaxSetting::where('company_id', $companyId)->first();

        if (!$taxSetting) {
            return [
                'taxable_amount' => 0,
                'tax_amount' => 0,
                'net_salary' => $basicSalary,
            ];
        }

        // 1️⃣ حساب الراتب السنوي
        $annualSalary = $basicSalary * 12;

        // 2️⃣ الإعفاء السنوي
        $taxExemptionLimit = $taxSetting->tax_exemption_limit ?? 15000;

        // 3️⃣ المبلغ الخاضع للضريبة سنويًا
        $taxableAnnual = max($annualSalary - $taxExemptionLimit, 0);

        // 4️⃣ الشرائح الضريبية
        $brackets = TaxBracket::where('tax_setting_id', $taxSetting->id)
            ->orderBy('id', 'asc')
            ->get();

        $remaining = $taxableAnnual;
        $totalTax = 0;

        foreach ($brackets as $bracket) {
            if ($remaining <= 0) break;

            $bracketValue = $bracket->value; // قيمة الشريحة (وليس تراكمي)
            $taxRate = $bracket->percentage / 100;
            $discountRate = $bracket->discount_percentage / 100;

            // الجزء داخل الشريحة الحالية
            $amountInBracket = min($remaining, $bracketValue ?: $remaining);

            $taxBeforeDiscount = $amountInBracket * $taxRate;
            $taxAfterDiscount = $taxBeforeDiscount * (1 - $discountRate);

            $totalTax += $taxAfterDiscount;
            $remaining -= $amountInBracket;
        }

        // 5️⃣ تطبيق الخصم التشجيعي الصحيح على الضريبة بعد الشرائح
        $taxDiscount = 0;

        if ($taxableAnnual <= 30000) {
            $taxDiscount = 0.85; // خصم 85%
        } elseif ($taxableAnnual <= 45000) {
            $taxDiscount = 0.45; // خصم 45%
        } elseif ($taxableAnnual <= 60000) {
            $taxDiscount = 0.075; // خصم 7.5%
        }

        if ($taxDiscount > 0) {
            $totalTax = $totalTax * (1 - $taxDiscount);
        }

        // 6️⃣ التحويل إلى شهري
        $monthlyTaxable = round($taxableAnnual / 12, 2);
        $monthlyTax = round($totalTax / 12, 2);
        $netSalary = round($basicSalary - $monthlyTax, 2);

        // 7️⃣ النتيجة
        return [
            'taxable_amount' => $monthlyTaxable,
            'tax_amount' => $monthlyTax,
            'net_salary' => $netSalary,
        ];
    }
}
