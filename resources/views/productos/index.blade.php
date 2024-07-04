@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
    <p class="ps-2 pt-3 parrafo">Inicio / <b>Productos</b></p>
    <article class="listado pt-2">
        @foreach ($productos as $producto)
            <section class="col-3 m-1 mb-3 producto">  
                <section class="card text-center">    
                    <a class="nav-link" href="{{route('productos.show', [$producto->categoria, $producto->id])}}">
                        <img src="{{asset('storage/' . $producto->stock[0]->imagen1)}}" alt="imagen1" width="350rem" height="300rem" class="object-fit-fill col-12 border rounded"><h4 class="card-title"><h4 class="card-title pt-3"> {{$producto->name}}</h4></a>
                    
                    <section class="card-content p-2">
                        <p class="fs-4"><b>${{number_format($producto->precio, 2, ',', '.')}}</b></p>
                        <button class="btn-primary mb-2 btn"><a class="nav-link" href="{{route('productos.show', [$producto->categoria, $producto->id])}}">Agregar al Carrito</a></button>
                    </section>
                </section>
            </section>
        @endforeach
    </article>
@endsection