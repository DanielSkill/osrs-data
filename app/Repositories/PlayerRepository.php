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
     * @return mixed
     */
    public function findOrCreatePlayer(string $name, string $type)
    {
        $player = Player::firstOrCreate(['name' => $name], [
            'name' => $name,
            'type' => $type
        ]);

        return $player;
    }

    /**
     * Find a player or fail
     *
     * @param string $name
     * @return mixed
     */
    public function findOrFail(string $name)
    {
        return Player::where('name', $name)->firstOrFail();
    }

    /**
     * Get all players that should auto refresh, logic for this will likely
     * get changed later when there are a higher number of players in
     * the database.
     *
     * @return Collection
     */
    public function getAllAutoRefreshPlayers()
    {
        return Player::all();
    }
}