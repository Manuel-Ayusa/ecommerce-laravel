<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Orders_cliente;
use App\Models\Orders_envio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function pay(Order $order, Request $request)
    {   
        if ($request['collection_id'] == 1) {
            $payment_id = $order->payment_id;
        } else {
            $payment_id = $request->get('payment_id');
        }

        

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-1685174040409763-051515-093822d05ab413a9c3af3cedabc3ed8e-1815171712");

        $response = json_decode($response);

        $status = $response->status;
        
        $order->payment_id = $payment_id;

        if ($status == 'approved') {
            $order->estado_pago = 'Aprobado';
            $order->estado_entrega = 'En la tienda';

            $cart = $order->carrito; 
            $cart->estado = 'Inactivo';
            $items = $cart->productos;

            foreach ($items as $item) {
                $color = $item->color;
                $talle = $item->talle;
                $producto = $item->productoInfo;
                $stock = $producto->stock->where('color', $color)->first();
                $stock->$talle -= $item->cantidad;

                $stock->save();
            }

            $cart->save();

        } elseif ($status == 'in_process') {
            $order->estado_pago = 'Pendiente';
        }

        $order->save();

        return redirect()->route('order.pedidos');
    }

    /**
     * Display a listing of the resource.
     */

    public function checkout()
    {
        $ordersSinActualizar = Order::where('payment_id', '!=', '-')->get();
        $request = new Request();
        
        if (!empty($ordersSinActualizar[0])) {
            foreach ($ordersSinActualizar as $order) { //actualiza el estado de las ordenes
                $request['collection_id'] = 1;
                $this->pay($order, $request);
                $orders[] = $order;
            }
        } else {
            $orders = [];
        }
        
        return view('orders.admin.checkout', compact('orders'));
    }

    public function pedidos()
    {  
        if (auth()->check()) {
            session(['id_user_cart' => auth()->id()]);
        } else {
            session(['id_user_cart' => request()->ip()]);
        }

        $orders = [];

        $carts = Cart::where('user_id', session('id_user_cart'))->where('estado', 'Inactivo')->get();
        $request = new Request();
        
        foreach ($carts as $cart) { //actualiza el estado de las ordenes
            $request['collection_id'] = 1;
            $order = $cart->orden;
            if ($order->payment_id != '-') {
                $this->pay($order, $request);    
                $orders[] = $order;
            }
        }

        return view('orders.checkout', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            session(['id_user_cart' => auth()->id()]);
        } else {
            session(['id_user_cart' => request()->ip()]);
        }

        $cart = Cart::where('user_id', session('id_user_cart'))->where('estado', 'Activo')->first();
        $cart_id = $cart->id;
        $total = Cart::total();

        return view('orders.create', compact('cart_id', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'entrega' => 'required',
            'costoEnvio' => 'required',
            'costoCarrito' => 'required', 
            'nomApe' => 'required',  
            'email' => 'required', 
            'DNI' => 'required',
        ]);

        if ($request->entrega == 'Envio') {
            $request->validate([
                'provincia' => 'required',
                'localidad' => 'required',
                'calle' => 'required',
                'numero' => 'required',
                'CP' => 'required',    
            ]);
        }

        $order = new Order;
        $order->cart_id = $request->cart_id;
        if ($request->entrega == 'Envio') {
            $order->total = $request->costoCarrito + $request->costoEnvio;
        } else {
            $order->total = $request->costoCarrito;
        }
        
        $order->subtotal = $request->costoCarrito;
        $order->entrega = $request->entrega;
        $order->payment_id = '-';
        $order->estado_pago = '-';
        $order->estado_entrega = '-';

        $order->save();

        $order_id = Order::where('cart_id', $request->cart_id)->orderBy('id', 'desc')->first();
        $order_id = $order_id->id;
        $order_cliente = new Orders_cliente();
        $order_cliente->nombre_apellido = $request->nomApe;
        $order_cliente->email = $request->email;
        $order_cliente->DNI = $request->DNI;
        $order_cliente->order_id = $order_id;

        $order_cliente->save();

        if ($request->entrega == 'Envio') {
            $order_envio = new Orders_envio();
            $order_envio->calle = $request->calle;
            $order_envio->numero = $request->numero;
            $order_envio->provincia = $request->provincia;
            $order_envio->localidad = $request->localidad;
            $order_envio->CP = $request->CP;
            $order_envio->costo = $request->costoEnvio;
            $order_envio->order_id = $order_id;

            $order_envio->save();
        }

        return redirect()->route('order.show', $order_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $cart = $order->carrito;
        $items = $cart->productos;

        return view('orders.show', compact('items', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
