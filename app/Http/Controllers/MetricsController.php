<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\PlayerMetricsRepositoryInterface;
use App\Models\Achievement;

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
     * @return Collection
     */
    public function skillLeaderboard(Request $request, $skill)
    {
        return $this->metricsRepository->getXpGainedLeaderboard($skill);
    }

    /**
     * Return the leaderboard for a certain skill
     *
     * @param Request $request
     * @param mixed $skill
     * @return Collection
     */
    public function achievementLeaderboard(Achievement $achievement)
    {
        return $this->metricsRepository->getAchievementLeaderboard($achievement);
    }
}
