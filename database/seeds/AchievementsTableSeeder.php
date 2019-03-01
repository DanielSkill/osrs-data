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
            ['name' => 'Highest Overall XP Day', 'skill' => 'Overall'],
            ['name' => 'Highest Overall XP Week', 'skill' => 'Overall'],
            ['name' => 'Highest Overall XP Month', 'skill' => 'Overall'],
            ['name' => 'Highest Overall XP Year', 'skill' => 'Overall']
        ]);
    }
}
