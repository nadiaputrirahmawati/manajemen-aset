<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'floor',
        'pic_name',
    ];

    protected function casts(): array
    {
        return [
            'floor' => 'integer',
        ];
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'current_room_id');
    }

    public function transfersFrom(): HasMany
    {
        return $this->hasMany(AssetTransfer::class, 'from_room_id');
    }

    public function transfersTo(): HasMany
    {
        return $this->hasMany(AssetTransfer::class, 'to_room_id');
    }
}
