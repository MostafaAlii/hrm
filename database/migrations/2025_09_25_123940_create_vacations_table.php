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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('name_ar');
            $table->string('code');
            $table->string('name_en')->nullable();
            $table->boolean('deduct_from_balance')->default(false); // يخصم من الرصيد
            $table->integer('balance')->default(0); // الرصيد
            $table->string('color')->nullable(); // اللون (اختيار من color palette)
            $table->integer('ten_years_balance')->default(0); // رصيد عشر سنوات تأمين
            $table->integer('fifty_years_balance')->default(0); // رصيد خمسين سنة
            // checkboxes
            $table->boolean('can_be_carried_forward')->default(false); // يمكن ترحيله
            $table->boolean('affects_ten_years')->default(false); // عشر سنوات تأمين
            $table->boolean('affects_fifty_years')->default(false); // خمسين سنة
            $table->boolean('affects_annual_leave')->default(false); // يؤثر على الإجازة السنوية
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
