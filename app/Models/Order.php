<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders_cliente;
use App\Models\Orders_envio;
use App\Models\Cart;

class Order extends Model
{
    use HasFactory;

    //relacion uno a uno
    public function cliente()
    {
        return $this->hasOne(Orders_cliente::class);
    }

    public function envio()
    {
        return $this->hasOne(Orders_envio::class);
    }

    public function carrito()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
