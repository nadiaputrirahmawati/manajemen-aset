<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'code' => 'R-' . strtoupper(fake()->unique()->lexify('???-##')),
            'floor' => fake()->numberBetween(1, 5),
            'pic_name' => fake()->name(),
        ];
    }
}
