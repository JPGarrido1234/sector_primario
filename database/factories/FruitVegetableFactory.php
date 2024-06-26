<?php

namespace Database\Factories;

use App\Models\FruitVegetable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FruitVegetable>
 */
class FruitVegetableFactory extends Factory
{
    protected $model = FruitVegetable::class;

    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        $type = $this->faker->randomElement(['fruit', 'vegetable']);
        $name = $type === 'fruit' ? $this->faker->fruitName() : $this->faker->vegetableName();
        return [
            'name' => $name,
            'image_url' => 'https://via.placeholder.com/150',
            'tipo' => $type,
            'descripcion' => $this->faker->sentence(),
            'precio_unidad' => $this->faker->randomFloat(2, 0.1, 10),
        ];
    }
}
