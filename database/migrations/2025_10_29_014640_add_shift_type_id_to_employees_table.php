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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('shift_type_id')
                ->nullable()
                ->constrained('shift_types')
                ->onDelete('set null')
                ->after('salary_place_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['shift_type_id']);
            $table->dropColumn('shift_type_id');
        });
    }
};
