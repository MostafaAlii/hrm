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
        Schema::table('employee_statuses', function (Blueprint $table) {
            $table->boolean('applied')
                ->default(false)
                ->after('notes')
                ->comment('تم تطبيق التغيير على الموظف؟');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_statuses', function (Blueprint $table) {
            $table->dropColumn('applied');
        });
    }
};