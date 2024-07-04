@extends('layouts.plantilla_admin')

@section('title', 'Administrar Productos')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center display-5 border-bottom mb-3">{{$h2}}</h2>
    <nav class="navbar navbar-expand-lg bg-light mb-3 rounded-3">
        <ul class="col-12 navbar-nav mb-2 mb-lg-0 d-flex justify-content-around">
            <li class="nav-item m-2"><a href="{{route('productos.administrar')}}" class="btn btn-dark">Todo</a></li>
            @foreach($categorias as $cat)
                <li class="nav-item m-2"><a href="{{route('productos.administrar', $cat)}}" class=" btn btn-dark">{{ucfirst($cat)}}</a></li>
            @endforeach
        </ul>
    </nav>
    <section class="table-responsive">
        <table class="text-center table table-bordered table-striped table-hover" id="table-productos">
            <thead class="align-middle">
                <tr>
                    <th>Foto Principal</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Modificar</th>
                    <th>Destacado</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($productos as $producto)
                    <tr>
                        <td class="text-center col-1"><img src="{{asset('storage/' . $producto->stock[0]->imagen1)}}" alt="{{$producto->stock[0]->imagen1}}" width="" class="col-5"></td>
                        <td>{{$producto->name}}</td>
                        <td>{{$producto->categoria}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->precio}}</td>
                        <td><a href="{{route('productos.stock', $producto->id)}}" class="btn btn-primary">Ver Stock</a></td>
                        <td><a href="{{route('productos.edit', $producto->id)}}" class="btn btn-warning">Modificar</a></td>
                        <td><a href="{{route('productos.destacar', $producto->id)}}" class="btn btn-primary">@if ($producto->destacado == 0) Destacar @else Indestacar @endif</a></td>
                        <td>
                            <form action="{{route('productos.destroy', $producto->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Eliminar" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection