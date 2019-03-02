<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Http\Requests\RecordPlayerStatsRequest;
use App\Http\Resources\ShowPlayerStatisticsResource;
use App\Services\PlayerDataPointService;
use App\Services\RSPlayerService;
use Illuminate\Http\Request;
use App\Contracts\Repositories\AchievementRepositoryInterface;

class PlayerController extends Controller
{
    /**
     * @var RSPlayerService
     */
    protected $playerService;

    /**
     * @var PlayerDataPointService
     */
    protected $dataPointService;

    /**
     * @var PlayerRepositoryInterface
     */
    protected $playerRepository;

    /**
     * @param RSPlayerService $playerService
     */
    public function __construct(
        RSPlayerService $playerService,
        PlayerDataPointService $dataPointService,
        PlayerRepositoryInterface $playerRepository,
        AchievementRepositoryInterface $achievementRepository) {
        $this->playerService = $playerService;
        $this->dataPointService = $dataPointService;
        $this->playerRepository = $playerRepository;
        $this->achievementRepository = $achievementRepository;
    }

    /**
     * Return the hiscores statistics for a given player
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $player = $this->playerRepository->findOrCreatePlayer($request->name, $request->type);

        // if the user doesn't have any data points yet record their first data point
        if (!$player->dataPoints()->exists()) {
            $this->dataPointService->recordPlayerDataPoint($request->name, $request->type);
        }

        $dataPoints = $this->dataPointService->getDataPointsBetween($player);

        $achievements = $this->achievementRepository->getPlayerAchievements($player);

        return new ShowPlayerStatisticsResource([
            'player' => $player,
            'statistics' => $this->playerService->getPlayerStats($player, $request->type),
            'dataPoints' => $dataPoints,
            'achievements' => $achievements
        ]);
    }

    /**
     * Create a data point for a player
     *
     * @param Request $request
     * @return void
     */
    public function record(RecordPlayerStatsRequest $request)
    {
        return $this->dataPointService->recordPlayerDataPoint($request->name, $request->type);
    }

    /**
     * Return the players gains
     *
     * @param Request $request
     * @return Response
     */
    public function gains(Request $request)
    {
        $player = $this->playerRepository->findOrFail($request->name);

        return $this->dataPointService->getPlayerGains($player, $request->start_date, $request->end_date);
    }

    /**
     * Return a players data points for a given time period
     *
     * @param Request $request
     * @return Response
     */
    public function dataPoints(Request $request)
    {
        $player = $this->playerRepository->findOrFail($request->name);

        return $this->dataPointService->getDataPointsBetween($player, $request->start_date, $request->end_date);
    }
}
