<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Player;
use App\Models\PlayerDataPoint;

class DataPointRecorded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Player
     */
    public $player;

    /**
     * @var PlayerDataPoint
     */
    public $dataPoint;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Player $player, PlayerDataPoint $dataPoint)
    {
        $this->player = $player;
        $this->dataPoint = $dataPoint;
    }
}
