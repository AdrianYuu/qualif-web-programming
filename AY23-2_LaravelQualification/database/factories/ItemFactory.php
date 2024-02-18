<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($this->faker));
        $this->faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($this->faker));

        return [
            'name' => $this->faker->foodName(),
            'category_id' => 1,
            'price' => $this->faker->numberBetween(15000, 75000),
            'description' => $this->faker->realText(200),
            'image_url' => 'images/' . $this->faker->image(public_path('storage/images'), 500, 500, ['food'], false),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
