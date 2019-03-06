<?php

namespace App\Repositories;

use App\Models\Player;
use App\Models\Achievement;
use App\Models\PlayerDataPoint;
use App\Contracts\Repositories\PlayerMetricsRepositoryInterface;


class PlayerMetricsRepository implements PlayerMetricsRepositoryInterface
{
    /**
     * Return the players with the most xp gained in a skill
     *
     * @param string $skill
     * @return Collection
     */
    public function getXpGainedLeaderboard(string $skill)
    {
        return PlayerDataPoint::orderByRaw("cast(json_unquote(json_extract(`data`, '$.{$skill}.xp')) as unsigned) desc")
            ->get();
    }

    /**
     * Return players with the highest xp gained for a specific achievement
     * 
     * @param Achievement $achievement
     * @return Collection
     */
    public function getAchievementLeaderboard(Achievement $achievement)
    {
        return Player::selectRaw('*, MAX(player_achievements.score) as max_score')
            ->join('player_achievements', 'players.id', '=', 'player_achievements.player_id')
            ->orderByDesc('max_score')
            ->groupBy('players.id')
            ->get();
    }
}