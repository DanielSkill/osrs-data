<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerDataPoint extends Model
{
    /**
     * Array of gaurded attributes
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Player relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }
}
