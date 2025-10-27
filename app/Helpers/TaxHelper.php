<?php

namespace App\Helpers;

use App\Models\{TaxSetting,TaxBracket};

class TaxHelper {
    public static function calculateMonthlyTax($basicSalary, $companyId) {
        $taxSetting = TaxSetting::where('company_id', $companyId)->first();
        if (!$taxSetting) {
            return [
                'taxable_amount' => 0,
                'tax_amount' => 0,
                'net_salary' => $basicSalary,
            ];
        }
        $annualSalary = $basicSalary * 12;
        $taxExemptionLimit = $taxSetting->tax_exemption_limit ?? 15000;
        $taxableAnnual = max($annualSalary - $taxExemptionLimit, 0);
        $brackets = TaxBracket::where('tax_setting_id', $taxSetting->id)->orderBy('id', 'asc')->get();
        $remaining = $taxableAnnual;
        $totalTax = 0;
        foreach ($brackets as $bracket) {
            if ($remaining <= 0) break;
            $bracketValue = $bracket->value;
            $taxRate = $bracket->percentage / 100;
            $discountRate = $bracket->discount_percentage / 100;
            $amountInBracket = min($remaining, $bracketValue ?: $remaining);
            $taxBeforeDiscount = $amountInBracket * $taxRate;
            $taxAfterDiscount = $taxBeforeDiscount * (1 - $discountRate);
            $totalTax += $taxAfterDiscount;
            $remaining -= $amountInBracket;
        }
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
        $monthlyTaxable = round($taxableAnnual / 12, 2);
        $monthlyTax = round($totalTax / 12, 2);
        $netSalary = round($basicSalary - $monthlyTax, 2);
        return [
            'taxable_amount' => $monthlyTaxable,
            'tax_amount' => $monthlyTax,
            'net_salary' => $netSalary,
        ];
    }
}
