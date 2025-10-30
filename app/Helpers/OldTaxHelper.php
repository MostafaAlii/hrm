<?php

namespace App\Helpers;
use App\Models\{TaxSetting, TaxBracket};
use Illuminate\Support\Facades\Log;
class OldTaxHelper {
    public static function getTaxSettingsData(): array {
        // 🟢 الخطوة 1: جلب company_id من get_user_data()
        $userData = get_user_data();
        Log::channel('tax')->debug('Fetching user data', [
            'user_data' => $userData
        ]);
        if (!isset($userData->company_id) || !is_numeric($userData->company_id)) {
            Log::channel('tax')->error('Invalid or missing company_id', [
                'company_id' => $userData->company_id ?? null
            ]);
            return [
                'tax_setting_id' => null,
                'tax_exemption_limit' => null,
                'brackets' => [],
            ];
        }
        $companyId = (int) $userData->company_id;
        Log::channel('tax')->debug('Company ID extracted', ['company_id' => $companyId]);
        // 🟢 الخطوة 2: جلب tax_setting المقابل للشركة
        $taxSetting = TaxSetting::where('company_id', $companyId)->first();
        if (!$taxSetting) {
            Log::channel('tax')->warning('No tax_setting found for company', [
                'company_id' => $companyId
            ]);
            return [
                'tax_setting_id' => null,
                'tax_exemption_limit' => null,
                'brackets' => [],
            ];
        }
        Log::channel('tax')->debug('TaxSetting found', [
            'tax_setting_id' => $taxSetting->id,
            'tax_exemption_limit' => $taxSetting->tax_exemption_limit,
        ]);
        // 🟢 الخطوة 3: جلب الشرائح المرتبطة بـ tax_setting
        $brackets = TaxBracket::where('tax_setting_id', $taxSetting->id)->get(['id', 'bracket_name', 'value', 'percentage']);
        Log::channel('tax')->debug('TaxBrackets fetched', [
            'count' => $brackets->count(),
            'tax_setting_id' => $taxSetting->id,
        ]);
        // 🟢 الخطوة 4: التأكد من أنواع البيانات
        $taxExemptionLimit = is_numeric($taxSetting->tax_exemption_limit) ? (float) $taxSetting->tax_exemption_limit : null;
        $bracketData = $brackets->map(function ($item) {
            return [
                'id' => (int) $item->id,
                'bracket_name' => (string) $item->bracket_name,
                'value' => is_numeric($item->value) ? (float) $item->value : null,
                'percentage' => is_numeric($item->percentage) ? (float) $item->percentage : null,
            ];
        })->toArray();
        foreach ($bracketData as $bracket) {
            Log::channel('tax')->debug('Bracket detail', $bracket);
        }
        // 🟢 الخطوة 5: تجميع النتيجة النهائية
        $result = [
            'tax_setting_id' => (int) $taxSetting->id,
            'tax_exemption_limit' => $taxExemptionLimit,
            'brackets' => $bracketData,
        ];
        Log::channel('tax')->info('Tax settings data fetched successfully', $result);
        return $result;
    }

    /**
     * حساب مبلغ الإعفاء الضريبي الشهري بناءً على إعدادات الضريبة للشركة الحالية
     *
     * @return float|null
     */
    public static function getMonthlyTaxExemptionAmount(): ?float {
        try {
            // 🔹 جلب بيانات الضريبة من الدالة السابقة
            $taxData = self::getTaxSettingsData();
            // 🔹 تسجيل القيم المستخرجة
            Log::channel('tax')->debug('Extracting tax_exemption_limit from taxData', [
                'tax_exemption_limit' => $taxData['tax_exemption_limit'] ?? null,
            ]);

            // 🔹 التأكد أن القيمة رقمية وصحيحة
            if (!isset($taxData['tax_exemption_limit']) || !is_numeric($taxData['tax_exemption_limit'])) {
                Log::channel('tax')->warning('Invalid or missing tax_exemption_limit', [
                    'value' => $taxData['tax_exemption_limit'] ?? null,
                ]);
                return null;
            }

            // 🔹 حساب الإعفاء الشهري (القيمة ÷ 12)
            $monthlyExemption = round($taxData['tax_exemption_limit'] / 12, 2);
            Log::channel('tax')->info('Monthly tax exemption calculated successfully', [
                'annual_exemption' => $taxData['tax_exemption_limit'],
                'monthly_exemption' => $monthlyExemption,
            ]);

            return $monthlyExemption;
        } catch (\Throwable $e) {
            // 🟥 في حالة حدوث أي خطأ
            Log::channel('tax')->error('Error in getMonthlyTaxExemptionAmount', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    /**
     * حساب المبلغ الخاضع للضريبة بعد خصم الإعفاء الضريبي الشهري
     *
     * @param float|int|string $basicSalary
     * @return float
     */
    public static function calculateTaxableAmount(float|int|string $basicSalary): float {
        try {
            // 🟢 تحويل الراتب الأساسي إلى رقم عشري للتأكد
            if (!is_numeric($basicSalary)) {
                Log::channel('tax')->error('Invalid basic salary value', [
                    'basic_salary' => $basicSalary,
                ]);
                return 0.0;
            }
            $basicSalary = (float) $basicSalary;
            Log::channel('tax')->debug('Basic salary received', [
                'basic_salary' => $basicSalary,
            ]);
            // 🟢 جلب مبلغ الإعفاء الشهري
            $monthlyExemption = self::getMonthlyTaxExemptionAmount();
            if (is_null($monthlyExemption)) {
                Log::channel('tax')->warning('Monthly exemption not found, defaulting to 0');
                $monthlyExemption = 0.0;
            }
            // 🟢 حساب المبلغ الخاضع للضريبة
            $taxableAmount = $basicSalary - $monthlyExemption;
            // 🟢 التأكد إن القيمة لا تقل عن صفر
            if ($taxableAmount < 0) {
                $taxableAmount = 0.0;
            }

            Log::channel('tax')->info('Taxable amount calculated', [
                'basic_salary' => $basicSalary,
                'monthly_exemption' => $monthlyExemption,
                'taxable_amount' => $taxableAmount,
            ]);
            return round($taxableAmount, 2);
        } catch (\Throwable $e) {
            Log::channel('tax')->error('Error in calculateTaxableAmount', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return 0.0;
        }
    }

    /**
     * تحديد الشريحة الضريبية المناسبة بناءً على المبلغ الخاضع للضريبة
     *
     * @param float|int|string $basicSalary
     * @return array|null
     */
    public static function determineTaxBracket(float|int|string $basicSalary): ?array {
        try {
            // 🟢 الخطوة 1: حساب المبلغ الخاضع للضريبة
            $taxableData = self::calculateTaxableAmount($basicSalary);
            $taxableAmount = is_array($taxableData) ? ($taxableData['taxable_amount'] ?? 0) : $taxableData;
            Log::channel('tax')->debug('Taxable amount (monthly) calculated', [
                'basic_salary' => $basicSalary,
                'taxable_amount' => $taxableAmount,
            ]);
            // 🟢 الخطوة 2: تحويله لمبلغ سنوي
            $annualTaxable = $taxableAmount * 12;
            Log::channel('tax')->debug('Converted to annual taxable amount', [
                'annual_taxable_amount' => $annualTaxable,
            ]);
            // 🟢 الخطوة 3: جلب الشرائح الضريبية
            $taxData = self::getTaxSettingsData();
            $brackets = $taxData['brackets'] ?? [];
            if (empty($brackets)) {
                Log::channel('tax')->warning('No tax brackets found');
                return null;
            }
            // 🟢 ترتيب الشرائح تصاعديًا حسب value للتأكد
            usort($brackets, fn($a, $b) => $a['value'] <=> $b['value']);
            // 🟢 الخطوة 4: البحث عن الشريحة المناسبة
            $selectedBracket = null;
            foreach ($brackets as $bracket) {
                if ($annualTaxable <= $bracket['value']) {
                    $selectedBracket = $bracket;
                    break;
                }
            }
            // 🟢 في حالة أن المبلغ أكبر من كل الشرائح ناخد آخر شريحة
            if (!$selectedBracket) {
                $selectedBracket = end($brackets);
            }
            // 🟢 الخطوة 5: حساب قيمة الشريحة الشهرية
            $monthlyBracketValue = round($selectedBracket['value'] / 12, 2);
            // 🟢 تسجيل النتيجة
            Log::channel('tax')->info('Determined tax bracket', [
                'basic_salary' => $basicSalary,
                'taxable_monthly' => $taxableAmount,
                'taxable_annual' => $annualTaxable,
                'selected_bracket' => $selectedBracket,
                'monthly_bracket_value' => $monthlyBracketValue,
            ]);

            // 🟢 الخطوة 6: إرجاع النتيجة
            return [
                'bracket_id' => $selectedBracket['id'],
                'bracket_name' => $selectedBracket['bracket_name'],
                'value' => $selectedBracket['value'],
                'percentage' => $selectedBracket['percentage'],
                'monthly_bracket_value' => $monthlyBracketValue,
            ];
        } catch (\Throwable $e) {
            Log::channel('tax')->error('Error in determineTaxBracket', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    /**
     * حساب إجمالي الضريبة الشهرية بناءً على الشريحة الضريبية
     *
     * @param float|int|string $taxableMonthly  المبلغ الخاضع للضريبة شهريًا
     * @param float|int|string $monthlyBracketValue  قيمة الشريحة الشهرية
     * @param float|int|string $percentage  نسبة الشريحة (٪)
     * @return float
     */
    public static function calculateMonthlyTaxAmount(float|int|string $taxableMonthly, float|int|string $monthlyBracketValue, float|int|string $percentage): float {
        try {
            // 🟢 التأكد من أن كل القيم رقمية
            if (!is_numeric($taxableMonthly) || !is_numeric($monthlyBracketValue) || !is_numeric($percentage)) {
                Log::channel('tax')->error('Invalid input types in calculateMonthlyTaxAmount', [
                    'taxable_monthly' => $taxableMonthly,
                    'monthly_bracket_value' => $monthlyBracketValue,
                    'percentage' => $percentage,
                ]);
                return 0.0;
            }
            $taxableMonthly = (float) $taxableMonthly;
            $monthlyBracketValue = (float) $monthlyBracketValue;
            $percentage = (float) $percentage;
            Log::channel('tax')->debug('Starting tax calculation', [
                'taxable_monthly' => $taxableMonthly,
                'monthly_bracket_value' => $monthlyBracketValue,
                'percentage' => $percentage,
            ]);
            // 🟢 تحويل النسبة المئوية إلى رقم عشري
            $decimalRate = $percentage / 100;
            // 🟢 حساب إجمالي الضريبة
            $monthlyTax = round($taxableMonthly * $decimalRate, 2);
            Log::channel('tax')->info('Monthly tax calculated successfully', [
                'taxable_monthly' => $taxableMonthly,
                'percentage' => $percentage,
                'decimal_rate' => $decimalRate,
                'monthly_tax' => $monthlyTax,
            ]);

            return $monthlyTax;
        } catch (\Throwable $e) {
            Log::channel('tax')->error('Error in calculateMonthlyTaxAmount', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return 0.0;
        }
    }

    /**
     * حساب الضريبة التصاعدية شريحة بشريحة
     *
     * @param float|int|string $basicSalary  الراتب الأساسي الشهري
     * @return array|null
     *  [
     *    'annual_salary' => float,
     *    'annual_exemption' => float,
     *    'annual_taxable' => float,
     *    'annual_tax' => float,
     *    'monthly_tax' => float,
     *    'breakdown' => [
     *       [
     *         'bracket_id' => int,
     *         'bracket_name' => string,
     *         'bracket_capacity' => float, // قيمة الـ value في جدول الشرائح
     *         'used_amount' => float,      // المبلغ المستخدم من داخل الشريحة
     *         'rate' => float,             // نسبة الشريحة (٪)
     *         'tax' => float,              // ضريبة هذا الجزء
     *       ], ...
     *    ]
     *  ]
     */
    public static function calculateProgressiveTax(float|int|string $basicSalary): ?array {
        try {
            if (!is_numeric($basicSalary)) {
                Log::channel('tax')->error('Invalid basic salary in calculateProgressiveTax', ['basic_salary' => $basicSalary]);
                return null;
            }

            $basicSalary = (float) $basicSalary;
            Log::channel('tax')->debug('Starting calculateProgressiveTax', ['basic_salary' => $basicSalary]);

            // annual salary & exemption
            $annualSalary = round($basicSalary * 12, 2);
            $taxData = self::getTaxSettingsData();

            $annualExemption = isset($taxData['tax_exemption_limit']) && is_numeric($taxData['tax_exemption_limit'])
                ? (float) $taxData['tax_exemption_limit']
                : 0.0;

            $annualTaxable = $annualSalary - $annualExemption;
            if ($annualTaxable <= 0) {
                Log::channel('tax')->info('No taxable amount after exemption', [
                    'annual_salary' => $annualSalary,
                    'annual_exemption' => $annualExemption,
                ]);
                return [
                    'annual_salary' => $annualSalary,
                    'annual_exemption' => $annualExemption,
                    'annual_taxable' => 0.0,
                    'annual_tax' => 0.0,
                    'monthly_tax' => 0.0,
                    'breakdown' => [],
                ];
            }

            $brackets = $taxData['brackets'] ?? [];
            if (empty($brackets)) {
                Log::channel('tax')->warning('No tax brackets in calculateProgressiveTax');
                return null;
            }

            // نضمن ترتيب الشرائح كما هي (يمكن ترتيب حسب إدخالك أو حسب القيمة)
            // هنا نرتب حسب الترتيب الطبيعي للقيم (asc) لضمان السلاسة
            usort($brackets, fn($a, $b) => $a['value'] <=> $b['value']);

            $remaining = $annualTaxable;
            $annualTax = 0.0;
            $breakdown = [];
            $cumulative = 0.0; // تراكم حدود الشرائح السابقة

            foreach ($brackets as $br) {
                $cap = is_numeric($br['value']) ? (float) $br['value'] : 0.0; // سعة الشريحة
                $rate = is_numeric($br['percentage']) ? (float) $br['percentage'] : 0.0;

                // الجزء المتاح داخل هذه الشريحة (لو السعة = cap)
                // نحسب الجزء الذي يقع داخل الشريحة = min(max(annualTaxable - cumulative, 0), cap)
                $availableForThisBracket = max($annualTaxable - $cumulative, 0);
                $used = min($availableForThisBracket, $cap);

                if ($used <= 0) {
                    // لم يبق جزء لهذه الشريحة
                    $breakdown[] = [
                        'bracket_id' => $br['id'] ?? null,
                        'bracket_name' => $br['bracket_name'] ?? null,
                        'bracket_capacity' => $cap,
                        'used_amount' => 0.0,
                        'rate' => $rate,
                        'tax' => 0.0,
                    ];
                    // نحدث التراكم ونكمل
                    $cumulative += $cap;
                    continue;
                }

                $taxForPart = round($used * ($rate / 100), 2);
                $annualTax += $taxForPart;

                $breakdown[] = [
                    'bracket_id' => $br['id'] ?? null,
                    'bracket_name' => $br['bracket_name'] ?? null,
                    'bracket_capacity' => $cap,
                    'used_amount' => round($used, 2),
                    'rate' => $rate,
                    'tax' => $taxForPart,
                ];

                Log::channel('tax')->debug('Bracket applied', [
                    'bracket' => $br,
                    'cumulative_before' => $cumulative,
                    'used_in_bracket' => $used,
                    'tax_for_part' => $taxForPart,
                    'remaining_to_tax' => max($annualTaxable - ($cumulative + $used), 0),
                ]);

                // حدث التراكم
                $cumulative += $cap;

                // لو ما بقىش شيء
                if ($cumulative >= $annualTaxable) {
                    break;
                }
            }

            $monthlyTax = round($annualTax / 12, 2);

            $result = [
                'annual_salary' => $annualSalary,
                'annual_exemption' => $annualExemption,
                'annual_taxable' => round($annualTaxable, 2),
                'annual_tax' => round($annualTax, 2),
                'monthly_tax' => $monthlyTax,
                'breakdown' => $breakdown,
            ];

            Log::channel('tax')->info('Progressive tax calculated', $result);

            return $result;
        } catch (\Throwable $e) {
            Log::channel('tax')->error('Error in calculateProgressiveTax', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }
}