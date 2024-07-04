<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    public function __invoke(){

        $destacados = Producto::where('destacado', 1)->take(3)->get();
        $tendencia = Producto::where('categoria', 'Buzos')->take(3)->get();

        return view('home', compact('destacados', 'tendencia'));
    }
}
