<?php

namespace App\Repositories;

use App\Models\Player;
use App\Models\Achievement;
use App\Models\PlayerDataPoint;
use App\Contracts\Repositories\PlayerMetricsRepositoryInterface;
use Carbon\Carbon;


class PlayerMetricsRepository implements PlayerMetricsRepositoryInterface
{
    /**
     * Return the players with the most xp gained in a skill
     *
     * @param string $skill
     * @param int $days
     * @return Collection
     */
    public function getXpGainedLeaderboard(string $skill, int $days = 7)
    {
        $skill = ucfirst($skill);

        return Player::join('player_data_points', 'players.id', '=', 'player_data_points.player_id')
            ->whereBetween('player_data_points.created_at', [Carbon::now()->subDays($days), Carbon::now()])
            ->selectRaw("*, MAX(cast(json_extract(`data`, '$.{$skill}.xp') as unsigned)) - MIN(cast(json_extract(`data`, '$.{$skill}.xp') as unsigned)) as xp_gained")
            ->orderByDesc('xp_gained')
            ->groupBy('player_id')
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