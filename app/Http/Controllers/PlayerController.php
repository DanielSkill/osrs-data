<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RSPlayerService;
use App\Services\PlayerDataPointService;
use App\Contracts\Repositories\PlayerRepositoryInterface;

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

        return $this->playerService->getPlayerStats($player);
    }

    /**
     * Create a data point for a player
     *
     * @param Request $request
     * @return void
     */
    public function record(Request $request)
    {
        $record = $this->dataPointService->recordPlayerDataPoint($request->name, $request->type ?: 'normal');
    }
}
