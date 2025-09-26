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
        Schema::table('employee_insurances', function (Blueprint $table) {
            $table->boolean('is_insured')->default(false)->after('insurance_office_id');
            $table->boolean('salary_insurance')->default(false)->after('is_insured');
            $table->boolean('employee_fund')->default(false)->after('salary_insurance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_insurances', function (Blueprint $table) {
            $table->dropColumn(['is_insured', 'salary_insurance', 'employee_fund']);
        });
    }
};
