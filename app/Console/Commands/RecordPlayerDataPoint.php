<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PlayerDataPointService;
use App\Contracts\Repositories\PlayerRepositoryInterface;

class RecordPlayerDataPoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:data-point';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record a data point for the specified user';

    /**
     * @var PlayerDataPointService
     */
    protected $dataPointService;

    /**
     * @var PlayerRepositoryInterface
     */
    protected $playerRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        PlayerDataPointService $dataPointService,
        PlayerRepositoryInterface $playerRepository)
    {
        parent::__construct();

        $this->dataPointService = $dataPointService;
        $this->playerRepository = $playerRepository;
    }

    /**
     * Loop over all players that have permission to auto refresh and create a new 
     * data point. Need to figure a way of making this more performant when we have a 
     * larger dataset.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->playerRepository->getAllAutoRefreshPlayers() as $player) {
            $this->dataPointService->recordPlayerDataPoint($player->name, $player->type);   
        }
    }
}
