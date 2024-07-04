<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Orders_cliente extends Model
{
    use HasFactory;

    //relacion uno a uno
    public function orden()
    {
        return $this->belongsTo(Order::class);
    }
}
