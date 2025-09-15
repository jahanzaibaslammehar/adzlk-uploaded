<?php

namespace Database\Seeders;

use App\Models\AdType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdType::create([
            'name' => 'Normal',
            'price' => 0,
        ]);

        AdType::create([
            'name' => 'VIP Ad',
            'price' => 500,
        ]);

        AdType::create([
            'name' => 'Super Ad',
            'price' => 1000,
        ]);
    }
}
