<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder {
    public function run(): void
    {
        $genders = [
            ['name' => 'ذكر', 'is_active' => true],
            ['name' => 'انثى', 'is_active' => true],
        ];

        foreach ($genders as $gender) {
            Gender::create($gender);
        }
    }
}