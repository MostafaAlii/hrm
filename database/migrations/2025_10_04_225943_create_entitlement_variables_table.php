<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entitlement_variables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('account_number')->nullable();
            $table->foreignId('entitlement_category_id')->nullable()->constrained('entitlement_variable_categories')->nullOnDelete();
            $table->string('category_value')->nullable();
            $table->foreignId('revenue_type_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('nature', ['fixed', 'monthly'])->default('fixed');
            $table->boolean('affected_by_deductions')->default(false);
            $table->boolean('not_affected_by_work_days')->default(false);
            $table->boolean('not_affect_entitlements')->default(false);
            $table->boolean('is_health_insurance')->default(false);
            $table->boolean('is_taxable')->default(false);
            $table->decimal('tax_exempt_amount', 15, 2)->nullable();
            $table->decimal('max_taxable_amount', 15, 2)->nullable();
            $table->boolean('has_min_limit')->default(false);
            $table->decimal('min_limit_value', 15, 2)->nullable();
            $table->boolean('has_max_limit')->default(false);
            $table->decimal('max_limit_value', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entitlement_variables');
    }
};
