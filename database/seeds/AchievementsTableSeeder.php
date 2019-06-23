<?php

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Achievement::insert([
            ['name' => 'Highest Overall XP Day', 'skill' => 'Overall', 'timespan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Highest Overall XP Week', 'skill' => 'Overall', 'timespan' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Highest Overall XP Month', 'skill' => 'Overall', 'timespan' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Highest Overall XP Year', 'skill' => 'Overall', 'timespan' => 365, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
