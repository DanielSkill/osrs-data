<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\PlayerMetricsRepositoryInterface;

class MetricsController extends Controller
{
    /**
     * @var PlayerMetricsRepositoryInterface
     */
    protected $metricsRepository;

    /**
     * @param PlayerMetricsRepositoryInterface $metricsRepository
     */
    public function __construct(PlayerMetricsRepositoryInterface $metricsRepository)
    {
        $this->metricsRepository = $metricsRepository;
    }

    /**
     * Return the leaderboard for a certain skill
     *
     * @param Request $request
     * @param mixed $skill
     * @return void
     */
    public function skillLeaderboard(Request $request, $skill)
    {
        return $this->metricsRepository->getXpGainedLeaderboard($skill);
    }
}
