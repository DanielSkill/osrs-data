<?php

namespace App\Contracts\Repositories;

interface PlayerMetricsRepositoryInterface
{
    /**
     * Get the leaderboard for xp gained on a certain date
     *
     * @param string $skill
     * @param mixed $date
     * @return Collection
     */
    public function getXpGainedLeaderboard(string $skill);
}