<?php

namespace Database\Seeders;

use App\Models\Guild;
use Illuminate\Database\Seeder;

class GuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guild::factory(20)->create();
    }
}
