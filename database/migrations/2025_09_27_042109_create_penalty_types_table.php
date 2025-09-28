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
        Schema::create('penalty_types', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('type')->nullable();
            $table->boolean('affects_salary')->default(false);
            $table->string('calculation_type')->nullable();
            $table->decimal('first_time', 10, 2)->default(0);
            $table->string('first_time_description')->nullable();
            $table->decimal('second_time', 10, 2)->default(0);
            $table->string('second_time_description')->nullable();
            $table->decimal('third_time', 10, 2)->default(0);
            $table->string('third_time_description')->nullable();
            $table->decimal('fourth_time', 10, 2)->default(0);
            $table->string('fourth_time_description')->nullable();
            $table->decimal('more_than_four_times', 10, 2)->default(0);
            $table->string('more_than_four_times_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalty_types');
    }
};
