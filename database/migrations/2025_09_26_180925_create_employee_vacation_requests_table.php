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
        Schema::create('employee_vacation_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete(); // الموظف مقدم الطلب
            $table->foreignId('vacation_id')->constrained()->cascadeOnDelete();
            $table->enum('request_type', ['vacation', 'permission'])->default('vacation');
            $table->date('start_date');   // من
            $table->date('end_date');     // إلى
            $table->integer('duration_value')->nullable(); // 5
            $table->enum('duration_unit', ['days', 'hours', 'minutes'])->nullable();
            $table->text('description')->nullable(); // الوصف
            $table->text('notes')->nullable();       // ملاحظات
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // حالة الطلب: انتظار - موافقة - رفض
            $table->foreignId('approved_by_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_vacation_requests');
    }
};