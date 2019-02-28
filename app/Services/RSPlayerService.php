<?php

namespace App\Services;

use App\Models\Player;
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
    public function getPlayerStats(Player $player)
    {
        $response = $this->apiClient->get(config("hiscores.endpoints.{$player->type}") . $player->name);

        $statistics = $this->csvToJson($response->getBody());

        return [
            'skills' => $this->mapSkills($statistics),
            'minigames' => $this->mapMinigames($statistics)
        ];
    }
}