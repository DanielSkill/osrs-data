<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    /**
     * Array of gaurded attributes
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Players relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany('App\Models\Player', 'player_achievements')->withPivot('score')->withTimestamps();
    }
}
