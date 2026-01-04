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
        Schema::create('employee_statuses', function (Blueprint $table) {
            $table->id();
            $table->morphs('employee');
            $table->string('type')->nullable();
            $table->string('changeable_type')->comment('نوع الحقل القابل للتغيير');
            $table->unsignedBigInteger('changeable_id')->nullable();
            $table->unsignedBigInteger('from_id')->nullable()->comment('القيمة القديمة المرتبطة');
            $table->unsignedBigInteger('to_id')->nullable()->comment('القيمة الجديدة المرتبطة');
            $table->string('name_from')->nullable()->comment('القيمة القديمة كنص في حال حذف القيمة المرتبطة');
            $table->string('name_to')->nullable()->comment('القيمة الجديدة كنص في حال حذف القيمة المرتبطة');
            $table->date('effective_date')->nullable()->comment('تاريخ سريان التغيير');
            $table->string('reason')->nullable()->comment('سبب التغيير');
            $table->text('notes')->nullable()->comment('ملاحظات اضافية');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_statuses');
    }
};