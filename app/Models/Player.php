<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * An array of guarded attributes
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_updated' => 'datetime',
    ];

    /**
     * Data Points relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataPoints()
    {
        return $this->hasMany('App\Models\PlayerDataPoint');
    }

    /**
     * Player Achievements relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function achievements()
    {
        return $this->belongsToMany('App\Models\Achievement', 'player_achievements');
    }

    /**
     * A helper function for updated the last updated at timestamp
     *
     * @return bool
     */
    public function touchLastUpdated()
    {
        $this->last_updated = $this->freshTimestamp();

        return $this->save();
    }
}
