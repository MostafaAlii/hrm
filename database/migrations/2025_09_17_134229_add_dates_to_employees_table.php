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
            $table->string('identity_number')->nullable()->after('email'); 
            $table->date('birthday_date')->nullable()->after('identity_number');
            $table->date('hiring_date')->nullable()->after('birthday_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['identity_number', 'birthday_date', 'hiring_date']);
        });
    }
};