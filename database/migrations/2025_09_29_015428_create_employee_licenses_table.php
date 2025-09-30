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
        Schema::create('employee_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('issuing_authority');
            $table->string('license_number');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->text('notes')->nullable();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('license_variable_id')->constrained()->restrictOnDelete();
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
        Schema::dropIfExists('employee_licenses');
    }
};
