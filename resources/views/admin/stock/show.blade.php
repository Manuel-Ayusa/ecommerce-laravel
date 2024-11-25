@extends('layouts.plantilla_admin')

@section('title', 'Administrar Productos')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center fs-2 border-bottom mb-3">Stock del Producto: {{$producto->name}}</h2>
    <a href="{{url()->previous()}}" class="btn btn-white border mb-3">Volver atras</a>
    <section class="d-flex justify-content-center table-responsive">
        <table class="col-9 text-center table table-bordered table-striped table-hover">
            <thead class="align-middle">
                <tr>
                    <th rowspan="2">COLOR</th>
                    <th colspan="5">STOCK</th>
                    <th rowspan="2">MODIFICAR</th>
                </tr>
                <tr>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                    <th>XXL</th>
                </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($stock as $item)
            
                <tr>
                    <td>{{$item->color}}</td>
                    <td>{{$item->S}}</td>
                    <td>{{$item->M}}</td>
                    <td>{{$item->L}}</td>
                    <td>{{$item->XL}}</td>
                    <td>{{$item->XXL}}</td>
                    <td><a href="{{route('stock.edit', $item->id)}}" class="btn btn-warning">Modificar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    <section class="text-center mb-3">
        <a href="{{route('stock.create', $producto->id)}}" class="btn btn-primary col-7">Agregar Stock</a>
    </section>
@endsection