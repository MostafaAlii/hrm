<?php

namespace App\Repositories\Eloquents;

use App\Http\Requests\Dashboard\MainSettingRequest;
use App\Models\{AdminPanelSetting};
use App\Repositories\Contracts\MainSettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session, Cache};
use App\Models\Concerns\UploadMedia;

class MainSettingRepository implements MainSettingRepositoryInterface
{
    use UploadMedia;
    public function index()
    {
        $company_code = get_user_data()?->company_id;
        $setting = AdminPanelSetting::with(['media'])->where('company_id', $company_code)->orderBy('created_at', 'DESC')->first();
        $logo = $setting?->getMediaUrl('setting', $setting, null, 'media', 'logo') ?? asset('dashboard/assets/images/default/default.png');
        $favicon = $setting?->getMediaUrl('setting', $setting, null, 'media', 'favicon') ?? asset('dashboard/assets/images/default/default.png');
        return view('dashboard.admin.settings.index', [
            'title' => trans('dashboard/sidebar.admin_main_settings_sidebar_title'),
            'setting' => $setting,
            'logo' => $logo,
            'favicon' => $favicon,
        ]);
    }

    public function save(MainSettingRequest $request) {
        try {
            $setting = AdminPanelSetting::firstOrNew([]);
            $data = $request->only([
                'system_status',
                'company_name',
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
            ]);
            $data['system_status'] = $request->input('system_status') === \App\Enums\MainSetting\MainSettingSystemStatus::SYSTEM_STATUS_ACTIVE->value
                ? \App\Enums\MainSetting\MainSettingSystemStatus::SYSTEM_STATUS_ACTIVE->value
                : \App\Enums\MainSetting\MainSettingSystemStatus::SYSTEM_STATUS_IN_ACTIVE->value;

            $setting->fill($data);
            $setting->save();
            if ($request->hasFile('logo'))
                $setting->updateSingleMedia('setting', $request->file('logo'), $setting, null, 'media', true, false, 'logo');
            if ($request->hasFile('favicon'))
                $setting->updateSingleMedia('setting', $request->file('favicon'), $setting, null, 'media', true, false, 'favicon');
            return redirect()->back()->with('success', 'تم تحديث الإعدادات بنجاح.');
            Cache::forget('settings');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }
}
