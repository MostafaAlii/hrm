<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_panel_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('system_status')->default(\App\Enums\MainSetting\MainSettingSystemStatus::SYSTEM_STATUS_ACTIVE);
            $table->string('company_name')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('after_minutes_calculate_delay')->default(false)->comment('بعد كام دقيقه يتم احتساب تاخير الحضور');
            $table->unsignedInteger('after_minutes_calculate_early_departure')->default(false)->comment('بعد كام دقيقه يتم احتساب انصراف مبكر');
            $table->unsignedInteger('after_minutes_calculate_quarter_day')->default(false)->comment('بعد كام دقيقه مجموع الانصراف المبكر او الحضور المتاخر يخصم ربع يوم ');
            $table->unsignedInteger('after_time_half_daycut')->default(false)->comment('بعد كام مره انصراف مبكر او حضور متاخر يتم خصم نصف يوم');
            $table->unsignedInteger('after_time_full_daycut')->default(false)->comment('بعد كام مره انصراف مبكر او حضور متاخر يتم خصم يوم كامل');
            $table->decimal('mounthly_vacation_balance', 8, 2)->default(0.00)->comment('رصيد الاجازات الشهريه');
            $table->unsignedInteger('after_days_begin_vacation')->default(false)->comment('بعد كام يوم يحتسب رصيد الاجازات');
            $table->decimal('first_balance_begin_vacation', 8, 2)->default(0.00)->comment('الرصيد الاولى من الاجازات عند تفعيل الاجازات');
            $table->decimal('sanction_value_first_absence', 8, 2)->default(0.00)->comment('قيمه خصم الايام بعد اول غياب بدون اذن');
            $table->decimal('sanction_value_second_absence', 8, 2)->default(0.00)->comment('قيمه خصم الايام بعد الثاني غياب بدون اذن');
            $table->decimal('sanction_value_third_absence')->default(0.00)->comment('قيمه خصم الايام بعد الثالث ��ياب بدون ا��ن');
            $table->decimal('sanction_value_fourth_absence', 8, 2)->default(0.00)->comment('قيمه خصم الايام بعد الرابع غياب بدون اذن');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_panel_settings');
    }
};
