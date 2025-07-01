<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accommodation;


class AccommodationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accommodations = ['SENCILLA', 'DOBLE', 'TRIPLE', 'CUÁDRUPLE'];
        foreach ($accommodations as $acc) {
            Accommodation::firstOrCreate(['name' => $acc]);
        }
    }
}
