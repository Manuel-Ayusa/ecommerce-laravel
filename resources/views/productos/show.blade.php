@extends('layouts.plantilla')

@section('title', 'Productos | '. $categoria)

@section('content')
    @if ($produc == false)
        <p class="ps-2 pt-3 parrafo">Inicio / Categorias / <b>{{$categoria}}</b></p>
        <article class="listado pt-2">
            @foreach ($productos as $producto)
                <section class="col-3 mb-3 producto">  
                    <section class="card text-center">    
                        <a class="nav-link" href="{{route('productos.show', [$producto->categoria, $producto->id])}}">
                            <img src="{{asset('storage/' . $producto->stock[0]->imagen1)}}" alt="imagen1" width="350rem" height="300rem" class="object-fit-fill col-12 border rounded"><h4 class="card-title pt-3">{{$producto->name}}</h4></a>
                        <section class="card-content p-2">
                            <p><b>${{number_format($producto->precio, 2, ',', '.')}}</b></p>
                            <button class="btn-primary mb-2 btn"><a class="nav-link" href="{{route('productos.show', [$producto->categoria, $producto->id])}}">Agregar al Carrito</a></button>
                        </section>
                    </section>
                </section>
            @endforeach
        </article>
    @else
        <p class="ps-2 pt-3 parrafo">Inicio / Categorias / {{$categoria}} / <b>{{$produc->name}}</b></p>
        @if (session('carrito'))
            <section class="alert alert-success">
                {{ session('carrito') }}
            </section>
        @endif
        <section class="container-fluid d-xl-flex flex-xl-row pt-xl-3 justify-content-center" id="prin-show-produc"> 
            <section class="col-1 d-flex flex-xl-column align-items-center img-previas me-xl-4">
                @foreach ($stock as $item)
                    <figure class="col-xl-5">
                        <img src="{{asset('storage/' . $item->imagen1)}}" alt="imagen" width="90rem" height="90rem" class="object-fit-fill mt-2 border rounded img-galeria">
                    </figure>
                    @if ($item->imagen2 != NULL)
                        <figure class="col-xl-5">
                            <img src="{{asset('storage/' . $item->imagen2)}}" alt="imagen2" width="90rem" height="90rem" class="object-fit-fill mt-2 border rounded img-galeria">
                        </figure>
                    @endif
                @endforeach
            </section>
            <figure class="col-4 d-flex flex-column align-items-center img-prod">
                <img src="{{asset('storage/' . $stock[0]->imagen1)}}" alt="imagen" id="produc-img" width="400rem" height="400rem" class="object-fit-fill">
                <figcaption class="pt-3">{{$produc->descripcion}}</figcaption>
            </figure>
            <section class="col-4 info-prod ps-xl-2">
                <h3 class="display-5 text-center"><b>{{$produc->name}}</b></h3>
                <p class="fs-3 text-center"><b>${{number_format($produc->precio, 2, ',', '.')}}</b></p>
                <form action="{{route('carrito.store')}}" method="post">
                    @csrf
                    <label for="color">Color</label>
                    <select name="color" id="color" class="form-control">
                    @foreach ($stock as $item)    
                        <option value="{{$item->color}}" @if ($item->color == old('color')) selected @endif>{{$item->color}}</option>
                    @endforeach
                    </select>
                    <section class="text-danger">
                        @error('color')
                        {{'*' . $message }}
                        @enderror
                    </section>
                    <label for="talle" class="mt-3">Talle</label>
                    <select name="talle" id="talle" required class="form-control">
                        <option value="S" @if (old('talle') == 'S') selected @endif>S</option>
                        <option value="M" @if (old('talle') == 'M') selected @endif>M</option>
                        <option value="L" @if (old('talle') == 'L') selected @endif>L</option>
                        <option value="XL" @if (old('talle') == 'XL') selected @endif>XL</option>
                        <option value="XXL" @if (old('talle') == 'XXL') selected @endif>XXL</option>
                    </select>
                    <section class="text-danger">
                        @error('talle')
                        {{'*' . $message }}
                        @enderror
                    </section>
                    <label for="cant" class="mt-3">Cantidad</label>
                    <input class="form-control" type="number" name="cantidad" id="cant" min="1" @if (old('cantidad') == NULL) value="1" @else value="{{old('cantidad')}}" @endif>
                    <section class="mt-3 bg-danger text-white rounded text-center p-0">
                        @error('cantidad')
                        {{'Stock Insuficiente'}}
                        @enderror
                    </section>
                    <input type="hidden" name="producto_id" value="{{$produc->id}}">
                    <input type="submit" value="Agregar al carrito" class="btn-primary mb-3 btn mt-2 p-2 col-12">
            </form>
        </section>
    </section>
    @endif
@endsection