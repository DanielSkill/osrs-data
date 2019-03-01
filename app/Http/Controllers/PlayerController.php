<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RSPlayerService;
use App\Services\PlayerDataPointService;
use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Http\Requests\ShowPlayerStatsRequest;
use App\Http\Requests\RecordPlayerStatsRequest;

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
        PlayerRepositoryInterface $playerRepository)
    {
        $this->playerService = $playerService;
        $this->dataPointService = $dataPointService;
        $this->playerRepository = $playerRepository;
    }

    /**
     * Return the hiscores statistics for a given player
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $player = $this->playerRepository->findOrCreatePlayer($request->name, $request->type ?: 'normal');

        return $this->playerService->getPlayerStats($player, $request->type);
    }

    /**
     * Create a data point for a player
     *
     * @param Request $request
     * @return void
     */
    public function record(RecordPlayerStatsRequest $request)
    {
       return $this->dataPointService->recordPlayerDataPoint($request->name, $request->type ?: 'normal');
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
