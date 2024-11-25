@extends('layouts.plantilla_admin')

@section('title', 'Agregar Producto')

@section('content')
    <h2 class="p-0 py-3 m-0 text-center display-5 border-bottom mb-3">Agregar Producto</h2>
    <a href="{{url()->previous()}}" class="btn btn-white border mb-3">Volver atras</a>

    <section class="d-flex justify-content-center">
        <form action="{{route('stock.store')}}" method="post" enctype="multipart/form-data" class="col-5 border p-3 rounded">
            
            @csrf

            <section class="pt-0">
                <label for="nomb">Nombre</label>
                <input type="text" name="name" id="nomb" value="{{$producto->name}}" class="form-control" readonly>
            </section>

            @error('name')
                {{'*' . $message }}
            @enderror

            <section>
                <label for="cat">Categoria</label>
                <input type="text" name="categoria" id="cat" value="{{$producto->categoria}}" class="form-control" readonly>
            </section>

            @error('Categoria')
                {{'*' .  $message }}
            @enderror

            <section>
                <label for="desc">Descripcion</label>
                <textarea name="descripcion" id="desc" cols="30" rows="10" maxlength="500" class="form-control" readonly>{{$producto->descripcion}}</textarea>
            </section>

            @error('descripcion')
                {{'*' .  $message }}
            @enderror

            <section>
                <label for="pre">Precio Unitario</label>
                <input type="number" name="precio" id="pre" step="0.05" value="{{$producto->precio}}" class="form-control" readonly>
            </section>

            @error('precio')
                {{'*' .  $message }}
            @enderror

            <fieldset>
                <legend class="pt-3">Stock</legend>
                <p>Porfavor llene atentamente todos los campos.</p>
            @foreach ($stock as $item)
            <fieldset class="mt-2 p-2 border rounded bg-light">
                <section class="pt-0">
                    <label for="col">Color</label>
                    <input type="text" name="" id="col" value="{{$item->color}}" class="form-control" readonly>
                </section>
                <section>
                    <label for="talS">S:</label>
                    <input type="number" name="" id="talS" value="{{$item->S}}" class="form-control" readonly>
                </section>
                <section>
                    <label for="talM">M:</label>
                    <input type="number" name="" id="talM" value="{{$item->M}}" class="form-control" readonly>
                </section>
                <section>
                    <label for="talL">L:</label>
                    <input type="number" name="" id="talL" value="{{$item->L}}" class="form-control" readonly>
                </section>
                <section>
                    <label for="talXL">XL:</label>
                    <input type="number" name="" id="talXL" value="{{$item->XL}}" class="form-control" readonly>
                </section>
                <section>
                    <label for="talXXL">XXL:</label>
                    <input type="number" name="" id="talXXL" value="{{$item->XXL}}" class="form-control" readonly>
                </section>
            </fieldset>
            @endforeach

                <fieldset class="mt-2 p-2 border rounded">
                    <legend>Nuevo Color</legend>
                    <section class="pt-0">
                        <label for="col">Color</label>
                        <input type="text" name="color" id="col" value="{{old('color')}}"class="form-control">
                    </section>
                    @error('color')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    @error('XXL')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="talS">S:</label>
                        <input type="number" name="S" id="talS" value="{{old('S')}}"class="form-control">
                    </section>
                    @error('S')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="talM">M:</label>
                        <input type="number" name="M" id="talM" value="{{old('M')}}"class="form-control">
                    </section>
                    @error('M')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="talL">L:</label>
                        <input type="number" name="L" id="talL" value="{{old('L')}}"class="form-control">
                    </section>
                    @error('L')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="talXL">XL:</label>
                        <input type="number" name="XL" id="talXL" value="{{old('XL')}}"class="form-control">
                    </section>
                    @error('XL')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="talXXL">XXL:</label>
                        <input type="number" name="XXL" id="talXXL" value="{{old('XXL')}}"class="form-control">
                    </section>
                    @error('XXL')
                    {{'* Este campo es obligatorio'}}
                    @enderror
                    <section>
                        <label for="img1">Foto 1:</label>
                        <input type="file" name="ft1" id="img1" class="form-control">
                    </section>
                    @error('ft1')
                    {{'* Este campo es obligatorio' }}
                    @enderror 
                    <section>
                        <label for="img2">Foto 2:</label>
                        <input type="file" name="ft2" id="img2" class="form-control">
                    </section>
                    @error('ft1')
                    {{'* Este campo es obligatorio' }}
                    @enderror
                    <section>
                        <label for="img3">Foto 3:</label>
                        <input type="file" name="ft3" id="img3" class="form-control">
                    </section>
                    @error('ft1')
                    {{'* Este campo es obligatorio' }}
                    @enderror
                </fieldset>

            </fieldset> 
            <input type="hidden" name="productoId" value="{{$producto->id}}">

            <input type="submit" class="form-control mt-2 btn btn-success" value="Guardar Color">
            
            <a href="{{route('productos.administrar')}}"><input type="button" value="Finalizar y Guardar Todo" class="mt-3 form-control btn btn-primary"></a>
        </form>
    </section>
@endsection