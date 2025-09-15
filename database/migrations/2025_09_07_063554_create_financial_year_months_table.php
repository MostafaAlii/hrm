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
        Schema::create('financial_year_months', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('اسم الشهر (يناير، فبراير...)');
            $table->integer('number_of_days')->nullable()->comment('عدد ايام الشهر');
            $table->string('year_and_month')->nullable()->comment('السنه و الشهر');
            $table->date('start_date')->nullable()->comment('تاريخ بداية الشهر');
            $table->date('end_date')->nullable()->comment('تاريخ نهاية الشهر');
            $table->date('fingerprint_start_date')->nullable()->comment('تاريخ بداية الشهر الخاص بالبصمه');
            $table->date('fingerprint_end_date')->nullable()->comment('تاريخ نهاية الشهر الخاص بالبصمه');
            $table->boolean('is_closed')->default(0)->comment('حالة الشهر: 0 = مفتوح، 1 = مقفول');
            $table->foreignId('financial_year_id')->constrained('financial_years')->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('added_by_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_year_months');
    }
};
