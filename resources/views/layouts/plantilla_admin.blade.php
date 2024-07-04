<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
    
<body>
    @auth
        @if(Auth::user()->admin == 1)
            <aside id="sidebar" @if (URL::previous() == "http://tienda-ropa.test/login") class="active text-center text-white border-end" @else class="text-center text-white border-end" @endif>
                <section class="toggle-btn" id="sidebar-btn">
                    <span>&#9776</span>
                </section>
                <h1 class="display-4 m-0 p-2 bg-white text-dark">InduTuc</h1>
                <h3 class="pt-4">{{Auth::user()->name}}</h3>
                <p class="p-0 m-0 pb-4 border-bottom">Administrador</p>
                <ul class="m-0 p-0">
                    <li class="nav-item p-0 m-0"><a href="/" class="nav-link p-3">Vista de la Tienda</a></li>
                    <p class="m-0 pb-3 pt-3 border-bottom fs-5">Productos</p>
                    <li class="nav-item p-0 m-0"><a href="{{route('productos.create')}}" class="nav-link p-3">Agregar Producto</a></li>
                    <li class="nav-item p-0 m-0"><a href="{{route('productos.administrar')}}" class="nav-link m-0 p-3">Administrar Productos</a></li>
                    <p class="m-0 pb-3 pt-3 border-bottom fs-5">Ordenes/Compras</p>
                    <li class="nav-item p-0 m-0"><a href="{{route('order.checkout')}}" class="nav-link p-3">Ver todas las ordenes</a></li>
                </ul>
            </aside>
        @endif
    @endauth

    <section class="container-fluid p-0" id="contenido">
        <main>
            @yield('content')
        </main>
        <footer class="text-center bg-dark p-4 text-white">
            <!-- footer -->
            <p class="pt-3">©Copyright - Ayusa Manuel Alejandro | Programador </p>
        </footer>
        <!-- script -->
        <script src="{{asset('js/miarchivo.js')}}"></script>
        <script src="{{asset('js/galeria.js')}}"></script>
        <script src="{{asset('js/sidebar.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </section>
</body>
</html>