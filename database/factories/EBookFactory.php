<?php

namespace Database\Factories;

use App\Models\EBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class EBookFactory extends Factory
{
    protected $model = EBook::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'author' => $this->faker->name,
            'file_url' => $this->faker->url,
            'cover_image_url' => $this->faker->url,
            'published_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
