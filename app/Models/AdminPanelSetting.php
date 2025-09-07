<?php
namespace App\Models;
use App\Enums\MainSetting\{MainSettingSystemStatus};
use App\Models\Concerns\UploadMedia;
class AdminPanelSetting extends BaseModel {
    use UploadMedia;
    protected $table = 'admin_panel_settings';
    protected $fillable = [
        'uuid',
        'system_status',
        'company_name',
        'company_id',
        'phone',
        'address',
        'email',
        'added_by_id',
        'updated_by_id',
        'company_id',
        'after_minutes_calculate_delay',
        'after_minutes_calculate_early_departure',
        'after_minutes_calculate_quarter_day',
        'after_time_half_daycut',
        'after_time_full_daycut',
        'mounthly_vacation_balance',
        'after_days_begin_vacation',
        'first_balance_begin_vacation',
        'sanction_value_first_absence',
        'sanction_value_second_absence',
        'sanction_value_third_absence',
        'sanction_value_fourth_absence',
    ];

    protected $casts = [
        'system_status' => MainSettingSystemStatus::class,
        'mounthly_vacation_balance' => 'float',
        'first_balance_begin_vacation' => 'float',
        'sanction_value_first_absence' => 'decimal:2',
        'sanction_value_second_absence' => 'decimal:2',
        'sanction_value_third_absence' => 'decimal:2',
        'sanction_value_fourth_absence' => 'decimal:2',
    ];

    public function getMounthlyVacationBalanceAttribute($value) {
        return (int) $value;
    }
    public function getFirstBalanceBeginVacationAttribute($value)
    {
        return (int) $value;
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}