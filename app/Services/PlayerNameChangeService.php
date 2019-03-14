<?php

namespace App\Services;

use App\Services\RSPlayerService;
use App\Models\Player;
use App\Events\PlayerNameChange;

class PlayerNameChangeService
{
    /**
     * @var RSPlayerService
     */
    protected $playerService;

    /**
     * @param RSPlayerService $playerService
     */
    public function __construct(RSPlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * Change the players name if the requested name exists on the hiscores
     *
     * @param Player $player
     * @param string $newName
     * @return bool
     */
    public function changeName(Player $player, string $newName)
    {
        $oldName = $player->name;

        $exists = $this->playerService->getPlayerStats($newName);

        // the requested name does not exist on hiscores
        if (! $exists) {
            return false;    
        }

        $update = $player->update([
            'name' => $newName
        ]);

        event(new PlayerNameChange($player, $oldName));

        return $update;
    }
}