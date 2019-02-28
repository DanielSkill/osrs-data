<?php

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerDataPoint;
use App\Services\RSPlayerService;
use Illuminate\Support\Collection;
use App\Contracts\Repositories\PlayerRepositoryInterface;

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

        return $dataPoint;
    }

    /**
     * Get a players gains between two dates
     *
     * @param mixed $startDate
     * @param mixed $endDate
     * @return Collection
     */
    public function getPlayerGains(Player $player, $startDate, $endDate)
    {
        $firstDataPoint = $this->getClosestDataPoint($player, $startDate);
        $secondDataPoint = $this->getClosestDataPoint($player, $endDate);

        $diffCollection = new Collection();

        foreach (config('hiscores.skills') as $skill) {
            $xpDiff = $secondDataPoint->data[$skill]['xp'] - $firstDataPoint->data[$skill]['xp'];
            $rankDiff = $secondDataPoint->data[$skill]['rank'] - $firstDataPoint->data[$skill]['rank'];
            $levelDiff = $secondDataPoint->data[$skill]['level'] - $firstDataPoint->data[$skill]['level'];

            $diffCollection[$skill] = [
                'xp_diff' => (int) $xpDiff,
                'rank_diff' => (int) $rankDiff,
                'level_diff' => (int) $levelDiff
            ];
        }

        return $diffCollection;
    }

    /**
     * Get the closest data point to the date given
     *
     * @param mixed $date
     * @return Collection
     */
    public function getClosestDataPoint(Player $player, $date)
    {
        return PlayerDataPoint::where('player_id', $player->id)
            ->where('created_at', '>', $date)
            ->first();
    }
}