<?php

namespace App\Services;

use Illuminate\Support\Collection;

class RSPlayerService extends ApiService
{
    /**
     * Method for getting a players stats
     *
     * @param string $name
     * @param string $type
     * @return Collection
     */
    public function getPlayerStats(string $name, string $type = 'normal')
    {
        $response = $this->apiClient->get(config("hiscores.endpoints.{$type}") . $name);

        $statistics = $this->csvToJson($response->getBody());

        return [
            'skills' => $this->mapSkills($statistics),
            'minigames' => $this->mapMinigames($statistics)
        ];
    }
}