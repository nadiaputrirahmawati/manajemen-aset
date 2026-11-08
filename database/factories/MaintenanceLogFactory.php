<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\MaintenanceLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MaintenanceLog>
 */
class MaintenanceLogFactory extends Factory
{
    protected $model = MaintenanceLog::class;

    public function definition(): array
    {
        $actionDate = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'asset_id' => Asset::factory(),
            'maintenance_type' => fake()->randomElement(['Kalibrasi Berkala', 'Servis Rusak', 'Uji Fungsi Rutin', 'Penggantian Suku Cadang']),
            'action_date' => $actionDate->format('Y-m-d'),
            'next_maintenance_date' => fake()->dateTimeBetween($actionDate, '+1 year')->format('Y-m-d'),
            'cost' => fake()->randomFloat(2, 200000, 15000000),
            'technician_name' => fake()->name(),
            'status' => fake()->randomElement(['dijadwalkan', 'proses', 'selesai', 'dibatalkan']),
            'description' => fake()->sentence(),
        ];
    }
}
