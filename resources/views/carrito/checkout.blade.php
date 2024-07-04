@extends('layouts.plantilla')

@section('title', 'Carrito')

@section('content')
    <a href="{{route('productos.index')}}" class="btn btn-dark ms-4 mt-2 boton-carrito">Agregar productos al Carrito</a>

    <section class="container-fluid row contenido-carrito">
        <section class="col-7 carrito-productos">
            @foreach ($productos as $item)
            @php
                $imagen = $item->productoInfo->stock->where('color', $item->color)->first()->imagen1;
            @endphp
                <section class="col-12 m-2 d-flex p-2 border rounded items">
                    <section class="col-6 text-center producto-carrito">
                        <a class="nav-link" href="{{route('productos.show', [$item->productoInfo->categoria, $item->productoInfo->id])}}"><h3>{{$item->productoInfo->name}}</h3>
                        <img src="{{asset('storage/' . $imagen)}}" alt="foto1" class="border rounded object-fit-fill"></a>
                    </section>
                    <section class="col-6 d-flex flex-column ps-3 mt-xl-4 pe-2 pt-3 info">
                        <p><b>Color:</b> {{$item->color}}</p>
                        <p><b>Talle:</b> {{$item->talle}}</p>
                        <p><b>Precio:</b> ${{number_format($item->productoInfo->precio, 2, ',', '.')}}</p>
                        <form action="{{route('carrito.update', $item->id)}}" method="post">
                            @csrf
                            @method('put')
                            <label><b>Cantidad</b></label>
                            <input type="number" name="cantidad" min="1" value="{{$item->cantidad}}" class="form-control">
                            <input type="submit" value="Actualizar Cantidad" class="btn btn-primary mt-2 mb-4 form-control text-center">
                        </form>
                        @if ($item->productoInfo->stock->where('color', $item->color)->where($item->talle, '<', $item->cantidad)->first())
                        <p class="bg-danger p-2 rounded text-white">*No hay stock de este producto. Intente elejir otra cantidad, color o talle, de lo contrario quite el producto del carrito para continuar la compra.</p>
                        @endif
                        <form action="{{route('carrito.remove', $item->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Quitar del Carrito" class="btn btn-dark">
                        </form>
                    </section>
                </section>
            @endforeach
        </section>
        <section class="col-5 border-start mt-2 info-compra"> 
            @if (isset($productos[0]))
                <h3>Total: ${{number_format($total, 2, ',', '.')}}</h3>
                <section id="tarjetas">
                    <img src="{{asset('storage/images/tarjetas/visa.png')}}" alt="visa" class="col-3">
                    <img src="{{asset('storage/images/tarjetas/1-Mastercard-Logo.png')}}" alt="mastercard" class="col-3">
                    <img src="{{asset('storage/images/tarjetas/American_Express_logo_.png')}}" alt="americanExpress" class="col-3">
                </section>
                @if ($confirmacionCompra == 0)
                    <button class="btn btn-dark p-3" disabled="disabled"><a href="{{route('order.create')}}" class="nav-link">Empezar Compra</a></button>
                @else 
                    <button class="btn btn-dark p-3"><a href="{{route('order.create')}}" class="nav-link">Empezar Compra</a></button>
                @endif
                <form action="{{route('carrito.destroy', $item->carrito->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Eliminar Carrito" class="btn btn-danger mt-3">
                </form>    
            @endif
        </section>
</section>
@endsection