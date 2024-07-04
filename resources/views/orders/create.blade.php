@extends('layouts.plantilla')

@section('title', 'Orden de Compra')

@section('content')
    <h3 class="text-center pt-3 pb-3 border-bottom">Detalles de Compra</h3>

    <section class="d-flex justify-content-center mb-2">
    <form action="{{route('order.store')}}" method="POST" class="col-6">
        @csrf
        @if (Auth::check())
            <fieldset>
                <legend><b>Datos del Comprador</b></legend>
                <label for="nomApe">Nombre y Apellido</label>
                <input type="text" name="nomApe" id="nomApe" value="{{auth()->user()->name}}" readonly class="form-control"> 
                @error('nomApe')
                    {{'* Este campo es obligatorio.'}}
                @enderror
                <label for="email" class="pt-2">Email</label>
                <input type="email" name="email" id="email" value="{{auth()->user()->email}}" readonly class="form-control">
                @error('nomApe')
                    {{'* El campo email es obligatorio.'}}
                @enderror
                <label for="dni" class="pt-2">DNI(sin puntos ni comas)</label>
                <input type="number" name="DNI" id="dni" value="{{old('DNI')}}" class="form-control">
                @error('DNI')
                    {{'* El campo DNI es obligatotio.'}}
                @enderror
            </fieldset>
        @else
            <fieldset>
                <legend><b>Datos del Comprador</b></legend>
                <label for="nomApe">Nombre y Apellido</label>
                <input type="text" name="nomApe" id="nomApe" class="form-control">
                <section class="text-danger">
                    @error('nomApe')
                        {{'* Este campo es obligatorio.'}}
                    @enderror
                </section>
                <label for="email" class="pt-2">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <section class="text-danger">
                    @error('email')
                        {{'* El campo email es obligatorio.'}}
                    @enderror
                </section class="text-danger">
                <label for="dni" class="pt-2">DNI(sin puntos ni comas)</label>
                <input type="number" name="DNI" id="dni" class="form-control">
                <section class="text-danger">
                    @error('DNI')
                        {{'* El campo DNI es obligatotio.'}}
                    @enderror
                </section>
            </fieldset>
        @endif
        <fieldset>
            <legend class="pt-2"><b>Entrega</b></legend>
            <section>
                <label for="ret">Retiro en tienda</label>
                <input type="radio" name="entrega" id="ret" value="Retiro en tienda">
            </section>
            <section>
                <label for="env">Envio</label>
                <input type="radio" name="entrega" id="env" value="Envio">
            </section>
            <section class="text-danger">
                @error('entrega')
                    {{'Seleccione una opcion de entrega.'}}
                @enderror
            </section>
        </fieldset>
        <input type="hidden" name="costoCarrito" id="preCarr" value="{{$total}}">
        <input type="hidden" name="costoEnvio" value="2000">
        <input type="hidden" name="cart_id" value="{{$cart_id}}">
        <section id="formEnv"></section>
        <h4 id="costoTotal" class="pt-2"><b>Total: ${{number_format($total, 2, ',', '.')}}</b></h4>
        <input type="submit" value="Comenzar Pago" class="btn btn-dark p-3">
    </form>
</section>
@endsection