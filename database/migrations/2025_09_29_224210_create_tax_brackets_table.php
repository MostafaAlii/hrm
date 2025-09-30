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
        Schema::create('tax_brackets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('bracket_name');
            $table->decimal('value', 15, 2)->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->enum('level', [1, 2, 3, 4, 5])->nullable();
            $table->foreignId('tax_setting_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('tax_brackets');
    }
};