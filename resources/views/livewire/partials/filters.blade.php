<div id="assets-filter-card" class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)]">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <!-- Search bar & Dropdowns -->
        <div class="flex flex-1 flex-wrap items-center gap-3">
            <div class="relative w-full sm:w-72">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input
                    type="text"
                    wire:model.live.debounce.350ms="search"
                    placeholder="Cari aset, serial, merk..."
                    class="w-full bg-[#f8fafb] border border-slate-200/80 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 pl-10 pr-4 shadow-2xs placeholder-slate-400 transition-all"
                />
            </div>

            <!-- Category Filter -->
            <select
                wire:model.live="categoryFilter"
                class="bg-[#f8fafb] border border-slate-200/80 text-xs font-semibold rounded-2xl text-slate-700 py-2.5 px-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 shadow-2xs min-w-[140px] transition-all cursor-pointer"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Room Filter -->
            <select
                wire:model.live="roomFilter"
                class="bg-[#f8fafb] border border-slate-200/80 text-xs font-semibold rounded-2xl text-slate-700 py-2.5 px-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 shadow-2xs min-w-[140px] transition-all cursor-pointer"
            >
                <option value="">Semua Ruangan</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>

            <!-- Status Filter -->
            <select
                wire:model.live="statusFilter"
                class="bg-[#f8fafb] border border-slate-200/80 text-xs font-semibold rounded-2xl text-slate-700 py-2.5 px-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 shadow-2xs min-w-[130px] transition-all cursor-pointer"
            >
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="sedang_digunakan">Sedang Digunakan</option>
                <option value="dalam_perbaikan">Dalam Perbaikan</option>
                <option value="afkir">AFKIR</option>
            </select>

            <!-- Condition Filter -->
            <select
                wire:model.live="conditionFilter"
                class="bg-[#f8fafb] border border-slate-200/80 text-xs font-semibold rounded-2xl text-slate-700 py-2.5 px-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 shadow-2xs min-w-[130px] transition-all cursor-pointer"
            >
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
        </div>

        <!-- Action / Reset Buttons -->
        <div class="flex items-center gap-3 shrink-0">
            <button
                wire:click="resetFilters"
                type="button"
                class="inline-flex items-center gap-2 bg-[#f8fafb] hover:bg-[#eef2f3] text-slate-600 text-xs font-bold px-4 py-2.5 rounded-2xl border border-slate-200/70 shadow-2xs transition-all cursor-pointer"
            >
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                <span>Reset</span>
            </button>

            <button
                wire:click="openCreateModal"
                type="button"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2.5 rounded-2xl shadow-sm shadow-emerald-600/20 transition-all cursor-pointer"
            >
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Tambah Aset</span>
            </button>
        </div>
    </div>
</div>
