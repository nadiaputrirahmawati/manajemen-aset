<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_code')->unique();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('current_room_id')->constrained('rooms')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnUpdate()->nullOnDelete();
            $table->string('serial_number')->nullable();
            $table->string('brand')->nullable();
            $table->date('purchase_date');
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->date('warranty_expiry')->nullable();
            $table->enum('condition', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->enum('status', ['tersedia', 'sedang_digunakan', 'dalam_perbaikan', 'afkir'])->default('tersedia');
            $table->string('image_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('status');
            $table->index('condition');
            $table->index(['category_id', 'current_room_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
