<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('breeds')->insert([
            ['name' => 'Abyssinian'],
            ['name' => 'Chihuahua'],
            ['name' => 'Husky'],
            ['name' => 'Labrador Retriever'],
            ['name' => 'Rat Terrier'],
            ['name' => 'Schnauzer'],
        ]);
    }
}
