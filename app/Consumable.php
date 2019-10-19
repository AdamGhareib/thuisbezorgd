<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    public function orders() {
        return $this->belongsTo('App\Order');
    }

    public function restaurants() {
        return $this->belongsTo('App\Restaurant');
    }
}
