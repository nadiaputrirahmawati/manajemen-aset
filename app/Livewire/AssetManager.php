<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\AssetTransfer;
use App\Models\Category;
use App\Models\Room;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AssetManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $categoryFilter = '';
    public string $roomFilter = '';
    public string $statusFilter = '';
    public string $conditionFilter = '';
    public int $perPage = 10;

    public bool $isFormOpen = false;
    public bool $isDetailOpen = false;
    public bool $isDeleteModalOpen = false;
    public bool $isTransferModalOpen = false;

    public ?int $assetId = null;
    public string $asset_code = '';
    public string $name = '';
    public string $category_id = '';
    public string $current_room_id = '';
    public string $vendor_id = '';
    public string $serial_number = '';
    public string $brand = '';
    public string $purchase_date = '';
    public $purchase_price = 0;
    public string $warranty_expiry = '';
    public string $condition = 'baik';
    public string $status = 'tersedia';
    public string $notes = '';

    public ?int $assetToDeleteId = null;
    public string $assetToDeleteName = '';
    public string $assetToDeleteCode = '';

    public ?int $transferAssetId = null;
    public string $transferAssetName = '';
    public string $transferCurrentRoomName = '';
    public string $transferToRoomId = '';
    public string $transferredBy = '';
    public string $transferNotes = '';

    public ?Asset $selectedAsset = null;

    public ?string $flashMessage = null;
    public string $flashType = 'success';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatingRoomFilter(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingConditionFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'categoryFilter', 'roomFilter', 'statusFilter', 'conditionFilter']);
        $this->resetPage();
    }

    public function updatedCategoryId($value): void
    {
        if (! $this->assetId && ! empty($value)) {
            $category = Category::query()->find($value);
            if ($category) {
                $count = Asset::query()->where('category_id', $category->id)->count() + 1;
                $prefix = preg_replace('/[^A-Za-z0-9]/', '', $category->code) ?: 'MED';
                $this->asset_code = sprintf('AST-%s-%04d', strtoupper($prefix), $count);
            }
        }
    }

    public function openCreateModal(): void
    {
        $this->resetValidation();
        $this->reset([
            'assetId',
            'asset_code',
            'name',
            'category_id',
            'current_room_id',
            'vendor_id',
            'serial_number',
            'brand',
            'warranty_expiry',
            'notes',
        ]);
        $this->purchase_date = now()->format('Y-m-d');
        $this->purchase_price = 0;
        $this->condition = 'baik';
        $this->status = 'tersedia';
        $this->isFormOpen = true;
    }

    public function openEditModal(int $id): void
    {
        $this->resetValidation();
        $asset = Asset::query()->findOrFail($id);

        $this->assetId = $asset->id;
        $this->asset_code = $asset->asset_code;
        $this->name = $asset->name;
        $this->category_id = (string) $asset->category_id;
        $this->current_room_id = (string) $asset->current_room_id;
        $this->vendor_id = (string) ($asset->vendor_id ?? '');
        $this->serial_number = (string) ($asset->serial_number ?? '');
        $this->brand = (string) ($asset->brand ?? '');
        $this->purchase_date = $asset->purchase_date?->format('Y-m-d') ?? '';
        $this->purchase_price = $asset->purchase_price;
        $this->warranty_expiry = $asset->warranty_expiry?->format('Y-m-d') ?? '';
        $this->condition = $asset->condition;
        $this->status = $asset->status;
        $this->notes = (string) ($asset->notes ?? '');

        $this->isFormOpen = true;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'asset_code' => ['required', 'string', 'max:50', Rule::unique('assets', 'asset_code')->ignore($this->assetId)],
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'current_room_id' => ['required', 'exists:rooms,id'],
            'vendor_id' => ['nullable', 'exists:vendors,id'],
            'serial_number' => ['nullable', 'string', 'max:100'],
            'brand' => ['nullable', 'string', 'max:100'],
            'purchase_date' => ['required', 'date'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'warranty_expiry' => ['nullable', 'date'],
            'condition' => ['required', 'in:baik,rusak_ringan,rusak_berat'],
            'status' => ['required', 'in:tersedia,sedang_digunakan,dalam_perbaikan,afkir'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['vendor_id'] = ! empty($validated['vendor_id']) ? $validated['vendor_id'] : null;
        $validated['warranty_expiry'] = ! empty($validated['warranty_expiry']) ? $validated['warranty_expiry'] : null;

        if ($this->assetId) {
            $asset = Asset::query()->findOrFail($this->assetId);
            $asset->update($validated);
            $this->notify('Aset berhasil diperbarui!', 'success');
        } else {
            Asset::query()->create($validated);
            $this->notify('Aset baru berhasil ditambahkan!', 'success');
        }

        $this->isFormOpen = false;
    }

    public function openDetailModal(int $id): void
    {
        $this->selectedAsset = Asset::query()
            ->with([
                'category',
                'room',
                'vendor',
                'transfers.fromRoom',
                'transfers.toRoom',
                'maintenanceLogs' => fn ($q) => $q->latest('action_date'),
            ])
            ->findOrFail($id);

        $this->isDetailOpen = true;
    }

    public function confirmDelete(int $id): void
    {
        $asset = Asset::query()->findOrFail($id);
        $this->assetToDeleteId = $asset->id;
        $this->assetToDeleteName = $asset->name;
        $this->assetToDeleteCode = $asset->asset_code;
        $this->isDeleteModalOpen = true;
    }

    public function delete(): void
    {
        if ($this->assetToDeleteId) {
            $asset = Asset::query()->findOrFail($this->assetToDeleteId);
            $asset->delete();
            $this->notify('Aset berhasil dihapus dari sistem.', 'success');
        }

        $this->isDeleteModalOpen = false;
        $this->reset(['assetToDeleteId', 'assetToDeleteName', 'assetToDeleteCode']);
    }

    public function openTransferModal(int $id): void
    {
        $this->resetValidation();
        $asset = Asset::query()->with('room')->findOrFail($id);

        $this->transferAssetId = $asset->id;
        $this->transferAssetName = $asset->name . ' (' . $asset->asset_code . ')';
        $this->transferCurrentRoomName = $asset->room?->name ?? 'Belum ditentukan';
        $this->transferToRoomId = '';
        $this->transferredBy = 'Admin Logistik';
        $this->transferNotes = '';

        $this->isTransferModalOpen = true;
    }

    public function processTransfer(): void
    {
        $this->validate([
            'transferToRoomId' => ['required', 'exists:rooms,id'],
            'transferredBy' => ['required', 'string', 'max:100'],
            'transferNotes' => ['nullable', 'string', 'max:500'],
        ]);

        $asset = Asset::query()->findOrFail($this->transferAssetId);

        if ((int) $asset->current_room_id === (int) $this->transferToRoomId) {
            $this->addError('transferToRoomId', 'Ruangan tujuan mutasi tidak boleh sama dengan ruangan saat ini.');
            return;
        }

        $previousRoomId = $asset->current_room_id;

        AssetTransfer::query()->create([
            'asset_id' => $asset->id,
            'from_room_id' => $previousRoomId,
            'to_room_id' => $this->transferToRoomId,
            'transfer_date' => Carbon::now(),
            'transferred_by' => $this->transferredBy,
            'notes' => $this->transferNotes,
        ]);

        $asset->update([
            'current_room_id' => $this->transferToRoomId,
        ]);

        $this->notify('Mutasi ruangan berhasil dicatat dalam riwayat!', 'success');
        $this->isTransferModalOpen = false;
    }

    public function notify(string $message, string $type = 'success'): void
    {
        $this->flashMessage = $message;
        $this->flashType = $type;
    }

    public function closeFlash(): void
    {
        $this->flashMessage = null;
    }

    public function render()
    {
        $query = Asset::query()
            ->with(['category', 'room', 'vendor']);

        if (! empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('asset_code', 'like', "%{$term}%")
                    ->orWhere('serial_number', 'like', "%{$term}%")
                    ->orWhere('brand', 'like', "%{$term}%");
            });
        }

        if (! empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }

        if (! empty($this->roomFilter)) {
            $query->where('current_room_id', $this->roomFilter);
        }

        if (! empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (! empty($this->conditionFilter)) {
            $query->where('condition', $this->conditionFilter);
        }

        $assets = $query->latest('id')->paginate($this->perPage);

        $totalAssetsCount = Asset::query()->count();
        $totalVal = (float) Asset::query()->sum('purchase_price');
        $repairCount = Asset::query()->where('status', 'dalam_perbaikan')->count();
        $inUseCount = Asset::query()->where('status', 'sedang_digunakan')->count();
        $readyCount = Asset::query()->where('status', 'tersedia')->count();
        $afkirCount = Asset::query()->where('status', 'afkir')->count();

        // Category breakdown with asset count and total value
        $categoryBreakdown = Category::query()
            ->withCount('assets')
            ->withSum('assets', 'purchase_price')
            ->orderByDesc('assets_count')
            ->take(5)
            ->get();

        // Recent activity or latest assets
        $recentAssets = Asset::query()
            ->with(['category', 'room'])
            ->latest('id')
            ->take(5)
            ->get();

        return view('livewire.asset-manager', [
            'assets' => $assets,
            'categories' => Category::query()->orderBy('name')->get(),
            'rooms' => Room::query()->orderBy('name')->get(),
            'vendors' => Vendor::query()->orderBy('name')->get(),
            'totalAssets' => $totalAssetsCount,
            'totalValue' => $totalVal,
            'repairAssets' => $repairCount,
            'inUseAssets' => $inUseCount,
            'readyAssets' => $readyCount,
            'afkirAssets' => $afkirCount,
            'categoryBreakdown' => $categoryBreakdown,
            'recentAssets' => $recentAssets,
        ])->layout('layouts.app');
    }
}
