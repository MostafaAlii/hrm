<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('allowance_variables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('account_number')->nullable(); // رقم الحساب
            $table->foreignId('allowance_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('category_value')->nullable(); // قيمه النوع
            $table->string('tax_system_code')->nullable(); // كود منظومه الضرائب
            $table->boolean('has_min_limit')->default(false); // الحد الادنى
            $table->boolean('has_max_limit')->default(false); // الحد الاقصى
            $table->boolean('is_taxable')->default(false); // يخضع للضريبه
            $table->boolean('is_health_insurance')->default(false); // يخضع للتامين الصحى الشامل
            $table->boolean('is_active')->default(true);
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allowance_variables');
    }
};
