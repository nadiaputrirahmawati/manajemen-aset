<div class="space-y-6">
    <!-- Flash notification -->
    @if ($flashMessage)
        <div class="p-4 rounded-2xl flex items-center justify-between {{ $flashType === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200/80' : 'bg-rose-50 text-rose-800 border border-rose-200/80' }}">
            <div class="flex items-center gap-3">
                <i data-lucide="{{ $flashType === 'success' ? 'check-circle' : 'alert-circle' }}" class="w-5 h-5"></i>
                <span class="text-xs font-bold">{{ $flashMessage }}</span>
            </div>
            <button wire:click="closeFlash" class="p-1 rounded-lg hover:bg-black/5">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen Vendor & Rekanan</h1>
            <p class="text-xs text-slate-400 font-medium mt-1">Kelola data penyedia perlengkapan medis, distributor resmi, dan narahubung servis garansi.</p>
        </div>
        <div class="flex items-center gap-3">
            <button
                wire:click="openCreateModal"
                type="button"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-3 rounded-2xl shadow-sm shadow-emerald-600/20 transition-all cursor-pointer"
            >
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Vendor Baru</span>
            </button>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="relative w-full sm:w-80">
            <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                type="text"
                wire:model.live.debounce.350ms="search"
                placeholder="Cari vendor, kontak, telp..."
                class="w-full bg-[#f8fafb] border border-slate-200/80 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 pl-10 pr-4 shadow-2xs placeholder-slate-400 transition-all"
            />
        </div>

        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <span>Baris per halaman:</span>
            <select
                wire:model.live="perPage"
                class="bg-[#f8fafb] border border-slate-200/80 text-xs font-bold rounded-xl text-slate-700 py-1.5 px-3 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 cursor-pointer"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100/90 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                        <th class="px-6 py-4">Nama Vendor</th>
                        <th class="px-6 py-4">Kontak Person</th>
                        <th class="px-6 py-4">No. Telepon / HP</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Aset Terkait</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80 text-sm">
                    @forelse ($vendors as $vendor)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            <td class="px-6 py-4.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 group-hover:scale-105 transition-transform">
                                        <i data-lucide="truck" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-snug">{{ $vendor->name }}</p>
                                        @if ($vendor->address)
                                            <p class="text-[11px] text-slate-400 truncate max-w-xs">{{ $vendor->address }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4.5 text-xs font-semibold text-slate-700">
                                {{ $vendor->contact_person ?: '-' }}
                            </td>
                            <td class="px-6 py-4.5 font-mono text-xs text-slate-600">
                                {{ $vendor->phone ?: '-' }}
                            </td>
                            <td class="px-6 py-4.5 text-xs text-slate-600">
                                {{ $vendor->email ?: '-' }}
                            </td>
                            <td class="px-6 py-4.5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">
                                    <i data-lucide="package" class="w-3.5 h-3.5"></i>
                                    <span>{{ $vendor->assets_count }} Unit</span>
                                </span>
                            </td>
                            <td class="px-6 py-4.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <button
                                        wire:click="openEditModal({{ $vendor->id }})"
                                        title="Edit Vendor"
                                        class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition-colors cursor-pointer"
                                    >
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        wire:click="confirmDelete({{ $vendor->id }})"
                                        title="Hapus Vendor"
                                        class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                    >
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="w-14 h-14 rounded-3xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                        <i data-lucide="truck" class="w-7 h-7"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Data Vendor Tidak Ditemukan</h4>
                                    <p class="text-xs text-slate-400 mt-1">Belum ada vendor terdaftar atau pencarian tidak cocok</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
            {{ $vendors->links() }}
        </div>
    </div>

    <!-- Modal Form (Tambah/Edit Vendor) -->
    @if ($isFormOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" wire:click="$set('isFormOpen', false)"></div>

                <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 sm:p-8 overflow-hidden z-10">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                                <i data-lucide="truck" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">
                                    {{ $vendorId ? 'Edit Vendor' : 'Tambah Vendor Baru' }}
                                </h3>
                                <p class="text-xs text-slate-400 font-medium">Informasi rekanan penyedia alat rumah sakit</p>
                            </div>
                        </div>
                        <button wire:click="$set('isFormOpen', false)" type="button" class="w-9 h-9 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors cursor-pointer">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Vendor / Perusahaan *</label>
                            <input
                                type="text"
                                wire:model="name"
                                placeholder="Contoh: PT Medika Jaya Sentosa"
                                class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 px-4 shadow-2xs"
                            />
                            @error('name') <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Narahubung / Contact Person</label>
                            <input
                                type="text"
                                wire:model="contact_person"
                                placeholder="Contoh: Budi Santoso"
                                class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 px-4 shadow-2xs"
                            />
                            @error('contact_person') <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nomor Telepon</label>
                                <input
                                    type="text"
                                    wire:model="phone"
                                    placeholder="0812-xxxx-xxxx"
                                    class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-mono rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 px-4 shadow-2xs"
                                />
                                @error('phone') <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email</label>
                                <input
                                    type="email"
                                    wire:model="email"
                                    placeholder="contact@vendor.co.id"
                                    class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2.5 px-4 shadow-2xs"
                                />
                                @error('email') <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Alamat Kantor / Bengkel</label>
                            <textarea
                                wire:model="address"
                                rows="3"
                                placeholder="Alamat lengkap rekanan..."
                                class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-2 px-4 shadow-2xs"
                            ></textarea>
                            @error('address') <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <button
                                wire:click="$set('isFormOpen', false)"
                                type="button"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-5 py-2.5 rounded-2xl transition-colors cursor-pointer"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-6 py-2.5 rounded-2xl shadow-sm shadow-emerald-600/20 transition-all cursor-pointer"
                            >
                                Simpan Vendor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" wire:click="$set('isDeleteModalOpen', false)"></div>

                <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 sm:p-7 text-center z-10">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Hapus Vendor?</h3>
                    <p class="text-xs text-slate-500 mt-2">
                        Apakah Anda yakin ingin menghapus data rekanan <strong class="text-slate-800">{{ $vendorToDeleteName }}</strong>?
                    </p>

                    <div class="flex items-center justify-center gap-3 mt-6">
                        <button
                            type="button"
                            wire:click="$set('isDeleteModalOpen', false)"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-5 py-2.5 rounded-2xl transition-colors cursor-pointer"
                        >
                            Batal
                        </button>
                        <button
                            type="button"
                            wire:click="deleteVendor"
                            class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-5 py-2.5 rounded-2xl shadow-sm shadow-rose-600/20 transition-all cursor-pointer"
                        >
                            Hapus Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
