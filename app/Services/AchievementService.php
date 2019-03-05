<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Player;
use App\Models\Achievement;
use App\Services\PlayerDataPointService;

class AchievementService
{
    /**
     * @var PlayerDataPointService
     */
    protected $dataPointService;

    /**
     * @param PlayerDataPointService $dataPointService
     */
    public function __construct(PlayerDataPointService $dataPointService)
    {
        $this->dataPointService = $dataPointService;
    }

    /**
     * Reward player with achievement
     *
     * @param Player $player
     * @param Achievement $achievement
     * @return void
     */
    public function giveXpAchievement(Player $player, Achievement $achievement)
    {
        // TODO: This does not quite work correctly
        $xpGained = $this->dataPointService->getPlayerGains(
            $player,
            Carbon::now()->subDays($achievement->timespan),
            Carbon::now()
        )[$achievement->skill]['xp_diff'];

        $currentBest = $player->achievements()
            ->where('achievements.id', $achievement->id)
            ->max('score');

        if ($xpGained > $currentBest) {
            $player->achievements()
            ->attach($achievement->id, [
                'score' => $xpGained
            ]);
        }
    }
}