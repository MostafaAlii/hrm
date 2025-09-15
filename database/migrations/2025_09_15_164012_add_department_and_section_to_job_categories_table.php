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
            Schema::table('job_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('job_categories', 'department_id')) {
                    $table->foreignId('department_id')
                        ->nullable()
                        ->constrained('departments')
                        ->onDelete('cascade')
                        ->after('company_id');
                }

                if (!Schema::hasColumn('job_categories', 'section_id')) {
                    $table->foreignId('section_id')
                        ->nullable()
                        ->constrained('sections')
                        ->onDelete('cascade')
                        ->after('department_id');
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_categories', function (Blueprint $table) {
            if (Schema::hasColumn('job_categories', 'section_id')) {
                $table->dropForeign(['section_id']);
                $table->dropColumn('section_id');
            }

            if (Schema::hasColumn('job_categories', 'department_id')) {
                $table->dropForeign(['department_id']);
                $table->dropColumn('department_id');
            }
        });
    }
};