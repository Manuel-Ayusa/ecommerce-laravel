<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Producto_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

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


    public function createStock(Producto $producto)
    {
        $stock = $producto->stock;
        return view('productos.admin.create_stock', compact('producto', 'stock'));
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


    public function storeStock(Request $request)
    {
        $request->validate([
            'color' => 'required|min:3',
            'S' => 'required',
            'M' => 'required',
            'L' => 'required',
            'XL' => 'required',
            'XXL' => 'required',
            'ft1' => 'required',
        ]);

        $itemStock = new Producto_stock();

        $destino = 'public/images/productos/';
        $foto1BD = '';
        $foto2BD = '';
        $foto3BD = '';
        $urlStorage = 'images/productos/';
        if ($request->hasFile('ft1')) {

            $file = $request->file('ft1');
            $fileName = time() . '-' . $file->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file, $fileName);
            $foto1BD = $urlStorage . $fileName;
        } 

        if ($request->hasFile('ft2')) {
            $file2 = $request->file('ft2');
            $fileName2 = time() . '-' . $file2->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file2, $fileName2);
            $foto2BD = $urlStorage .  $fileName2;
        }

        if ($request->hasFile('ft3')) {
            $file3 = $request->file('ft3');
            $fileName3 = time() . '-' . $file3->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file3, $fileName3);
            $foto3BD = $urlStorage .  $fileName3;
        }

        $itemStock->color = $request->color;
        $itemStock->S = $request->S;
        $itemStock->M = $request->M;
        $itemStock->L = $request->L;
        $itemStock->XL = $request->XL;
        $itemStock->XXL = $request->XXL;
        $itemStock->imagen1 = $foto1BD;
        $itemStock->imagen2 = $foto2BD;
        $itemStock->imagen3 = $foto3BD;
        $itemStock->producto_id = $request->productoId;

        $itemStock->save();

        $idProducto = $request->productoId;

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
        return view('productos.admin.edit', compact('producto'));
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

        $destino = 'public/images/productos/';
        $urlStorage = 'images/productos/';

        if ($request->hasFile('ft1')) {
            Storage::delete('public/' . $request->ftAnt1);

            $file1 = $request->file('ft1');
            $file1Name = time() . '-' . $file1->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file1, $file1Name);
            $foto1 = $urlStorage . $file1Name;
            $producto->ft1 = $foto1;
        }

        if ($request->hasFile('ft2')) {
            Storage::delete('public/' . $request->ftAnt2);

            $file2 = $request->file('ft2');
            $fileName2 = time() . '-' . $file2->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file2, $fileName2);
            $foto2BD = $urlStorage . $fileName2;
            $producto->ft2 = $foto2BD;
        } 

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
        
        return view('productos.admin.administrar', compact('productos', 'categoria', 'h2', 'categorias'));
    }

    public function stock(Producto $producto)
    {   
        $stock = $producto->stock;
        return view('productos.admin.stock', compact('stock', 'producto'));
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

    public function editStock(Producto_stock $item)
    {
        $name = $item->producto->name;
        return view('productos.admin.edit_stock', compact('item', 'name'));
    }

    public function updateStock(Request $request, Producto_Stock $item)
    {
        $request->validate([
            'color' => 'required|min:3',
            'S' => 'required',
            'M' => 'required',
            'L' => 'required',
            'XL' => 'required',
            'XXL' => 'required',
        ]);

        $destino = 'public/images/productos/';
        $foto1BD = '';
        $foto2BD = '';
        $foto3BD = '';
        if ($request->hasFile('ft1')) {

            $file = $request->file('ft1');
            $fileName = time() . '-' . $file->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file, $fileName);
            $urlStorage = 'images/productos/';
            $foto1BD = $urlStorage . $fileName;
        } 

        if ($request->hasFile('ft2')) {
            $file2 = $request->file('ft2');
            $fileName2 = time() . '-' . $file2->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file2, $fileName2);
            $foto2BD = $urlStorage .  $fileName2;
        }

        if ($request->hasFile('ft3')) {
            $file3 = $request->file('ft3');
            $fileName3 = time() . '-' . $file3->getClientOriginalName(); //time() para que no haya imagenes duplicadas
            Storage::putFileAs($destino, $file3, $fileName3);
            $foto3BD = $urlStorage .  $fileName3;
        }

        $item->color = $request->color;
        $item->S = $request->S;
        $item->M = $request->M;
        $item->L = $request->L;
        $item->XL = $request->XL;
        $item->XXL = $request->XXL;
        $item->imagen1 = $foto1BD;
        $item->imagen2 = $foto2BD;
        $item->imagen3 = $foto3BD;
        $item->producto_id = $request->productoId;

        $item->save();

        $idProducto = $request->productoId;

        return redirect()->route('productos.stock', $idProducto);
    }
}
