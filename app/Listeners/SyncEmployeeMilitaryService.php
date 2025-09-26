<?php

namespace App\Listeners;

use App\Events\EmployeeSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\MilitaryService;
use App\Enums\Employee\MilitaryStatus;
class SyncEmployeeMilitaryService {
    public function __construct() {}

    public function handle(EmployeeSaved $event): void
    {
        $employee = $event->employee;
        MilitaryService::firstOrCreate(
            ['employee_id' => $employee->id],
            [
                'status' => MilitaryStatus::UNDEFINED->value,
            ]
        );
    }
}
