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
     * @param Player $player
     * @param mixed $startDate
     * @param mixed $endDate
     * @return Collection
     */
    public function getPlayerGains(Player $player, $startDate, $endDate)
    {
        $dataPoints = $this->getDataPointsBetween($player, $startDate, $endDate);

        $firstDataPoint = $dataPoints->first();
        $secondDataPoint = $dataPoints->last();

        return $this->calculateExperienceDifference($firstDataPoint, $secondDataPoint);
    }

    /**
     * Get a players lifetime gains between
     *
     * @param Player $player
     * @return Collection
     */
    public function getPlayerLifetimeGains(Player $player)
    {
        $firstDataPoint = PlayerDataPoint::where('player_id', $player->id)
            ->orderBy('created_at', 'asc')
            ->first();

        $secondDataPoint = PlayerDataPoint::where('player_id', $player->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $this->calculateExperienceDifference($firstDataPoint, $secondDataPoint);
    }

    /**
     * Get the closest data point to the date given
     *
     * @param mixed $date
     * @return Collection
     */
    public function getDataPointsBetween(Player $player, $startDate, $endDate)
    {
        return PlayerDataPoint::where('player_id', $player->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    }

    /**
     * Compare two data points and work out the differences
     *
     * @param PlayerDataPoint $firstDataPoint
     * @param PlayerDataPoint $secondDataPoint
     * @return Collection
     */
    private function calculateExperienceDifference($firstDataPoint, $secondDataPoint) 
    {
        $diffCollection = new Collection();

        foreach (config('hiscores.skills') as $skill) {
            $xpDiff = $secondDataPoint->data[$skill]['xp'] - $firstDataPoint->data[$skill]['xp'];
            $rankDiff = $secondDataPoint->data[$skill]['rank'] - $firstDataPoint->data[$skill]['rank'];
            $levelDiff = $secondDataPoint->data[$skill]['level'] - $firstDataPoint->data[$skill]['level'];

            $diffCollection[$skill] = [
                'xp_diff' => (int) $xpDiff,
                'rank_diff' => (int) $rankDiff,
                'level_diff' => (int) $levelDiff,
            ];
        }

        return $diffCollection;
    }
}