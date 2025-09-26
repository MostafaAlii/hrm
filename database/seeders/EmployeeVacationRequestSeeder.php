<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeVacationRequest;
use Illuminate\Support\Str;

class EmployeeVacationRequestSeeder extends Seeder {
    public function run(): void
    {
        $statuses = ['pending', 'approved', 'rejected'];
        $requestTypes = ['vacation', 'permission'];
        $durationUnits = ['days', 'hours', 'minutes'];

        foreach (range(2, 12) as $vacationId) {
            $requestType = $requestTypes[array_rand($requestTypes)];

            // تحديد قيمة المدة حسب النوع
            if ($requestType === 'vacation') {
                $durationValue = rand(1, 15);   // أيام
                $durationUnit  = 'days';
                $startDate = now()->addDays(rand(1, 30));
                $endDate   = $startDate->copy()->addDays($durationValue);
            } else {
                $durationValue = rand(1, 8);    // ساعات
                $durationUnit  = rand(0, 1) ? 'hours' : 'minutes';
                $startDate = now()->addDays(rand(1, 30));
                $endDate   = $startDate; // نفس اليوم للتصريح
            }

            EmployeeVacationRequest::create([
                'company_id'     => 1,
                'added_by_id'    => 1,
                'updated_by_id'  => null,
                'employee_id'    => 7,
                'vacation_id'    => $vacationId,
                'request_type'   => $requestType,
                'start_date'     => $startDate,
                'end_date'       => $endDate,
                'duration_value' => $durationValue,
                'duration_unit'  => $durationUnit,
                'description'    => 'طلب ' . ($requestType === 'vacation' ? 'إجازة' : 'تصريح') . ' تجريبي لنوع ' . $vacationId,
                'notes'          => 'ملاحظات خاصة بطلب ' . $vacationId,
                'status'         => $statuses[array_rand($statuses)],
                'approved_by_id' => rand(0, 1) ? 1 : null,
            ]);
        }
    }
}
