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
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();

            // البيانات الشخصية
            $table->string('identify_number')->unique()->nullable(); // الرقم القومي أو الهوية
            $table->date('birthdate')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('genders')->nullOnDelete();
            $table->foreignId('birth_governorate_id')->nullable()->constrained('governorates')->nullOnDelete();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->nullOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained('religions')->nullOnDelete();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->foreignId('blood_type_id')->nullable()->constrained('blood_types')->nullOnDelete();

            // بيانات العنوان
            $table->foreignId('address_governorate_id')->nullable()->constrained('governorates')->nullOnDelete();
            $table->foreignId('address_city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('address')->nullable();

            // بيانات الاتصال
            $table->string('phone')->nullable();
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};