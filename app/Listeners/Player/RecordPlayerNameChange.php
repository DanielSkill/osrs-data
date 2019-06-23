<?php

namespace App\Listeners\Player;

use App\Events\PlayerNameChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\NameChangeHistory;

class RecordPlayerNameChange
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
     * @param  PlayerNameChange  $event
     * @return void
     */
    public function handle(PlayerNameChange $event)
    {
        $record = NameChangeHistory::create([
            'player_id' => $event->player->id,
            'old_name' => $event->oldName,
            'new_name' => $event->player->name,
            'approved_by' => 1,
        ]);
    }
}
