<?php

namespace App\Listeners\Achievements;

use App\Models\Achievement;
use App\Events\DataPointRecorded;
use App\Services\AchievementService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MostOverallXPAchievementWeek
{
    /**
     * @var AchievementService
     */
    protected $achievementService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    /**
     * Handle the event.
     *
     * @param  DataPointRecorded  $event
     * @return void
     */
    public function handle(DataPointRecorded $event)
    {
        $achievement = Achievement::find(2);

        $this->achievementService->giveXpAchievement($event->player, $achievement);
    }
}
