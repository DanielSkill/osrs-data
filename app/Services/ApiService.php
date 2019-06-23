<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

abstract class ApiService
{
    /**
     * @var Guzzle
     */
    protected $apiClient;

    /**
     * @param Guzzle $client
     */
    public function __construct(Client $client)
    {
        $this->apiClient = $client;
    }

    /**
     * Converts csv format into json
     *
     * @param mixed $csv
     * @return Collection
     */
    public function csvTojson($csv)
    {
        $array = array_map("str_getcsv", explode("\n", $csv));
        $json = new Collection($array);

        return $json;
    }

    /**
     * Map player data to skills
     *
     * @param Collection $playerData
     * @return Collection
     */
    public function mapSkills($playerData)
    {
        $skillsObj = new Collection();

        for ($i = 0; $i < count(config('hiscores.skills')); $i++) {
            $skillName = config('hiscores.skills')[$i];

            $skillsObj[$skillName] = [
                'rank' => (int) $playerData[$i][0],
                'level' => (int) $playerData[$i][1],
                'xp' => (int) $playerData[$i][2]
            ];
        }

        return $skillsObj;
    }

    /**
     * Map player minigames data to collection
     *
     * @param Collection $playerData
     * @return Collection
     */
    public function mapMinigames($playerData)
    {
        $minigamesObj = new Collection();
        $skillsCount = count(config('hiscores.skills'));

        for ($i = 0; $i < count(config('hiscores.minigames')); $i++) {
            $minigame = config('hiscores.minigames')[$i];

            $minigamesObj[$minigame] = [
                'rank' => (int) $playerData[$skillsCount + $i][0],
                'score' => (int) $playerData[$skillsCount + $i][1]
            ];
        }

        return $minigamesObj;
    }
}