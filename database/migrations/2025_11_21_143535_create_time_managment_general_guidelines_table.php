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
        Schema::create('time_managment_general_guidelines', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->enum('starts_week', [
                'saturday',
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday'
            ])->comment('بداية الأسبوع - تبع قسم البدايات');
            $table->unsignedTinyInteger('starts_month')->comment('بداية الشهر (رقم) - تبع قسم البدايات');
            $table->unsignedTinyInteger('starts_working_days')->comment('عدد أيام العمل - تبع قسم البدايات');
            $table->unsignedSmallInteger('starts_year')->comment('بداية العام - تبع قسم البدايات');
            $table->boolean('extended_shift_day1')->default(false)->comment('الورديات الممتدة - تظهر في اليوم الأول');
            $table->boolean('extended_shift_day2')->default(false)->comment('الورديات الممتدة - تظهر في اليوم الثاني');
            $table->boolean('overtime_ignore')->default(false)->comment('معالجة الوقت الإضافي - تجاهلها');
            $table->boolean('overtime_overtime')->default(false)->comment('معالجة الوقت الإضافي - وقت إضافي');
            $table->boolean('overtime_review')->default(false)->comment('معالجة الوقت الإضافي - المراجعة');
            $table->boolean('exit_ignore')->default(false)->comment('معالجة الخروج - تجاهلها');
            $table->boolean('exit_mission')->default(false)->comment('معالجة الخروج - خروج مأمورية');
            $table->boolean('exit_departure')->default(false)->comment('معالجة الخروج - انصراف');
            $table->boolean('exit_review')->default(false)->comment('معالجة الخروج - مراجعة');
            $table->unsignedInteger('shift_max_duration_minutes')->comment('أطول فترة للوردية الواحدة بالدقيقة');
            $table->unsignedInteger('shift_min_duration_minutes')->comment('أقصر فترة للوردية الواحدة بالدقيقة');
            $table->unsignedInteger('shift_min_break_minutes')->comment('أقصر استراحة بين الورديات بالدقيقة');
            $table->string('attendance_symbol')->nullable()->comment('رمز الحضور في التقرير');
            $table->string('attendance_color')->nullable()->comment('لون الحضور في التقارير');
            $table->string('attendance_holiday_color')->nullable()->comment('لون العطلة في التقارير');
            $table->string('attendance_weekly_color')->nullable()->comment('لون الأسبوعية في التقارير');
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_managment_general_guidelines');
    }
};
