<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServerSeeder::class,
            ServerStatusSeeder::class,
            GuildSeeder::class,
            WarSeeder::class,
            AccountSeeder::class,
            BattleSeeder::class,
            FriendshipSeeder::class,
            ClassSeeder::class,
            TradeSeeder::class,
            SkillSeeder::class,
            CharacterSeeder::class,
            ItemSeeder::class,
            AccountItemSeeder::class,
            OfferSeeder::class,
        ]);
    }
}
