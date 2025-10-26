<?php

namespace Database\Seeders;

use App\Models\EntitlementTypeRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntitlementTypeRelationsSeeder extends Seeder
{
    public function run()
    {
        $relations = [
            [
                'code' => '55',
                'name_ar' => 'متغير',
                'name_en' => 'Variable',
            ],
            [
                'code' => '111',
                'name_ar' => 'بدل وجبات',
                'name_en' => 'Meal Allowance',
            ],
            [
                'code' => '112',
                'name_ar' => 'بدل سفر',
                'name_en' => 'Travel Allowance',
            ],
            [
                'code' => '113',
                'name_ar' => 'بدل حراسه',
                'name_en' => 'Security Allowance',
            ],
            [
                'code' => '114',
                'name_ar' => 'مرتب كاجوال',
                'name_en' => 'Casual Salary',
            ],
            [
                'code' => '200',
                'name_ar' => 'المرتب',
                'name_en' => 'Salary',
            ],
            [
                'code' => '256',
                'name_ar' => 'حافز متغير ثابت',
                'name_en' => 'Fixed Variable Incentive',
            ],
            [
                'code' => '300',
                'name_ar' => 'مكافئه',
                'name_en' => 'Bonus',
            ],
            [
                'code' => '503',
                'name_ar' => 'بدلات اخرى',
                'name_en' => 'Other Allowances',
            ],
            [
                'code' => '505',
                'name_ar' => 'بدل راحه',
                'name_en' => 'Rest Allowance',
            ],
            [
                'code' => '506',
                'name_ar' => 'انتقالات',
                'name_en' => 'Transportation',
            ],
            [
                'code' => '507',
                'name_ar' => 'بدلات اخرى**',
                'name_en' => 'Other Allowances**',
            ],
            [
                'code' => '508',
                'name_ar' => 'بدل سكن',
                'name_en' => 'Housing Allowance',
            ],
            [
                'code' => '601',
                'name_ar' => 'بدل نقدى للاجازه',
                'name_en' => 'Cash Vacation Allowance',
            ],
            [
                'code' => '602',
                'name_ar' => 'حافز متغير',
                'name_en' => 'Variable Incentive',
            ],
            [
                'code' => '603',
                'name_ar' => 'بدل انتقالات',
                'name_en' => 'Transfer Allowance',
            ],
            [
                'code' => '5000',
                'name_ar' => 'معالجه الضرائب',
                'name_en' => 'Tax Processing',
            ],
            [
                'code' => '6000',
                'name_ar' => 'معالجه التامينات',
                'name_en' => 'Insurance Processing',
            ],
            [
                'code' => '9000',
                'name_ar' => 'الراتب المؤجل',
                'name_en' => 'Deferred Salary',
            ],
            [
                'code' => '10000',
                'name_ar' => 'بدل نقدى لالاجازات',
                'name_en' => 'Cash Allowance for Vacations',
            ],
            [
                'code' => '555555',
                'name_ar' => 'ساعات العمل الاضافى',
                'name_en' => 'Overtime Hours',
            ],
        ];

        foreach ($relations as $relation) {
            // التحقق من عدم وجود التكرار
            $exists = EntitlementTypeRelation::where('code', $relation['code'])->exists();

            if (!$exists) {
                EntitlementTypeRelation::create([
                    'uuid' => Str::uuid(),
                    'code' => $relation['code'],
                    'name_ar' => $relation['name_ar'],
                    'name_en' => $relation['name_en'],
                    'is_active' => true,
                    'company_id' => null,
                    'added_by_id' => 1,
                    'updated_by_id' => 1,
                ]);
            }
        }

        $this->command->info('تم إنشاء ' . count($relations) . ' نوع من علاقات أنواع الاستحقاقات بنجاح.');
    }
}
