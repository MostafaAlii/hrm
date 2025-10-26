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
        Schema::table('allowance_variables', function (Blueprint $table) {
            $table->foreignId('entitlement_type_relation_id')
                ->nullable()
                ->constrained('entitlement_type_relations')
                ->nullOnDelete()
                ->after('tax_system_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allowance_variables', function (Blueprint $table) {
            $table->dropForeign(['entitlement_type_relation_id']);
            $table->dropColumn('entitlement_type_relation_id');
        });
    }
};