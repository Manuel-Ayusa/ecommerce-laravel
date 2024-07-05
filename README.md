<h1>Ecommerce Tienda De Ropa</h1>
Ecommerce desarrollado en el Framework Laravel.
<h2>Sobre el sitio</h2>
El mismo se trata de una tienda de ropa con todas las funciones que un ecommerce debe tener: carrito de compras, inicio de sesion opcional, una pasarella de pago intuitiva etc.<br>
En este caso, la tienda esta configurada para ser una tienda de ropa solamente de hombre, pero se puede configurar como uno desee.

<h2>Detalles Tecnicos</h2>
<h3>General</h3>
Se siguieron las practicas recomendadas por la documentacion oficial de Laravel, como ser: la sintaxis, el uso adecuado de las funciones del programa, el uso adecuado del motor de plantillas Blade etc.<br>
El sitio posee una interfaz para el cliente y una interfaz distinta para el Usuario <b>Administrador</b>.<br>
El sitio es totalmente responsivo para el cliente y para el Usuario Administrador, aunque para este ultimo se recomienda usar la version de computadora.
<h3>Rutas</h3>
Para un codigo mas ordenado y con mayor legibilidad se utiliza el route Controller para las rutas que pertenecen al mismo controlador.
Se utiliza un middleware adicional escrito por mi, para denegar el acceso a determinadas rutas a usuarios NO Administradores.
<h3>Vistas</h3>
Se utiliza el motor de plantillas Blade.
<h3>Autenticacion</h3>
Se utiliza el kit de inicio Laravel Brezee que incluye inicio de sesión, registro, restablecimiento de contraseña, verificación de correo electrónico y confirmación de contraseña.
<h3>Base de Datos</h3>
Se utiliza Eloquent para administrar la BD, cada tabla de la base de datos tiene un "modelo" correspondiente que se utiliza para interactuar con esa tabla. Además de recuperar registros de la tabla de la base de datos, los modelos de Eloquent también le permiten insertar, actualizar y eliminar registros de la tabla.<br>
La BD utilizada en el sitio es relacional. La misma se relaciona a travez de sus modelos con metodos escritos dentro de estos(para esto se utlizan funciones brindadas por Laravel).
<h3>Pasarela de Pago</h3>
Para realizar y procesar los pagos se utiliza el SDK de Mercado Pago, Checkaut Pro. Mas informacion sobre Chekaut Pro 

<h3>Productos y Stock</h3>
Los Productos se guardan en la tabla "productos"(*imagen1) y (*imagen1.1). Cada producto puede tener uno o mas colores y con ellos su respectivo Stock(*imagen2) y (*imagen2.2). <br> 
(*imagen1) <br>

![Captura de pantalla 2024-07-05 114708](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/fff4161b-f775-40b2-a7a5-41928ee2ef2e) <br>Base de Datos<br><br>

(*imagen1.1) <br>

![Captura de pantalla 2024-07-05 120030](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/f4364ccb-ef34-487c-a3a9-9a0e41c005d7) <br>Vista de administrador<br><br>


(*imagen2) <br>

![Captura de pantalla 2024-07-05 114733](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/3f4c6f18-7425-4ac2-bf9f-00d3dcab0150) <br>Base de Datos<br><br>

(*imagen2.2) <br>

![Captura de pantalla 2024-07-05 120119](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/bb4b52e8-2dd3-4bcd-b165-47713b64f660) <br>Al Seleccionar <b>Guardar</b> en(*imagen1.1) se desplega automaticamente el formulario para cargar uno o mas colores. 


<h2>Como funciona el Carrito de Compras</h2>
Cada usuario que entra al sitio queda registrado en la Base de Datos, en la tabla "sessions", con el numero de IP del navegador; En caso de que el usuario no haya iniciado sesion en nuestro sitio, este registro nos ayuda a relacionar a cada usuario con su carrito.
Cuando el usuario añade su primer Articulo al carrito se crea un registro en la tabla "carts"(*imagen1), cuando este es creado, al instante se crea otro registro en la tabla "cart_productos" donde se guardan los registros con los detalles del item(*imagen2) esta tabla su vez guarda las llaves foraneas(<b>cart_id </b> y <b>producto_id</b>).<br> <br>
(*imagen1). ()<br>

![Captura de pantalla 2024-07-05 103523](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/33064125-54c6-4152-ad78-71d1a7228316) <br>
En el primer registro se muestra un usuario no logueado en el sitio y en el segundo registro un usuario que si ha iniciado sesion. <br> <br> 
(*imagen2)<br>

![Captura de pantalla 2024-07-05 105755](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/a31c33b1-416e-413b-8a30-cfcfe2509ae8) <br> <br>
Una vez que se añadio el primer producto, al añadir otros, solo se crean registros en la tabla "cart_productos" relacionados al carrito del cliente(una relacion de muchos a uno)(*imagen3). <br>
(*imagen3). <br>

![Captura de pantalla 2024-07-05 113226](https://github.com/Manuel-Ayusa/ecommerce-laravel/assets/166891950/b9c2ad8e-506d-4b3e-a159-776907924eb8)

 
<h2>Como funcionan las Compras</h2>
Para hacer una compra se puede estar logueado en el sitio o no.
Bien, primero que todo se debe añadir uno o mas objetos al carrito(no se puede añadir un producto al carrito si no hay stock de este). Luego, ya en la vista del carrito, se muestra todo su contenido y los detalles de los productos como ser la cantidad de los mismos, el talle, precio etc.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
