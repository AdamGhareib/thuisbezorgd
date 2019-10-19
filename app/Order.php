<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function users() {
        return $this->belongsTo('App\User');
    }

    public function restaurants() {
        return $this->belongsTo('App\Restaurant');
    }

    public function consumables() {
        return $this->belongsTo('App\Consumable')->withPivot('quantity', 'price', 'created_at');
    }
}
