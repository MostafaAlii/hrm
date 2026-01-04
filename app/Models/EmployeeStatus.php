<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    use HasFactory;
    protected $table = 'employee_statuses';
    protected $fillable = [
        'employee_type',
        'employee_id',
        'changeable_type',
        'changeable_id',
        'type',
        'from_id',
        'to_id',
        'name_from',
        'name_to',
        'effective_date',
        'reason',
        'notes',
        'applied',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'applied' => 'boolean',
    ];

    public function employee()
    {
        return $this->morphTo();
    }

    public function changeable()
    {
        return $this->morphTo();
    }
}