@extends('layouts.plantilla_admin')

@section('title', 'Agregar Producto')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center fs-2 border-bottom mb-3">Modificar Stock del Producto: {{$name}}</h2>
    <a href="{{url()->previous()}}" class="btn btn-white border mb-3">Volver atras</a>
    <section class="d-flex justify-content-center">
        <form action="{{route('stock.update', $item->id)}}" method="post" enctype="multipart/form-data" class="col-5 border p-3 rounded">
            
            @csrf
            @method('patch')

            <fieldset class="mt-2 p-2 border rounded">
                <section class="pt-0">
                    <label for="col">Color</label>
                    <input type="text" name="color" id="col" value="{{$item->color}}" class="form-control">
                </section>
                <section>
                    <label for="talS">S:</label>
                    <input type="number" name="S" id="talS" value="{{$item->S}}" class="form-control">
                </section>
                <section>
                    <label for="talM">M:</label>
                    <input type="number" name="M" id="talM" value="{{$item->M}}" class="form-control">
                </section>
                <section>
                    <label for="talL">L:</label>
                    <input type="number" name="L" id="talL" value="{{$item->L}}" class="form-control">
                </section>
                <section>
                    <label for="talXL">XL:</label>
                    <input type="number" name="XL" id="talXL" value="{{$item->XL}}" class="form-control">
                </section>
                <section>
                    <label for="talXXL">XXL:</label>
                    <input type="number" name="XXL" id="talXXL" value="{{$item->XXL}}" class="form-control">
                </section>
                <section>
                    <label for="img1">Foto 1:</label>
                    <input type="file" name="ft1" id="img1" value="{{$item->ft1}}" class="form-control">
                </section>
            </fieldset>
            <input type="hidden" name="productoId" value="{{$item->producto->id}}">
            <input type="submit" class="form-control mt-2 btn btn-success" value="Actualizar y guardar">
            
        </form>
    </section>
@endsection