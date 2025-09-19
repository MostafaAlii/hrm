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
        Schema::create('military_services', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('status')->nullable()->comment('الموقف من التجنيد (لم تحدد - أدى الخدمة - مؤجل - تحت الطلب - لم يصبه الدور - معاف - معاف مؤقت)');
            $table->string('military_card_number')->nullable()->comment('رقم البطاقة العسكرية');
            $table->date('issue_date')->nullable()->comment('تاريخ صدور البطاقة العسكرية');
            $table->date('expiry_date')->nullable()->comment('تاريخ انتهاء البطاقة العسكرية');
            $table->string('batch_number')->nullable()->comment('رقم الدفعة العسكرية');
            $table->text('additional_info')->nullable()->comment('معلومات إضافية عن الخدمة العسكرية');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_services');
    }
};