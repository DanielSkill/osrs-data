<?php

namespace App\Repositories;

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
}