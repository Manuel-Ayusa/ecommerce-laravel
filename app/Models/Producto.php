<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto_stock;
use App\Models\Cart_producto;

class Producto extends Model
{
    use HasFactory;

    // relacion uno a muchos
    public function stock()
    {
        return $this->hasMany(Producto_stock::class);
    }

    public function carritos()
    {
        return $this->hasMany(Cart_producto::class);
    }
}
