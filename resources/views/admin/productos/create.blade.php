@extends('layouts.plantilla_admin')

@section('title', 'Agregar Producto')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center display-5 border-bottom mb-3">Agregar Producto</h2>
    <a href="{{url()->previous()}}" class="btn btn-white border mb-3">Volver atras</a>
    <section class="d-flex justify-content-center">
        <form action="{{route('productos.store')}}" method="post" enctype="multipart/form-data" class="col-5 border p-3 rounded">
            
            @csrf

            <section class="pt-0">
                <label for="nomb">Nombre</label>
                <input type="text" name="name" id="nomb" value="{{old('name')}}" class="form-control">
            </section>

            @error('name')
                {{'*' . $message }}
            @enderror

            <section>
                <label for="cat">Categoria</label>
                <select name="categoria" id="cat" class="form-control">
                    <option value="" selected disabled>Elija una opcion</option>
                    <option value="Remeras">Remeras</option>
                    <option value="Pantalones">Pantalones</option>
                    <option value="Musculosas">Musculosas</option>
                    <option value="Shorts y Bermudas">Shorts y Bermudas</option>
                    <option value="Buzos">Buzos</option>
                    <option value="Camperas">Camperas</option>
                </select>
                {{-- <input type="text" name="categoria" id="cat" value="{{old('categoria')}}" class="form-control"> --}}
            </section>

            @error('Categoria')
                {{'*' .  $message }}
            @enderror

            <section>
                <label for="desc">Descripcion</label>
                <textarea name="descripcion" id="desc" cols="30" rows="10" maxlength="500" class="form-control">{{old('descripcion')}}</textarea>
            </section>

            @error('descripcion')
                {{'*' .  $message }}
            @enderror

            <section>
                <label for="pre">Precio Unitario</label>
                <input type="number" name="precio" id="pre" step="0.05" value="{{old('precio')}}" class="form-control">
            </section>

            @error('precio')
                {{'*' .  $message }}
            @enderror

            <section class="text-center">
                <input type="submit" value="Guardar" class="mt-3 form-control btn btn-primary">
            </section>
        </form>
    </section>
@endsection