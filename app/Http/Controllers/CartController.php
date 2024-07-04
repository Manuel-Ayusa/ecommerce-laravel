<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_producto;
use App\Models\Producto;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function checkout()
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

            $productos = $cart->productos;

            $stock = 1;
            foreach ($productos as $item) {
                if ($item->productoInfo->stock->where('color', $item->color)->where($item->talle, '<', $item->cantidad)->first()) {
                    $stock = 0;
                }
            }
            
            if ($stock == 1) {
                $confirmacionCompra = 1;   
            } else {
                $confirmacionCompra = 0;
            }

            $total = $cart->total();
        } else {
            $productos = [];
            $total = false;
            $confirmacionCompra = false;
        }

        return view('carrito.checkout', compact('productos', 'total', 'confirmacionCompra'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'color' => 'required',
            'talle' => 'required',
            'producto_id' => 'required',
        ]);

        $producto = Producto::find($request->producto_id);
        $stock = $producto->stock;
        $stock = $stock->where('color', $request->color)->first();
        $talle = $request->talle;
        $stock = $stock->$talle;

        $request->validate([
            'cantidad' => 'required|max:' . $stock . '|numeric',
        ]);

        if (auth()->check()) {
            session(['id_user_cart' => auth()->id()]);
        } else {
            session(['id_user_cart' => request()->ip()]);
        }
        
        if (!(Cart::where('user_id', session('id_user_cart'))->where('estado', 'Activo')->exists())) {
            $cart = new Cart();

            $cart->estado = 'Activo';
            $cart->user_id = session('id_user_cart');

            $cart->save();

            $cart_id = Cart::where('user_id', session('id_user_cart'))
                            ->where('estado', 'Activo')
                            ->first();
            $cart_id = $cart_id->id;

            session(['cart_id' => $cart_id]);

            $item = new Cart_producto();

            $item->cantidad = $request->cantidad;
            $item->color = $request->color;
            $item->talle = $request->talle;
            $item->cart_id = session('cart_id');
            $item->producto_id = $request->producto_id;
            $item->save();
        } else {
            $cart_id = Cart::where('user_id', session('id_user_cart'))
                            ->where('estado', 'Activo')
                            ->first();
            $cart_id = $cart_id->id;
            session(['cart_id' => $cart_id]);

            $item = new Cart_producto();

            $item->cantidad = $request->cantidad;
            $item->color = $request->color;
            $item->talle = $request->talle;
            $item->cart_id = session('cart_id');
            $item->producto_id = $request->producto_id;
            $item->save();
        }

        return redirect()->back()->with('carrito', '¡Se agrego al carrito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,int $id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart_producto $item)
    {
        $request->validate([
            'cantidad' => 'required|min:1',
        ]);

        $item->cantidad = $request->cantidad;

        $item->save();

        return redirect()->back();
    }

    public function remove(Cart_producto $item)//elimina un objeto del carrito
    {
        $item->delete();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $carrito)
    {
        $carrito->delete();

        return redirect()->back();
    }
}
