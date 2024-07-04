@extends('layouts.plantilla')

@section('title', 'InduTuc')

@section('content')
    <section id="portada">
        <img src="{{asset('storage/images/portadas/portada1.jpg')}}" alt="portada">
        <p class="textoPortada">Indumentaria Masculina</p>
    </section>
    <h2 class="text-center mt-2 p-3 display-4">¡Destacados!</h2>
    <article class="listado pt-2">
        @foreach ($destacados as $destacado)
            <section class="col-3 producto">  
                <section class="card text-center">    
                    <a class="nav-link" href="{{route('productos.show', [$destacado->categoria, $destacado->id])}}">
                    <img src="{{asset('storage/' . $destacado->stock[0]->imagen1)}}" alt="imagen1" width="400rem" height="320rem" class="object-fit-fill col-12 border rounded"><h4 class="card-title pt-3"> {{$destacado->name}}</h4></a>
                    <section class="card-content">
                        <p class="text-success fs-4"><b>${{number_format($destacado->precio, 2, ',', '.')}}</b></p>
                        <button class="btn-primary mb-3 btn"><a class="nav-link" href="{{route('productos.show', [$destacado->categoria, $destacado->id])}}">Agregar al Carrito</a></button>
                    </section>
                </section>
            </section>
        @endforeach
    </article>

    <h2 class="text-center p-3 display-4">Tendencia</h2>
    <article class="listado pt-2">
        @foreach ($tendencia as $item)
            <section class="col-3 producto">  
                <section class="card text-center">    
                    <a class="nav-link" href="{{route('productos.show', [$item->categoria, $item->id])}}">
                    <img src="{{asset('storage/' . $item->stock[0]->imagen1)}}" alt="imagen1" width="100%" width="400rem" height="320rem" class="object-fit-fill col-12 border rounded"><h4 class="card-title pt-3"> {{$item->name}}</h4></a>
                    
                    <section class="card-content">
                        <p class="text-success fs-4"><b>${{number_format($item->precio, 2, ',', '.')}}</b></p>
                        <button class="btn-primary mb-3 btn"><a class="nav-link" href="{{route('productos.show', [$item->categoria, $item->id])}}">Agregar al Carrito</a></button>
                    </section>
                </section>
            </section>
        @endforeach
    </article>
@endsection