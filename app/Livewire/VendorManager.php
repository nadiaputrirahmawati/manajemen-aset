<?php

namespace App\Livewire;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class VendorManager extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;

    public bool $isFormOpen = false;
    public bool $isDeleteModalOpen = false;

    public ?int $vendorId = null;
    public string $name = '';
    public string $contact_person = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';

    public ?int $vendorToDeleteId = null;
    public string $vendorToDeleteName = '';

    public ?string $flashMessage = null;
    public string $flashType = 'success';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetValidation();
        $this->reset([
            'vendorId',
            'name',
            'contact_person',
            'phone',
            'email',
            'address',
        ]);
        $this->isFormOpen = true;
    }

    public function openEditModal(int $id): void
    {
        $this->resetValidation();
        $vendor = Vendor::query()->findOrFail($id);

        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->contact_person = (string) ($vendor->contact_person ?? '');
        $this->phone = (string) ($vendor->phone ?? '');
        $this->email = (string) ($vendor->email ?? '');
        $this->address = (string) ($vendor->address ?? '');

        $this->isFormOpen = true;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        if ($this->vendorId) {
            $vendor = Vendor::query()->findOrFail($this->vendorId);
            $vendor->update($validated);
            $this->notify('Vendor berhasil diperbarui!', 'success');
        } else {
            Vendor::query()->create($validated);
            $this->notify('Vendor baru berhasil ditambahkan!', 'success');
        }

        $this->isFormOpen = false;
    }

    public function confirmDelete(int $id): void
    {
        $vendor = Vendor::query()->withCount('assets')->findOrFail($id);
        $this->vendorToDeleteId = $vendor->id;
        $this->vendorToDeleteName = $vendor->name;
        $this->isDeleteModalOpen = true;
    }

    public function deleteVendor(): void
    {
        if ($this->vendorToDeleteId) {
            $vendor = Vendor::query()->withCount('assets')->findOrFail($this->vendorToDeleteId);

            if ($vendor->assets_count > 0) {
                $this->notify("Gagal: Vendor '{$vendor->name}' masih terikat dengan {$vendor->assets_count} aset.", 'error');
            } else {
                $vendor->delete();
                $this->notify('Vendor berhasil dihapus!', 'success');
            }
        }

        $this->isDeleteModalOpen = false;
        $this->vendorToDeleteId = null;
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
        $query = Vendor::query()->withCount('assets');

        if (! empty($this->search)) {
            $term = trim($this->search);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('contact_person', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%");
            });
        }

        $vendors = $query->latest('id')->paginate($this->perPage);

        return view('livewire.vendor-manager', [
            'vendors' => $vendors,
            'totalVendors' => Vendor::query()->count(),
        ])->layout('layouts.app');
    }
}
