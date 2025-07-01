<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Bogotá',
            'Medellín',
            'Cali',
            'Barranquilla',
            'Cartagena',
            'Cúcuta',
            'Bucaramanga',
            'Pereira',
            'Santa Marta',
            'Manizales',
            'Ibagué',
            'Villavicencio',
            'Neiva',
            'Armenia',
            'Montería',
            'Popayán',
            'Sincelejo',
            'Pasto',
            'Tunja',
            'Riohacha'
        ];

        foreach ($cities as $city) {
            DB::table('cities')->updateOrInsert(['name' => $city]);
        }
    }
}
