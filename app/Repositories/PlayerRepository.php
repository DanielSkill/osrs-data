<?php

namespace App\Repositories;

use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Models\Player;


class PlayerRepository implements PlayerRepositoryInterface
{
    /**
     * Find or create a player
     *
     * @param string $name
     * @param string $type
     * @return Collection
     */
    public function findOrCreatePlayer(string $name, string $type)
    {
        $player = Player::firstOrCreate(['name' => $name], [
            'name' => $name,
            'type' => $type
        ]);

        return $player;
    }
}