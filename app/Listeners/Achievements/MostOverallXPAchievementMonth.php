<?php

namespace App\Listeners\Achievements;

use App\Models\Achievement;
use App\Events\DataPointRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MostOverallXPAchievementMonth
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
        $achievement = Achievement::find(3);

        $this->achievementService->giveXpAchievement($event->player, $achievement);
    }
}
