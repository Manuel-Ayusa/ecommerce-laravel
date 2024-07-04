<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_producto;
use App\Models\Order;

class Cart extends Model
{
    use HasFactory;

    //relacion uno a muchos
    public function productos()
    {
        return $this->hasMany(Cart_producto::class);
    }

    //relacion uno a uno
    public function orden()
    {
        return $this->hasOne(Order::class);
    }

    
    //metodos
    static public function total()
    {
        $total = 0;
        $cart = Cart::where('user_id', session('id_user_cart'))->where('estado', 'Activo')->first();
        $productos = $cart->productos;

        foreach ($productos as $item) {
            $total += $item->cantidad * $item->productoInfo->precio;
        }

        return $total;
    }

    static public function items()
    {
        if (auth()->check()) {
            session(['id_user_cart' => auth()->id()]);
        } else {
            session(['id_user_cart' => request()->ip()]);
        }

        if (Cart::where('user_id', session('id_user_cart'))->where('estado', 'Activo')->exists()) {
            $cart = Cart::where('user_id', session('id_user_cart'))
                        ->where('estado', 'Activo')
                        ->first();
                        
            $items = $cart->productos->count();
        } else {
            $items = 0;
        }

        return $items;
    }

}
