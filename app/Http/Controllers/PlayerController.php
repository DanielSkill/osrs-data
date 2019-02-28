<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RSPlayerService;

class PlayerController extends Controller
{
    /**
     * @var RSPlayerService
     */
    protected $playerService;

    /**
     * @param RSPlayerService $playerService
     */
    public function __construct(RSPlayerService $playerService)
    {
        $this->playerService = $playerService;
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
}
