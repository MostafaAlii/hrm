<?php
namespace App\Models;
use App\Models\Concerns\UploadMedia;
use App\Enums\Employee\MilitaryStatus;
class MilitaryService extends BaseModel {
    use UploadMedia;
    protected $table = 'military_services';
    protected $fillable = [
        'employee_id',
        'status',
        'military_card_number',
        'issue_date',
        'expiry_date',
        'batch_number',
        'additional_info',
    ];

    protected $casts = [
        'status' => MilitaryStatus::class,
        'issue_date' => 'date:Y-m-d',
        'expiry_date' => 'date:Y-m-d',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function media() {
        return $this->morphMany(Media::class, 'mediable');
    }
}