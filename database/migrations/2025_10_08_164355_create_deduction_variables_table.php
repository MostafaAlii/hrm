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
        Schema::create('deduction_variables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('account_number')->nullable();
            // العلاقة مع جدول أنواع متغيرات الاستقطاعات
            $table->foreignId('deduction_category_id')->nullable()->constrained('deduction_variable_categories')->nullOnDelete();
            // العلاقة مع جدول علاقات أنواع الاستحقاقات
            $table->foreignId('entitlement_type_relation_id')->nullable()->constrained('entitlement_type_relations')->nullOnDelete();
            $table->string('tax_system_code')->nullable(); // كود منظومه الضرائب
            // طبيعة الاستقطاع
            $table->boolean('is_fixed')->default(true); // ثابت
            $table->boolean('is_monthly')->default(false); // شهري
            // الحقول من نوع checkbox
            $table->boolean('is_taxable')->default(false); // يخضع للضريبه
            $table->boolean('affects_bonus')->default(false); // يوثر على المكافاه
            $table->boolean('not_affect_salary')->default(false); // لا يوثر على المرتب
            // العلاقة مع جدول أنواع الاستقطاعات
            $table->foreignId('deduction_type_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('deduction_variables');
    }
};
