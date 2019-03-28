<?php

namespace App\Contracts\Repositories;

use App\Models\Achievement;


interface PlayerMetricsRepositoryInterface
{
    /**
     * Get the leaderboard for xp gained on a certain date
     *
     * @param string $skill
     * @return Collection
     */
    public function getXpGainedLeaderboard(string $skill, int $days);

    /**
     * Return players with the highest xp gained for a specific achievement
     *
     * @param Achievement $achievement
     * @return Collection
     */
    public function getAchievementLeaderboard(Achievement $achievement);
}