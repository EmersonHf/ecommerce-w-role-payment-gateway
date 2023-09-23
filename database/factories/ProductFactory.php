<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as ModelsRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'cover' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(2,1,1000),
            'role_id' => Role::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->randomDigit(),
        ];
    }
}
