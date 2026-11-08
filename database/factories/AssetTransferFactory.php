<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\AssetTransfer;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssetTransfer>
 */
class AssetTransferFactory extends Factory
{
    protected $model = AssetTransfer::class;

    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'from_room_id' => Room::factory(),
            'to_room_id' => Room::factory(),
            'transfer_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'transferred_by' => fake()->name(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
