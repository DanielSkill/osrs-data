<?php

namespace App\Listeners\Achievements;

use Illuminate\Cache\Repository as Cache;
use App\Events\DataPointRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearPlayerResponseCache
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * Create the event listener.
     *
     * @param Cache $cache
     * @return void
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle the event.
     *
     * @param  DataPointRecorded  $event
     * @return void
     */
    public function handle(DataPointRecorded $event)
    {
        $this->cache->forget('player.' . $event->player->id);
    }
}
