<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Player;
use App\Models\PlayerDataPoint;
use App\Services\RSPlayerService;
use Illuminate\Support\Collection;
use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Events\DataPointRecorded;

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
    public function recordPlayerDataPoint(Player $player)
    {
        $data = $this->playerService->getPlayerStats($player);

        if (! $data) {
            return false;
        }

        $dataPoint = PlayerDataPoint::create([
            'player_id' => $player->id,
            'data' => $data['skills']
        ]);

        event(new DataPointRecorded($player, $dataPoint));

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
    public function getDataPointsBetween(Player $player, $startDate = null, $endDate = null)
    {
        $dataPoints = PlayerDataPoint::where('player_id', $player->id);

        if (!is_null($startDate) && !is_null($endDate)) {
            $dataPoints->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        return $dataPoints->get();
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