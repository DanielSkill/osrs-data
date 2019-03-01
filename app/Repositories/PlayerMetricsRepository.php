<?php

namespace App\Repositories;

use App\Contracts\Repositories\PlayerMetricsRepositoryInterface;
use App\Models\PlayerDataPoint;


class PlayerMetricsRepositoy implements PlayerMetricsRepositoryInterface
{
    public function getXpGainedLeaderboard(string $skill, $date)
    {
        return PlayerDataPoint::orderBy('data->overall->xp')
            ->get();
    }
}