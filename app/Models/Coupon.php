<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //use HasFactory;

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        if ($this->type == 'fixed' && $total > 50 && Cart::instance('default')->count() >= 1) 
        {
            return $this->value;
        } 
        elseif ($this->type == 'percent' && $total > 100 && Cart::instance('default')->count() > 2)
        {
            return round(($this->percent_off / 100) * $total);
        } 
        elseif ($this->type == 'mixed' && $total > 200 && Cart::instance('default')->count() > 3)
        {
            return $this->value;
        }  
        elseif ($this->type == 'rejected' && $total > 1000)
        {
            return $this->value && round(($this->percent_off / 100) * $total);
        } 
        else {
            return 0;
        }
    }
}
