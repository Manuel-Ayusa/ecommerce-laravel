@extends('layouts.plantilla')

@section('title', 'Orden de Compra')

@section('content')

    @php
        // SDK de Mercado Pago
        use MercadoPago\MercadoPagoConfig;
        use MercadoPago\Client\Preference\PreferenceClient;
        // Agrega credenciales
        MercadoPagoConfig::setAccessToken(config('services.mercadoPago.token'));

        if ($order->envio) {
            $envio = [
                    "cost" => $order->envio->costo,
                    "mode" => "not_specified",
            ];
        } else {
            $envio = [];
        }

        foreach ($items as $producto) {
            $productos[] = array(
                "title" => $producto->name,
                "quantity" => $producto->cantidad,
                "unit_price" => $producto->productoInfo->precio
            );
        } 

        $client = new PreferenceClient();
        $preference = $client->create([
            "items"=> $productos,
            "shipments" => $envio,
            "back_urls" => array(
                "success" => route('order.pay', $order->id),
                "failure" => route('order.show', $order->id),
                "pending" => route('order.pay', $order->id)
                ),
        ]);
        
    @endphp

    <section>
        <h2 class="p-3 border-bottom">Orden de Compra #{{$order->id}}</h2>
        <section class="col-xl-7 orden border rounded p-2">
            <h3 class="text-center p-2">Productos</h3>
            <section class="table-responsive">
                <table class="text-center table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Color</th>
                            <th>Talle</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item->productoInfo->name}}</td>
                            <td>{{$item->color}}</td>
                            <td>{{$item->talle}}</td>
                            <td>${{number_format($item->productoInfo->precio, 2, ',', '.')}}</td>
                            <td>{{$item->cantidad}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
            <h3 class="text-center p-2">Datos del Comprador</h3>
            <section class="table-responsive">
                <table class="text-center table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->cliente->nombre_apellido}}</td>
                            <td>{{$order->cliente->email}}</td>
                            <td>{{$order->cliente->DNI}}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            @if ($order->entrega == 'Envio')
                <h3 class="text-center p-2">Detalles de Envio</h3>
                <section class="table-responsive">
                    <table class="text-center table table-bordered table-striped table-hover">
                        <thead>
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
                <section class="text-center bg-light border p-2">
                    <h3>Entrega</h3>
                    <p class="mb-0 pb-0">Retira en tienda.</p>
                </section>   
            @endif
            <section class="text-center display-6 pt-3">
                <p>Productos: ${{number_format($order->subtotal, 2, ',', '.')}}</p>
                <p>Subtotal: ${{number_format($order->total, 2, ',', '.')}}</p>
            </section>
        </section>
        <section class="d-flex justify-content-center mt-2">
            <img src="{{asset('storage/images/tarjetas/visa.png')}}" alt="visa" class="mx-4 col-1">
            <img src="{{asset('storage/images/tarjetas/1-Mastercard-Logo.png')}}" alt="mastercard" class="mx-4 col-1">
            <img src="{{asset('storage/images/tarjetas/American_Express_logo_.png')}}" alt="americanExpress" class="mx-4 col-1">
        </section>
        <section class="d-flex flex-column justify-content-center align-items-center">
            <div id="wallet_container" class="col-xl-7">
            </div>
        </section>
    </section>

    <section>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        
        <script>
            const mp = new MercadoPago("{{config('services.mercadoPago.key')}}");
            const bricksBuilder = mp.bricks();

            mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: "{{ $preference->id }}",
                redirectMode: "self"
            },
            customization: {
                visual: {
                buttonBackground: 'black',
                borderRadius: '16px',
                },
                texts: {
                action: 'buy',
                valueProp: 'security_safety',
                },
                checkout: {
                theme: {
                    elementsColor: "#221",
                    headerColor: "#21212",
                },
                }
            },
            });
        </script>
    </section>
@endsection