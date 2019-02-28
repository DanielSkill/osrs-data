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
     * Data Points relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataPoints()
    {
        return $this->hasMany('App\Models\PlayerDataPoint');
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
