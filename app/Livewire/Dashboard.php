<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public bool $isRepairModalOpen = false;

    public function openRepairModal(): void
    {
        $this->isRepairModalOpen = true;
    }

    public function closeRepairModal(): void
    {
        $this->isRepairModalOpen = false;
    }

    public function render()
    {
        $totalAssetsCount = Asset::query()->count();
        $totalVal = (float) Asset::query()->sum('purchase_price');
        $repairCount = Asset::query()->where('status', 'dalam_perbaikan')->count();
        $inUseCount = Asset::query()->where('status', 'sedang_digunakan')->count();
        $readyCount = Asset::query()->where('status', 'tersedia')->count();
        $afkirCount = Asset::query()->where('status', 'afkir')->count();

        $categoryBreakdown = Category::query()
            ->withCount('assets')
            ->withSum('assets', 'purchase_price')
            ->orderByDesc('assets_count')
            ->take(5)
            ->get();

        $recentAssets = Asset::query()
            ->with(['category', 'room'])
            ->latest('id')
            ->take(6)
            ->get();

        $repairingAssets = Asset::query()
            ->with(['category', 'room', 'vendor'])
            ->where('status', 'dalam_perbaikan')
            ->latest('updated_at')
            ->get();

        return view('livewire.dashboard', [
            'totalAssets' => $totalAssetsCount,
            'totalValue' => $totalVal,
            'repairAssets' => $repairCount,
            'inUseAssets' => $inUseCount,
            'readyAssets' => $readyCount,
            'afkirAssets' => $afkirCount,
            'categoryBreakdown' => $categoryBreakdown,
            'recentAssets' => $recentAssets,
            'repairingAssets' => $repairingAssets,
        ])->layout('layouts.app');
    }
}
