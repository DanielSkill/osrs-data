<?php

namespace App\Services;

use App\Services\RSPlayerService;
use App\Models\Player;
use App\Events\PlayerNameChange;
use App\Contracts\Repositories\PlayerRepositoryInterface;

class PlayerNameChangeService
{
    /**
     * @var RSPlayerService
     */
    protected $playerService;

    /**
     * @var PlayerRepositoryInterface
     */
    protected $playerRepository;

    /**
     * @param RSPlayerService $playerService
     * @param PlayerRepositoryInterface $playerRepository
     */
    public function __construct(
        RSPlayerService $playerService,
        PlayerRepositoryInterface $playerRepository)
    {
        $this->playerService = $playerService;
        $this->playerRepository = $playerRepository;
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

        $requestedPlayer = $this->playerRepository->find($newName);

        // the requested name is not already in the database
        if ($requestedPlayer) {
            return false;
        }

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