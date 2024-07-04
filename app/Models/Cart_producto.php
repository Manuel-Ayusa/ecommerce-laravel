<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Producto;
use App\Models\Cart;

class Cart_producto extends Model
{
    use HasFactory;
    
    //relacion muchos a uno
    public function carrito()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function productoInfo()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
