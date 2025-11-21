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
        Schema::create('employee_leave_allocations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('leave_variable_id')->nullable()->constrained('leave_variables')->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->decimal('allocated_balance', 8, 2)->default(0); // الرصيد المخصص
            $table->decimal('previous_years_balance', 8, 2)->default(0); // رصيد السنوات السابقة
            $table->boolean('is_year')->default(false); // العام checkbox
            $table->boolean('is_break_year')->default(false); // كسر العام checkbox
            $table->year('year')->nullable(); // year العام
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_allocations');
    }
};
