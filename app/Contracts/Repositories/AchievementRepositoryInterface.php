<?php

namespace App\Contracts\Repositories;

use App\Models\Player;


interface AchievementRepositoryInterface
{
    /**
     * Get a player achievements
     *
     * @param Player $player
     * @return Collection
     */
    public function getPlayerAchievements(Player $player);
}