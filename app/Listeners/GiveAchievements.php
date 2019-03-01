<?php

namespace App\Listeners;

use App\Events\DataPointRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Achievements\MostXPDay;

class GiveAchievements
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
        $achievement = new MostXPDay($event->dataPoint, $event->player);

        if ($achievement->shouldRecord()) {
            $achievement->handle();
        }
    }
}
