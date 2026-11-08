<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->string('maintenance_type');
            $table->date('action_date');
            $table->date('next_maintenance_date')->nullable();
            $table->decimal('cost', 15, 2)->default(0);
            $table->string('technician_name');
            $table->enum('status', ['dijadwalkan', 'proses', 'selesai', 'dibatalkan'])->default('selesai');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('next_maintenance_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
