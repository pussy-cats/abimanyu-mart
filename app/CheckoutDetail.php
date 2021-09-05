<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    public function checkout()
    {
        return $this->belongsTo('App\Checkout', 'checkout_id', 'id');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart', 'id', 'cart_id');
    }
}
