<?php

namespace App\Console\Commands;

use App\Jobs\ApplyEmployeeStatusJob;
use App\Models\EmployeeStatus;
use Illuminate\Console\Command;

class ApplyEmployeeStatusCommand extends Command
{
    protected $signature = 'employees:apply-status';
    protected $description = 'Apply EmployeeStatus for today if effective_date reached';

    public function handle(): int
    {
        $today = now()->startOfDay();

        // جلب كل EmployeeStatus اللي تاريخها اليوم أو أقل ولم يتم تطبيقها
        $statuses = EmployeeStatus::whereDate('effective_date', '<=', $today)
            ->where('applied', false) // نضيف عمود applied في جدول EmployeeStatus
            ->get();

        foreach ($statuses as $status) {
            ApplyEmployeeStatusJob::dispatch($status);
        }

        $this->info('Dispatched ' . $statuses->count() . ' EmployeeStatus jobs.');
        return 0;
    }
}