<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameChangeHistory extends Model
{
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'name_change_history';

    /**
     * Array of protected attributes
     * 
     * @var array
     */
    protected $guarded = [];
}
