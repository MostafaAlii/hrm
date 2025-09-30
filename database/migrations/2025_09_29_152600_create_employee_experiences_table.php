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
        Schema::create('employee_experiences', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('experience');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('previous_work_phone')->nullable();
            $table->text('previous_work_address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('employee_experiences');
    }
};
