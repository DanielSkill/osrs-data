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
    public function getPlayerStats($player, $type = null)
    {
        // give the ability to pass either name or model
        if (is_string($player)) {
            $name = $player;
            $type = $type ?: 'normal';
        } else {
            $name = $player->name;
            $type = $type ?: $player->type;
        } 

        $response = $this->apiClient->get(config("hiscores.endpoints.{$type}") . $name, [
            'http_errors' => false
        ]);

        if ($response->getStatusCode() == 404) {
            return false;
        }

        $statistics = $this->csvToJson($response->getBody());

        return [
            'skills' => $this->mapSkills($statistics),
            'minigames' => $this->mapMinigames($statistics)
        ];
    }
}