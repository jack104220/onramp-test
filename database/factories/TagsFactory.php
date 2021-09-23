<?php

namespace Database\Factories;

use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class TagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tags::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d H:i:s');

        return [
            'name' => $this->faker->name(),
            'object_id' => $this->faker->numerify('AW-###########'),
            'content' => $this->faker->sentence(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
