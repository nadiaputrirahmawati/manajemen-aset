<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Room;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Asset>
 */
class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'asset_code' => 'AST-' . fake()->unique()->numerify('#####'),
            'name' => fake()->words(3, true),
            'category_id' => Category::factory(),
            'current_room_id' => Room::factory(),
            'vendor_id' => Vendor::factory(),
            'serial_number' => strtoupper(fake()->bothify('SN-####-????')),
            'brand' => fake()->company(),
            'purchase_date' => fake()->date(),
            'purchase_price' => fake()->randomFloat(2, 5000000, 500000000),
            'warranty_expiry' => fake()->optional()->dateTimeBetween('+6 months', '+3 years')?->format('Y-m-d'),
            'condition' => fake()->randomElement(['baik', 'rusak_ringan', 'rusak_berat']),
            'status' => fake()->randomElement(['tersedia', 'sedang_digunakan', 'dalam_perbaikan', 'afkir']),
            'image_path' => null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
