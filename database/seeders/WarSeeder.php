<?php

namespace Database\Seeders;

use App\Models\War;
use Illuminate\Database\Seeder;

class WarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        War::factory(20)->create();
    }
}
