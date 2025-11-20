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
        Schema::create('leave_variables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique()->comment('الكود التعريفي للمتغير');
            $table->string('symbol')->nullable()->comment('رمز المتغير');
            $table->string('name_ar')->comment('الوصف باللغة العربية');
            $table->string('name_en')->nullable()->comment('الوصف باللغة الإنجليزية');
            $table->string('color')->nullable()->comment('اللون المخصص للمتغير');
            $table->boolean('deduct_from_balance')->default(false)->comment('يخصم من الرصيد');
            $table->boolean('can_transfer')->default(false)->comment('يمكن ترحيله');
            $table->boolean('ten_years_insurance')->default(false)->comment('خاص بعشر سنوات تأمين');
            $table->boolean('fifty_years')->default(false)->comment('خمسين سنة');
            $table->boolean('affect_annual_leave')->default(false)->comment('يؤثر على الإجازة السنوية');
            $table->decimal('deducted_value', 10, 2)->default(0)->comment('القيمة المخصومة من الرصيد تابع حقل يخصم من الرصيد');
            $table->decimal('balance', 10, 2)->default(0)->comment('الرصيد الأساسي');
            $table->decimal('ten_years_balance', 10, 2)->default(0)->comment('رصيد عشر سنوات تأمين');
            $table->decimal('fifty_years_balance', 10, 2)->default(0)->comment('رصيد خمسين سنة');
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
        Schema::dropIfExists('leave_variables');
    }
};
