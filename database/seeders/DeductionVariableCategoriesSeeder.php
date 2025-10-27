<?php

namespace Database\Seeders;

use App\Models\DeductionVariableCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeductionVariableCategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'code' => 'FIXED_AMOUNT',
                'name_ar' => 'قيمه ثابته',
                'name_en' => 'Fixed Amount',
            ],
            [
                'code' => 'VARIABLE_AMOUNT',
                'name_ar' => 'قيمه متغيره',
                'name_en' => 'Variable Amount',
            ],
            [
                'code' => 'FIXED_BASIC_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من الاساسى',
                'name_en' => 'Fixed Percentage from Basic',
            ],
            [
                'code' => 'VARIABLE_BASIC_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من الاساسى',
                'name_en' => 'Variable Percentage from Basic',
            ],
            [
                'code' => 'FIXED_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من الشامل',
                'name_en' => 'Fixed Percentage from Total',
            ],
            [
                'code' => 'VARIABLE_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من الشامل',
                'name_en' => 'Variable Percentage from Total',
            ],
            [
                'code' => 'FIXED_ENTITLEMENT_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من استحقاق',
                'name_en' => 'Fixed Percentage from Entitlement',
            ],
            [
                'code' => 'VARIABLE_ENTITLEMENT_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من استحقاق',
                'name_en' => 'Variable Percentage from Entitlement',
            ],
            [
                'code' => 'FIXED_BASIC_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من الشامل الاساسى',
                'name_en' => 'Fixed Percentage from Basic Total',
            ],
            [
                'code' => 'VARIABLE_BASIC_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من الشامل الاساسى',
                'name_en' => 'Variable Percentage from Basic Total',
            ],
            [
                'code' => 'FIXED_DAY_BASIC',
                'name_ar' => 'يوم ثابت على الاساسى',
                'name_en' => 'Fixed Day on Basic',
            ],
            [
                'code' => 'VARIABLE_DAY_BASIC',
                'name_ar' => 'يوم متغير على الاساسى',
                'name_en' => 'Variable Day on Basic',
            ],
            [
                'code' => 'FIXED_DAY_TOTAL',
                'name_ar' => 'يوم ثابت على الشامل',
                'name_en' => 'Fixed Day on Total',
            ],
            [
                'code' => 'VARIABLE_DAY_TOTAL',
                'name_ar' => 'يوم متغير على الشامل',
                'name_en' => 'Variable Day on Total',
            ],
            [
                'code' => 'FIXED_TOTAL_INCOME_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من اجمالى الدخل',
                'name_en' => 'Fixed Percentage from Total Income',
            ],
            [
                'code' => 'VARIABLE_TOTAL_INCOME_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من اجمالى الدخل',
                'name_en' => 'Variable Percentage from Total Income',
            ],
            [
                'code' => 'FIXED_DAY_BASIC_TOTAL',
                'name_ar' => 'يوم ثابت من الشامل الاساسى',
                'name_en' => 'Fixed Day from Basic Total',
            ],
            [
                'code' => 'VARIABLE_DAY_BASIC_TOTAL',
                'name_ar' => 'يوم متغير من الشامل الاساسى',
                'name_en' => 'Variable Day from Basic Total',
            ],
            [
                'code' => 'FIXED_BASIC_TOTAL_TAX_PERCENTAGE',
                'name_ar' => 'نسبه ثابته من الشامل الاساسى ض ت',
                'name_en' => 'Fixed Percentage from Basic Total Tax',
            ],
            [
                'code' => 'VARIABLE_BASIC_TOTAL_TAX_PERCENTAGE',
                'name_ar' => 'نسبه متغيره من الشامل الاساسى ض ت',
                'name_en' => 'Variable Percentage from Basic Total Tax',
            ],
        ];

        foreach ($categories as $category) {
            // التحقق من عدم وجود التكرار
            $exists = DeductionVariableCategory::where('code', $category['code'])->exists();

            if (!$exists) {
                DeductionVariableCategory::create([
                    'uuid' => Str::uuid(),
                    'code' => $category['code'],
                    'name_ar' => $category['name_ar'],
                    'name_en' => $category['name_en'],
                    'is_active' => true,
                    'company_id' => 1,
                    'added_by_id' => 3,
                    'updated_by_id' => 1,
                ]);
            }
        }

        $this->command->info('تم إنشاء ' . count($categories) . ' نوع من أنواع متغيرات الاستقطاعات بنجاح.');
    }
}
