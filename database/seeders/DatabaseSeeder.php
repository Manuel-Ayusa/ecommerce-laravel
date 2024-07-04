<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Producto_stock;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Manuel Ayusa',
            'email' => 'ayusa@gmail.com',
            'password' => 'ayusa@gmail.com',
            'admin' => 1,
        ]);

        Producto::factory()->create([
            'name' => 'Remera Basica',
            'categoria' => 'Remeras', 
            'descripcion' => 'Remera basica de algodon peinado. Excelente calidad.', 
            'precio' => 10000.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Azul',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/azul_lisa1-949676ed82f6cf86ab15560313247436-640-0.png',
            'producto_id' => 1,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Blanca',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/remera-adulto-unisex-blanca-sublimable.jpg',
            'producto_id' => 1,
        ]);

        Producto::factory()->create([
            'name' => 'Remera Oversize - Estampada',
            'categoria' => 'Remeras', 
            'descripcion' => 'Remera oversize estampada de algodon peinado.', 
            'precio' => 15000.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Blanco',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/Oversize-SV-blanco-3-650x1156.jpg',
            'producto_id' => 2,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Rosa',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/1719242058-Oversize-SV-rosa-3-650x1156.jpg',
            'imagen2' => 'images/productos/1719242059-Oversize-SV-rosa-2-650x1156.jpg',
            'producto_id' => 2,
        ]);

        Producto::factory()->create([
            'name' => 'Bermuda Gabardina',
            'categoria' => 'Shorts y Bermudas', 
            'descripcion' => 'Bermuda Gabardina Hombre de la marca Michigan es la elección perfecta para los hombres que buscan comodidad y estilo en una prenda. Con su modelo de corte chino, ésta bermuda se adapta a cualquier ocasión, ya sea para un look casual o más formal. Está confeccionada en gabardina elastizada, lo que garantiza un ajuste perfecto y una gran durabilidad. Su tiro medio y su diseño de bermuda la hacen ideal para la temporada de Primavera/Verano. ', 
            'precio' => 25000.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Beige',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/bermudaGabardina.webp',
            'imagen2' => 'images/productos/b-g2.webp',
            'producto_id' => 3,
        ]);

        Producto::factory()->create([
            'name' => 'Bermuda Jens',
            'categoria' => 'Shorts y Bermudas', 
            'descripcion' => 'Bermuda Mom de jeans. Excelente calidad.', 
            'precio' => 18500.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Azul Claro',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/bj.webp',
            'imagen2' => 'images/productos/bj-1.webp',
            'producto_id' => 4,
        ]);

        Producto::factory()->create([
            'name' => 'Pantalon Cargo',
            'categoria' => 'Pantalones', 
            'descripcion' => 'Pantalon cargo gabardina.', 
            'precio' => 22800.00,
            'destacado' => 1,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Negro',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/cargoNegro.webp',
            'imagen2' => 'images/productos/cargoNegro2.webp',
            'producto_id' => 5,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Verde Militar',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/cargoVerde.webp',
            'imagen2' => 'images/productos/cargoVerde2.webp',
            'producto_id' => 5,
        ]);

        Producto::factory()->create([
            'name' => 'Pantalon Jeans',
            'categoria' => 'Pantalones', 
            'descripcion' => 'Pantalon de jeans. Excelente calidad.', 
            'precio' => 18500.00,
            'destacado' => 1,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Azul Claro',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/jeansHombre.webp',
            'producto_id' => 6,
        ]);

        Producto::factory()->create([
            'name' => 'Musculosa Basica',
            'categoria' => 'Musculosas', 
            'descripcion' => 'Musculosa Basica de algodon. Excelente calidad.', 
            'precio' => 15800.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Blanca',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/mBBlanca.webp',
            'producto_id' => 7,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Negra',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/musculosaBasicaNegra.webp',
            'producto_id' => 7,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Naranja',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/mBNaranja.webp',
            'producto_id' => 7,
        ]);

        Producto::factory()->create([
            'name' => 'Buzo Cuello Redondo Gris',
            'categoria' => 'Buzos', 
            'descripcion' => 'Buzo de algodon. Excelente calidad.', 
            'precio' => 25500.00,
            'destacado' => 1,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Gris',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/buzoCuelloU.png',
            'producto_id' => 8,
        ]);

        Producto::factory()->create([
            'name' => 'Buzo Canguro Basico',
            'categoria' => 'Buzos', 
            'descripcion' => 'Buzo Basico de algodon con bolsillos adelante. Excelente calidad.', 
            'precio' => 15800.00,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Lila',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/cangurolila.jpg',
            'producto_id' => 9,
        ]);

        Producto::factory()->create([
            'name' => 'Buzo Oversize Essentials Azul',
            'categoria' => 'Buzos', 
            'descripcion' => 'Buzo Basico de algodon con bolsillos adelante. Excelente calidad.', 
            'precio' => 15800.90,
            'destacado' => 0,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Azul',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/canguroAzul.webp',
            'producto_id' => 10,
        ]);

        Producto::factory()->create([
            'name' => 'Campera Fergus',
            'categoria' => 'Camperas', 
            'descripcion' => 'Campera Fergus rompeviento. Excelente calidad.', 
            'precio' => 15800.00,
            'destacado' => 1,
        ]);

        Producto_stock::factory()->create([
            'color' => 'Azul con naranja',
            'S' => 30,
            'M' => 20,
            'L' => 10,
            'XL' => 15,
            'XXL' => 10,
            'imagen1' => 'images/productos/Campera-de-hombre-Fergus-Azul-metal-montagne-1.webp',
            'producto_id' => 11,
        ]);
    }
}
