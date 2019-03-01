<?php

namespace App\Listeners\Achievements;

use Carbon\Carbon;
use App\Events\DataPointRecorded;
use App\Services\AchievementService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Achievement;

class MostOverallXPAchievementDay
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
        $achievement = Achievement::find(1);

        $this->achievementService->giveAchievement($event->player, $achievement);
    }
}
