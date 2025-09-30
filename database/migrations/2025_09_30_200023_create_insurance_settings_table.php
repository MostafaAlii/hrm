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
        Schema::create('insurance_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->decimal('max_insurance_amount', 15, 2)->default(0);
            $table->decimal('min_insurance_amount', 15, 2)->default(0);
            $table->decimal('employee_deduction_percentage', 5, 2)->default(0);
            $table->decimal('company_deduction_percentage', 5, 2)->default(0);
            $table->decimal('employees_fund_percentage', 5, 2)->default(0);
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
        Schema::dropIfExists('insurance_settings');
    }
};
