<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversityIdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('university_ids')->insert([
            [
                'university_id' => '202110405',
                'name' => 'Abdulrahman Alnajlat',
                'department' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => '202110467',
                'name' => 'Yara Ghannam',
                'department' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => '202110511',
                'name' => 'Mohammad Mohammad Braighish',
                'department' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
