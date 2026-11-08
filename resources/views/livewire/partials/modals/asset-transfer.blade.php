<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" wire:click="$set('isTransferModalOpen', false)"></div>

        <div class="relative w-full max-w-2xl bg-white rounded-xl shadow-xl border border-slate-100 p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <div class="flex items-center space-x-2">
                    <i data-lucide="arrow-left-right" class="w-5 h-5 text-blue-600"></i>
                    <h3 class="text-lg font-bold text-slate-900">Mutasi Ruangan</h3>
                </div>
                <button wire:click="$set('isTransferModalOpen', false)" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form wire:submit="processTransfer" class="space-y-4">
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-3.5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Aset</p>
                    <p class="text-sm font-semibold text-slate-900 mt-1">{{ $transferAssetName }}</p>
                    <p class="text-xs text-slate-500 mt-1">
                        Ruangan saat ini:
                        <span class="font-medium text-slate-700">{{ $transferCurrentRoomName }}</span>
                    </p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Ruangan Tujuan *</label>
                    <select wire:model="transferToRoomId" class="w-full rounded-lg border-slate-200 text-sm bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs">
                        <option value="">-- Pilih Ruangan Tujuan --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                    @error('transferToRoomId') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Dipindahkan Oleh *</label>
                    <input type="text" wire:model="transferredBy" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs" />
                    @error('transferredBy') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Catatan</label>
                    <textarea wire:model="transferNotes" rows="3" placeholder="Alasan mutasi, kondisi saat pindah, dll." class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 py-2.5 px-3 shadow-xs placeholder:text-slate-400"></textarea>
                    @error('transferNotes') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="$set('isTransferModalOpen', false)" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-medium px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors disabled:opacity-60">
                        <span wire:loading.remove wire:target="processTransfer">
                            <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                        </span>
                        <span wire:loading wire:target="processTransfer">
                            <i data-lucide="loader-circle" class="w-4 h-4 animate-spin"></i>
                        </span>
                        Proses Mutasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
