<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    public function product(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function checkoutDetail()
    {
        return $this->belongsTo('App\CheckoutDetail', 'cart_id', 'id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->product->price;
    }
}
