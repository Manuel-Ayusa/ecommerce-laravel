<?php
    use App\Models\Cart;
?>
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
            <aside id="sidebar" @if (URL::previous() == "http://tienda-ropa.test/login") class="active text-center text-white border-end " @else class="text-center text-white border-end" @endif>
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

        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
            <section class="container-fluid">
                <h1 class="col-2 fs-1"><a href="/" class="nav-link">InduTuc</a></h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <section class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-xl-center " id="menu-items-principal">
                        <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                        <li class="nav-item ps-xl-5"><a class="nav-link" href="{{route('productos.index')}}">Productos</a></li>
                        <li class="nav-item dropdown ps-xl-5"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Remeras')}}">Remeras</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Musculosas')}}">Musculosas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Pantalones')}}">Pantalones</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Shorts y Bermudas')}}">Shorts/Bermudas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Buzos')}}">Buzos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('productos.show', 'Camperas')}}">Camperas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ps-xl-5"><a class="nav-link" href="#">Acerca De</a></li>
                        <li class="nav-item fs-4" id="cart"><a class="nav-link bi-cart text-success" href="{{route('carrito.checkout')}}">{{Cart::items();}}</a></li>
                        <li class="nav-item fs-6 compras"><a class="nav-link" href="{{route('order.pedidos')}}">Mis Compras</a></li>
                    </ul>
                    @if (Route::has('login'))
                            @auth
                                <li class="nav-item session borde ps-2 fs-6 "><a href="{{route('profile.edit')}}" class="nav-link bi-person">Perfil</a>
                                <li class="nav-item session fs-6"><form method="POST" action="{{ route('logout') }}">
                                        @csrf
                    
                                        <x-responsive-nav-link class="nav-link bi-arrow-bar-left" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item session borde fs-6"><a
                                    href="{{ route('login') }}"
                                    class="nav-link transition p-2 bi-person"
                                >
                                    Iniciar Sesion
                                </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item session fs-6"><a
                                        href="{{ route('register') }}"
                                        class="nav-link transition p-2 bi-arrow-bar-right"
                                    >
                                        Registrarse
                                    </a>
                                    </li>
                                @endif
                            @endauth
                    @endif
                </section>
            </section>
        </nav>

        <main>
            @yield('content')
        </main>
        <footer class="text-center bg-dark p-4 text-white m-0">
            <!-- footer -->
            <p class="pt-2">©Copyright - Ayusa Manuel Alejandro | Programador</p>
        </footer>
        <!-- script -->
        <script src="{{asset('js/miarchivo.js')}}"></script>
        <script src="{{asset('js/galeria.js')}}"></script>
        <script src="{{asset('js/sidebar.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </section> 
</body>
</html>