<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('allowance_variables', function (Blueprint $table) {
            $table->decimal('min_limit_value', 15, 2)->nullable()->after('has_max_limit');
            $table->decimal('max_limit_value', 15, 2)->nullable()->after('min_limit_value');
        });
    }

    public function down()
    {
        Schema::table('allowance_variables', function (Blueprint $table) {
            $table->dropColumn(['min_limit_value', 'max_limit_value']);
        });
    }
};
