@extends('layouts.plantilla_admin')

@section('title', 'Agregar Producto')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center fs-2 border-bottom mb-3">Modificar Producto: {{$producto->name}}</h2>
    <a href="{{route('productos.administrar')}}" class="btn btn-white border mb-3">Volver atras</a>
    <section class="d-flex justify-content-center">
        <form action="{{route('productos.update', $producto->id)}}" method="post" enctype="multipart/form-data" class="col-5 border p-3 rounded">
            
            @csrf
            @method('patch')
            <section class="pt-0">
                <label for="nomb">Nombre</label>
                <input type="text" name="name" id="nomb" value="{{$producto->name}}" class="form-control">
            </section>

            <section>
                <label for="cat">Categoria</label>
                <input type="text" name="categoria" id="cat" value="{{$producto->categoria}}" class="form-control">
            </section>

            <section>
                <label for="desc">Descripcion</label>
                <textarea name="descripcion" id="desc" cols="30" rows="10" maxlength="500" class="form-control">{{$producto->descripcion}}</textarea>
            </section>

            <section>
                <label for="pre">Precio Unitario</label>
                <input type="number" name="precio" id="pre" step="0.05" value="{{$producto->precio}}" class="form-control">
            </section>

            <section>
                <label for="ft1">1° Foto:</label>
                <input type="file" name="ft1" id="ft1" value="{{$producto->imagen1}}" class="form-control">
         
            <section>
                <label for="ft2">2° Foto &#10098;opcional&#10099; :</label>
                <input type="file" name="ft2" id="ft2" value="{{$producto->imagen2}}" class="form-control">
            </section>

            <section class="text-center">
                <input type="submit" value="Actualizar y Guardar" class="mt-3 form-control btn btn-primary">
            </section>
        </form>
    </section>
@endsection