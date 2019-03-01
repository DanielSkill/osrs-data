<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Contracts\Repositories\PlayerRepositoryInterface;
use Carbon\Carbon;
use App\Models\Player;

class Timeout implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //    
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $player = Player::where('name', $value)->first();

        if ($player) {
            $nextAvailableUpdate = $this->getNextAvailableRefreshTime($player); 
    
            if ($nextAvailableUpdate->greaterThan(Carbon::now())) {
                return false;
            }
    
            return true;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please wait before trying to update again.';
    }

    /**
     * Return the time the person can next refresh
     *
     * @param Player $player
     * @return Carbon
     */
    private function getNextAvailableRefreshTime(Player $player)
    {
        return $player->last_updated->addSeconds(config('hiscores.options.refresh_timeout'));
    }
}
