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
    public function findOrCreatePlayer(string $name, string $type);

    /**
     * Find a player or fail the request
     *
     * @param string $name
     * @return mixed
     */
    public function findOrFail(string $name);
}