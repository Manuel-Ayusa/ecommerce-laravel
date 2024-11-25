<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Producto_stock;
use Illuminate\Support\Facades\Storage;

class ProductoStockController extends Controller
{
    public function create(Producto $producto)
    {
        $stock = $producto->stock;
        return view('admin.stock.create', compact('producto', 'stock'));
    }

    public function store(Request $request)
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

        $destino = 'images/productos/';
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
            $fileName2 = time() . '-' . $file2->getClientOriginalName();
            Storage::putFileAs($destino, $file2, $fileName2);
            $foto2BD = $urlStorage .  $fileName2;
        }

        if ($request->hasFile('ft3')) {
            $file3 = $request->file('ft3');
            $fileName3 = time() . '-' . $file3->getClientOriginalName();
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

        return redirect()->route('stock.create', $idProducto);
    }

    public function show(Producto $producto)
    {   
        $stock = $producto->stock;
        return view('admin.stock.show', compact('stock', 'producto'));
    }

    public function edit(Producto_stock $item)
    {
        $name = $item->producto->name;
        return view('admin.stock.edit', compact('item', 'name'));
    }

    public function update(Request $request, Producto_Stock $item)
    {
        $request->validate([
            'color' => 'required|min:3',
            'S' => 'required',
            'M' => 'required',
            'L' => 'required',
            'XL' => 'required',
            'XXL' => 'required',
        ]);

        $destino = 'images/productos/';
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

        return redirect()->route('stock.show', $idProducto);
    }

}
