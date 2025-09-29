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
        Schema::create('employee_qualifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('qualification_id')->nullable()->constrained('qualifications')->nullOnDelete();
            $table->foreignId('educational_degree_id')->nullable()->constrained('educational_degrees')->nullOnDelete();
            $table->foreignId('university_id')->nullable()->constrained('universities')->nullOnDelete();
            $table->foreignId('specialization_id')->nullable()->constrained('specializations')->nullOnDelete();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->nullOnDelete();
            $table->integer('study_years')->nullable();
            $table->year('graduation_year')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employee_qualifications');
    }
};