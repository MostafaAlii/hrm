<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SalaryPlace;
class SalaryPlaceSeeder extends Seeder {
    public function run(): void
    {
        $places = [
            ['name' => 'البنك الاهلى', 'is_active' => true],
            ['name' => 'الخزينه', 'is_active' => true],
            ['name' => 'cib', 'is_active' => true],
        ];

        foreach ($places as $place) {
            SalaryPlace::create($place);
        }
    }
}