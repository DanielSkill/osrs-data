<?php

namespace App\Services;

use App\Models\Player;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RSPlayerService extends ApiService
{
    /**
     * Method for getting a players stats
     *
     * @param string $name
     * @param string $type
     * @return Collection
     */
    public function getPlayerStats(Player $player, $type = null)
    {
        $type = $type ?: $player->type;

        $response = $this->apiClient->get(config("hiscores.endpoints.{$type}") . $player->name, [
            'http_errors' => false
        ]);

        if ($response->getStatusCode() == 404) {
            abort(404, 'No user found.');
        }

        $statistics = $this->csvToJson($response->getBody());

        return [
            'skills' => $this->mapSkills($statistics),
            'minigames' => $this->mapMinigames($statistics)
        ];
    }
}