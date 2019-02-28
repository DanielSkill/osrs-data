<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RSPlayerService;
use App\Services\PlayerDataPointService;

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
     * @param RSPlayerService $playerService
     */
    public function __construct(
        RSPlayerService $playerService,
        PlayerDataPointService $dataPointService)
    {
        $this->playerService = $playerService;
        $this->dataPointService = $dataPointService;
    }

    /**
     * Return the hiscores statistics for a given player
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        return $this->playerService->getPlayerStats($request->name, 'normal');
    }

    /**
     * Create a data point for a player
     *
     * @param Request $request
     * @return void
     */
    public function record(Request $request)
    {
        $record = $this->dataPointService->recordPlayerDataPoint($request->name, $request->type);
    }
}
