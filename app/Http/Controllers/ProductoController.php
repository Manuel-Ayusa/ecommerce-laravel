<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $categorias = Producto::distinct('categoria')->pluck('categoria');

        return view('productos.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.admin.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'categoria' => 'required',
            'descripcion' => 'required|max:500',
            'precio' => 'required',
        ]);

        $producto = new Producto();

        $producto->name = $request->name;
        $producto->categoria = $request->categoria;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
    
        $producto->save();

        $producto = Producto::orderBy('id', 'desc')->first();
        $idProducto = $producto->id;

        return redirect()->route('productos.create_stock', $idProducto);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $categoria, $producto = null)
    {
        $productos = Producto::where('categoria', $categoria)->get();
        if ($producto != null) {
            $produc = Producto::where('id', $producto)->first();
            $stock = $produc->stock;
        } else {
            $produc = false;
            $stock = false;
        }

        return view('productos.show', compact('categoria', 'productos', 'produc', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'name' => 'required|min:3',
            'categoria' => 'required',
            'descripcion' => 'required|max:500',
            'precio' => 'required',
        ]);

        $producto->name = $request->name;
        $producto->categoria = $request->categoria;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;

        $producto->save();

        return redirect()->route('productos.administrar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.administrar');
    }

    //Admin

    public function administrar(string $categoria = null)
    {
        $categorias = Producto::distinct('categoria')->pluck('categoria');
        if ($categoria == null) {
            $productos = Producto::all();
            $h2 = 'Todos los Productos';    
        } else {
            $productos = Producto::where('categoria', $categoria)->get();
            $h2 = ucfirst($categoria);    
        }
        
        return view('admin.productos.administrar', compact('productos', 'categoria', 'h2', 'categorias'));
    }

    public function destacar(Producto $producto)
    {
        if ($producto->destacado == 0) {
            $producto->destacado = 1;
        } else {
            $producto->destacado = 0;
        }

        $producto->save();
        $categoria = $producto->categoria;

        return redirect()->route('productos.administrar', $categoria);
    }
}
