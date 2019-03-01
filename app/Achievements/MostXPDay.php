<?php

namespace App\Achievements;

use Carbon\Carbon;
use App\Contracts\Achievements\AchievementInterface;


class MostXPDay extends AbstractAchievement implements AchievementInterface
{
    /**
     * Determine if achievement should be recorded
     *
     * @return bool
     */
    public function shouldRecord()
    {
        return true;
    }

    /**
     * Action to perform is achievement passes
     *
     * @return void
     */
    public function handle()
    {
        $dataPointService = app()->make('App\Services\PlayerDataPointService');

        $xpGained = $dataPointService->getPlayerGains(
            $this->player,
            Carbon::now()->startOfDay(),
            Carbon::now()->endOfDay()
        )['Overall']['xp_diff'];

        $this->player->achievements()->attach(1, ['score' => $xpGained]);
    }
}