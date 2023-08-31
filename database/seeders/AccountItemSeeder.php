<?php

namespace Database\Seeders;

use App\Models\AccountItem;
use Illuminate\Database\Seeder;

class AccountItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountItem::factory(20)->create();
    }
}
