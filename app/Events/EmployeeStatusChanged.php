<?php

namespace App\Events;

use App\Models\EmployeeStatus;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeStatusChanged
{
    use Dispatchable, SerializesModels;

    public EmployeeStatus $status;

    public function __construct(EmployeeStatus $status)
    {
        $this->status = $status;
    }
}