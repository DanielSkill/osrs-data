<?php

namespace App\Contracts\Repositories;

use App\Models\Player;

interface PlayerRepositoryInterface
{
    /**
     * Find a player or create them
     *
     * @param string $name
     * @param string $type
     * @return mixed
     */
    public function findOrCreatePlayer(string $name, $type);

    /**
     * Find a player or fail the request
     *
     * @param string $name
     * @return mixed
     */
    public function findOrFail(string $name);

    /**
     * Find a player
     *
     * @param string $name
     * @return mixed
     */
    public function find(string $name);

    /**
     * Get all players that should auto refresh data
     *
     * @return Collection
     */
    public function getAllAutoRefreshPlayers();
}