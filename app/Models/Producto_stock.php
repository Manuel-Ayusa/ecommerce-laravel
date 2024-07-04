<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Producto_stock extends Model
{
    use HasFactory;

    //relacion muchos a uno
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
