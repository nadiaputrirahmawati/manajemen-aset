<div class="bg-white border border-slate-200/90 shadow-xs rounded-xl p-4">
    <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
        <div class="flex flex-1 flex-wrap items-center gap-3">
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input
                    type="text"
                    wire:model.live.debounce.400ms="search"
                    placeholder="Cari nama, kode, serial, brand..."
                    class="bg-white border-slate-200 text-sm rounded-lg focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 py-2.5 pl-10 pr-4 w-full md:w-80 shadow-xs placeholder-slate-400"
                />
            </div>

            <select
                wire:model.live="categoryFilter"
                class="bg-white border-slate-200 text-sm rounded-lg text-slate-700 py-2.5 px-3 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 shadow-xs min-w-[150px]"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <select
                wire:model.live="roomFilter"
                class="bg-white border-slate-200 text-sm rounded-lg text-slate-700 py-2.5 px-3 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 shadow-xs min-w-[150px]"
            >
                <option value="">Semua Ruangan</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>

            <select
                wire:model.live="statusFilter"
                class="bg-white border-slate-200 text-sm rounded-lg text-slate-700 py-2.5 px-3 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 shadow-xs min-w-[150px]"
            >
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="sedang_digunakan">Sedang Digunakan</option>
                <option value="dalam_perbaikan">Dalam Perbaikan</option>
                <option value="afkir">AFKIR</option>
            </select>

            <select
                wire:model.live="conditionFilter"
                class="bg-white border-slate-200 text-sm rounded-lg text-slate-700 py-2.5 px-3 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 shadow-xs min-w-[150px]"
            >
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <button
                wire:click="resetFilters"
                type="button"
                class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-medium px-4 py-2.5 rounded-lg shadow-xs transition-colors"
            >
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                Reset
            </button>

            <button
                wire:click="openCreateModal"
                type="button"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg shadow-xs transition-colors"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Aset Baru
            </button>
        </div>
    </div>
</div>
