<?php

namespace App\Listeners\Achievements;

use App\Events\DataPointRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MostOverallXPAchievementMonth
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DataPointRecorded  $event
     * @return void
     */
    public function handle(DataPointRecorded $event)
    {
        //
    }
}