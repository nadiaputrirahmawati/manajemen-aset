<div class="space-y-6">
    @include('livewire.partials.flash')

    <!-- Page Header for Assets -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Daftar Inventaris Terdaftar</h1>
            <p class="text-xs text-slate-400 font-medium mt-1">Kelola data seluruh aset, status operasional, histori mutasi dan spesifikasi alat rumah sakit.</p>
        </div>
        <div class="flex items-center gap-3">
            <button
                wire:click="openCreateModal"
                type="button"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-3 rounded-2xl shadow-sm shadow-emerald-600/20 transition-all cursor-pointer"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Aset Baru</span>
            </button>
        </div>
    </div>

    <!-- Filters & Table -->
    @include('livewire.partials.filters')
    @include('livewire.partials.assets-table')

    @if ($isFormOpen)
        @include('livewire.partials.modals.asset-form')
    @endif

    @if ($isDetailOpen && $selectedAsset)
        @include('livewire.partials.modals.asset-detail')
    @endif

    @if ($isTransferModalOpen)
        @include('livewire.partials.modals.asset-transfer')
    @endif

    @if ($isDeleteModalOpen)
        @include('livewire.partials.modals.asset-delete')
    @endif
</div>
