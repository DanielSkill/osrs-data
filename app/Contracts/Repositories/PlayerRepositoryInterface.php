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
     * @return Collection
     */
    public function findOrCreatePlayer(string $name, string $type);
}