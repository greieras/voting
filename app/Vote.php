<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    public function options()
    {
        return $this->hasMany('App\Option',  'id');
    }
}
