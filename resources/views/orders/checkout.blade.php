@extends('layouts.plantilla')

@section('title', 'Pedidos')

@section('content')

    <section class="d-flex flex-column aling-middle align-items-center text-center">
        <h2 class="mt-3">Mis Compras</h2>
        @if (!empty($orders[0]))
            @auth
            <section class="col-xl-7 border rounded text-center compra p-2 bg-primary">
                <h4 class="text-white">Cliente</h4>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover table-info">
                        <thead class="align-middle">
                            <th>Nombre y Apellido</th>
                            <th>DNI</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            <td>{{$orders[0]->cliente->nombre_apellido}}</td>
                            <td>{{$orders[0]->cliente->DNI}}</td>
                            <td>{{$orders[0]->cliente->email}}</td>        
                        </tbody>    
                    </table>
                </section> 
            </section>
            @endauth
           
            @foreach ($orders as $order)
            <article class="border rounded p-2 m-1 col-xl-7 compra">
                <h3 class="border-bottom pb-2">Pedido #{{$order->id}}</h3>
                @if (!auth()->check())
                <h4>Cliente</h4>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover table-info">
                        <thead class="align-middle">
                            <tr>
                            <th>Nombre y Apellido</th>
                            <th>DNI</th>
                            <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>{{$order->cliente->nombre_apellido}}</td>
                            <td>{{$order->cliente->DNI}}</td>
                            <td>{{$order->cliente->email}}</td>
                        </tr>        
                        </tbody>    
                    </table> 
                </section>
            @endif
                <h4>Productos</h4>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover">
                        <thead class="align-middle">
                            <tr>
                            <th>Producto</th>
                            <th>Color</th>
                            <th>Talle</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->carrito->productos as $producto)
                            <tr>
                                <td>{{$producto->productoInfo->name}}</td>
                                <td>{{$producto->color}}</td>
                                <td>{{$producto->talle}}</td>
                                <td>${{number_format($producto->productoInfo->precio, 2, ',', '.')}}</td>
                                <td>{{$producto->cantidad}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                @if ($order->entrega == 'Envio')
                    <h4>Detalles de Envio</h4>
                    <section class="table-responsive">
                        <table class="text-center table table-bordered table-striped table-hover">
                            <thead class="align-middle">
                                <tr>
                                <th>Calle</th>
                                <th>Numero</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>Codigo Postal</th>
                                <th>Costo de Envio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>{{$order->envio->calle}}</td>
                                <td>{{$order->envio->numero}}</td>
                                <td>{{$order->envio->localidad}}</td>
                                <td>{{$order->envio->provincia}}</td>
                                <td>{{$order->envio->CP}}</td>
                                <td>${{number_format($order->envio->costo, 2, ',', '.')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                @else 
                    <section class="text-center bg-light border p-2 mb-3">
                        <h4>Entrega</h4>
                        <p class="mb-0 pb-0">Retira en tienda.</p>
                    </section>   
                @endif
                <h4>Resumen y Estado de la Compra</h4>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Estado del Pago</th>
                            <th>Estado de Entrega</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>${{number_format($order->subtotal, 2, ',', '.')}}</td>
                            <td>${{number_format($order->total, 2, ',', '.')}}</td>
                            <td>{{$order->estado_pago}}</td>
                            <td>{{$order->estado_entrega}}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </article>
            @endforeach
       @endif
    </section>
@endsection