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
        $player = Player::where('name', $value)->firstOrFail();

        $nextAvailableUpdate = $player->last_updated->addMilliseconds(config('hiscores.options.timeout'));

        if (Carbon::now()->greaterThan($nextAvailableUpdate)) {
            return false;
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
}
