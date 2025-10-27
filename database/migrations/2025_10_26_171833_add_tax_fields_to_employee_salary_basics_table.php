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
        Schema::table('employee_salary_basics', function (Blueprint $table) {
            $table->boolean('is_taxable')->default(false)->after('basic_salary');
            $table->boolean('include_tax_in_salary')->default(false)->after('is_taxable');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_salary_basics', function (Blueprint $table) {
            $table->dropColumn(['is_taxable', 'include_tax_in_salary']);
        });
    }
};
