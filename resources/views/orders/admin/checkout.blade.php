@extends('layouts.plantilla_admin')

@section('title', 'Pedidos')

@section('content')

    <section class="d-flex flex-column aling-middle align-items-center text-center">
        <h2 class="p-0 py-3 m-0 text-center display-5 border-bottom mb-3 col-12">Todas las Ordenes</h2>
        @if (!empty($orders[0]))
            @foreach ($orders as $order)
            <article class="border rounded p-2 m-1 col-7 bg-info mb-4">
                <h3 class="border-bottom pb-2">Pedido #{{$order->id}}</h3>
                <h4>Cliente</h4>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover">
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
                                <td>${{$producto->productoInfo->precio}}</td>
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
                                <td>${{$order->envio->costo}}</td>
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
                            <td>${{$order->subtotal}}</td>
                            <td>${{$order->total}}</td>
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