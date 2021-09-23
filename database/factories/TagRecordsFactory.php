<?php

namespace Database\Factories;

use App\Models\TagRecords;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Consts\ActionConst;
use App\Consts\TypeConst;

class TagRecordsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagRecords::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d H:i:s');

        return [
            'object_id' => $this->faker->numerify('AW-###########'),
            'session_id' => $this->faker->uuid(),
            'action' => $this->faker->numberBetween(0, 2),
            'type' => $this->faker->numberBetween(0, 2),
            'value' => $this->faker->randomFloat(2, 0, 300),
            'currency' => $this->faker->currencyCode(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
