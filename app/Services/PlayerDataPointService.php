<?php

namespace App\Services;

use App\Models\Player;
use App\Services\RSPlayerService;
use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Models\PlayerDataPoint;

class PlayerDataPointService
{    
    /**
     * @var RSPlayerService
     */
    protected $playerService;

    /**
     * @var PlayerRepositoryInterface
     */
    protected $playerRepository;

    /**
     * @param RSPlayerService $playerService
     */
    public function __construct(
        RSPlayerService $playerService,
        PlayerRepositoryInterface $playerRepository)
    {
        $this->playerService = $playerService;
        $this->playerRepository = $playerRepository;
    }

    /**
     * Record a data point for the requested player
     *
     * @param string $player
     * @param string $type
     * @return bool
     */
    public function recordPlayerDataPoint(string $name, string $type = 'normal')
    {
        $player = $this->playerRepository->findOrCreatePlayer($name, $type);
        
        $data = $this->playerService->getPlayerStats($player);

        $dataPoint = PlayerDataPoint::create([
            'player_id' => $player->id,
            'data' => $data['skills']
        ]);

        // updates the last updated timestamp
        $player->touchLastUpdated();
    }
}