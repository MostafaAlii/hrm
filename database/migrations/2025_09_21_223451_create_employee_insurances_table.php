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
        Schema::create('employee_insurances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('insurance_type_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('insurance_region_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('insurance_office_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('insurance_number')->nullable();   // الرقم التأميني
            $table->date('insurance_date')->nullable();       // تاريخ التأمين
            $table->boolean('is_health_insured')->default(false); // تحقق التأمين الصحي
            $table->integer('dependents_count')->default(0);       // عدد المعالين
            $table->integer('non_dependents_count')->default(0);   // عدد الوحدات غير عمالة
            $table->decimal('company_share', 8, 2)->default(0); // حصة الشركة
            $table->decimal('employee_share', 8, 2)->default(0); // حصة العامل
            $table->decimal('insurance_amount', 8, 2)->default(0); // المبلغ التأميني
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
        Schema::dropIfExists('employee_insurances');
    }
};