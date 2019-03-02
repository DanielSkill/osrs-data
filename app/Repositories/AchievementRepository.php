<?php

namespace App\Repositories;

use App\Models\Player;
use App\Contracts\Repositories\AchievementRepositoryInterface;

class AchievementRepository implements AchievementRepositoryInterface
{
    /**
     * Get a players achievements
     *
     * @param Player $player
     * @return Collection
     */
    public function getPlayerAchievements(Player $player)
    {
        // TODO: This does a unique filter after the query has finished 
        // which could lead to performance issues
        return $player->achievements()
            ->orderByDesc('score')
            ->get()
            ->unique('id');
    }
}