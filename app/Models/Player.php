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
