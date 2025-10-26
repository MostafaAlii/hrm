<?php

namespace Database\Seeders;

use App\Models\AllowanceCategory;
use Illuminate\Database\Seeder;

class AllowanceCategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'code' => 'FIXED_BASIC_PERCENTAGE',
                'name_ar' => 'نسبة ثابته من الاساسى',
                'name_en' => 'Fixed Percentage from Basic',
                'is_active' => true,
            ],
            [
                'code' => 'VARIABLE_BASIC_PERCENTAGE',
                'name_ar' => 'نسبة متغيره من الاساسى',
                'name_en' => 'Variable Percentage from Basic',
                'is_active' => true,
            ],
            [
                'code' => 'FIXED_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبة ثابته من الاجمالى',
                'name_en' => 'Fixed Percentage from Total',
                'is_active' => true,
            ],
            [
                'code' => 'VARIABLE_TOTAL_PERCENTAGE',
                'name_ar' => 'نسبة متغيره من الاجمالى',
                'name_en' => 'Variable Percentage from Total',
                'is_active' => true,
            ],
            [
                'code' => 'FIXED_AMOUNT',
                'name_ar' => 'قيمه ثابته',
                'name_en' => 'Fixed Amount',
                'is_active' => true,
            ],
            [
                'code' => 'VARIABLE_AMOUNT',
                'name_ar' => 'قيمه متغيره',
                'name_en' => 'Variable Amount',
                'is_active' => true,
            ],
            [
                'code' => 'FIXED_INSURED_BASIC_PERCENTAGE',
                'name_ar' => 'نسبة ثابته من المبلغ المؤمن عليه من الاساسى',
                'name_en' => 'Fixed Percentage from Insured Basic Amount',
                'is_active' => true,
            ],
            [
                'code' => 'VARIABLE_INSURED_BASIC_PERCENTAGE',
                'name_ar' => 'نسبة متغيره من المبلغ المؤمن عليه من الاساسى',
                'name_en' => 'Variable Percentage from Insured Basic Amount',
                'is_active' => true,
            ],
            [
                'code' => 'FIXED_INSURED_PERCENTAGE',
                'name_ar' => 'نسبة ثابته من المبلغ المؤمن عليه',
                'name_en' => 'Fixed Percentage from Insured Amount',
                'is_active' => true,
            ],
            [
                'code' => 'VARIABLE_INSURED_PERCENTAGE',
                'name_ar' => 'نسبة متغيره من المبلغ المؤمن عليه',
                'name_en' => 'Variable Percentage from Insured Amount',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            AllowanceCategory::create([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'code' => $category['code'],
                'name_ar' => $category['name_ar'],
                'name_en' => $category['name_en'],
                'is_active' => $category['is_active'],
                'company_id' => 1,
                'added_by_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->command->info('تم إنشاء ' . count($categories) . ' نوع من أنواع العلاوات بنجاح.');
    }
}
