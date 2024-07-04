<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'categoria' => $this->faker->randomElement(['Remeras', 'Pantalones', 'Shorts y Bermudas', 'Musculosas', 'Buzos', 'Camperas']), 
            'descripcion' => $this->faker->paragraph(), 
            'precio' => $this->faker->randomNumber(4),
            'destacado' => $this->faker->boolean()
        ];
    }
}
