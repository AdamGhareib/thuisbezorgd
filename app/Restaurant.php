<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function consumables() {
        return $this->hasMany('App\Consumable');
    }
}
