<?php

namespace Database\Seeders;

use App\Models\AdCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AdCategory::create([
            'name' => 'Live Cam',
        ]);
        
    }
}
