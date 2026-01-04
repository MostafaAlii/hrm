<?php

namespace App\Jobs;

use App\Models\EmployeeStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class ApplyEmployeeStatusJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public EmployeeStatus $status;
    /**
     * Create a new job instance.
     */
    public function __construct(EmployeeStatus $status) {
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $status = $this->status;
        if (!$status->effective_date || $status->effective_date->gt(now()->startOfDay())) {
            return;
        }

        $employee = $status->employee;
        if (!$employee) return;
        $tab = collect(\App\Core\EmployeeStatus\EmployeeStatusTabManager::all())->first(fn($t) => $t->key() === $status->type);
        if (!$tab) return;
        $field = $tab->employeeField();
        $employee->{$field} = $status->to_id;
        $employee->save();
        $status->applied = true;
        $status->save();
    }
}