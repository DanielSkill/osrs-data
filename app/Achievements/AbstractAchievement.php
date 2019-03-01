<?php

namespace App\Achievements;

use App\Models\Player;
use App\Models\PlayerDataPoint;

abstract class AbstractAchievement
{
    /**
     * @var PlayerDataPoint
     */
    public $dataPoint;

    /**
     * @var Player
     */
    public $player;

    /**
     * @param PlayerDataPoint $dataPoint
     * @param Player $player
     */
    public function __construct(PlayerDataPoint $dataPoint, Player $player)
    {
        $this->dataPoint = $dataPoint;
        $this->player = $player;
    }
}