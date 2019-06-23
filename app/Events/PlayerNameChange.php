<?php

namespace App\Events;

use App\Models\Player;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayerNameChange
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Player
     */
    public $player;

    /**
     * @var string
     */
    public $oldName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Player $player, string $oldName)
    {
        $this->player = $player;
        $this->oldName = $oldName;
    }
}
