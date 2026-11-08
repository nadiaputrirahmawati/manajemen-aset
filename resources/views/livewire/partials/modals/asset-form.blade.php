<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" wire:click="$set('isFormOpen', false)"></div>

        <div class="relative w-full max-w-2xl bg-white rounded-xl shadow-xl border border-slate-100 p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-slate-900">
                    {{ $assetId ? 'Edit Aset' : 'Tambah Aset Baru' }}
                </h3>
                <button wire:click="$set('isFormOpen', false)" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Kode Aset</label>
                        <input
                            type="text"
                            wire:model="asset_code"
                            placeholder="Otomatis terisi saat pilih kategori"
                            class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 font-mono shadow-xs placeholder:text-slate-400"
                        />
                        @error('asset_code') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Aset *</label>
                        <input type="text" wire:model="name" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Kategori *</label>
                        <select wire:model.live="category_id" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Ruangan *</label>
                        <select wire:model="current_room_id" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                            <option value="">-- Pilih Ruangan --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        @error('current_room_id') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Vendor</label>
                        <select wire:model="vendor_id" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                            <option value="">-- Tanpa Vendor --</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                        @error('vendor_id') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Serial Number</label>
                        <input type="text" wire:model="serial_number" class="w-full rounded-lg border-slate-200 text-sm font-mono focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('serial_number') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Brand</label>
                        <input type="text" wire:model="brand" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('brand') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Tanggal Pembelian *</label>
                        <input type="date" wire:model="purchase_date" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('purchase_date') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Harga Pembelian (Rp) *</label>
                        <input type="number" step="0.01" min="0" wire:model="purchase_price" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('purchase_price') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Garansi Hingga</label>
                        <input type="date" wire:model="warranty_expiry" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                        @error('warranty_expiry') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Kondisi *</label>
                        <select wire:model="condition" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                            <option value="baik">Baik</option>
                            <option value="rusak_ringan">Rusak Ringan</option>
                            <option value="rusak_berat">Rusak Berat</option>
                        </select>
                        @error('condition') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Status *</label>
                        <select wire:model="status" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                            <option value="tersedia">Tersedia</option>
                            <option value="sedang_digunakan">Sedang Digunakan</option>
                            <option value="dalam_perbaikan">Dalam Perbaikan</option>
                            <option value="afkir">AFKIR</option>
                        </select>
                        @error('status') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Catatan</label>
                        <textarea wire:model="notes" rows="3" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs"></textarea>
                        @error('notes') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="$set('isFormOpen', false)" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-medium px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors disabled:opacity-60">
                        <span wire:loading.remove wire:target="save">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </span>
                        <span wire:loading wire:target="save">
                            <i data-lucide="loader-circle" class="w-4 h-4 animate-spin"></i>
                        </span>
                        {{ $assetId ? 'Simpan Perubahan' : 'Simpan Aset' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
