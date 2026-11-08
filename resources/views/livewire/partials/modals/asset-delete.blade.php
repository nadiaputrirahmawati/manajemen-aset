<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" wire:click="$set('isDeleteModalOpen', false)"></div>

        <div class="relative w-full max-w-md bg-white rounded-xl shadow-xl border border-slate-100 p-6 text-center">
            <div class="mx-auto w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center mb-4">
                <i data-lucide="triangle-alert" class="w-5 h-5 text-rose-600"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Hapus Aset?</h3>
            <p class="text-sm text-slate-600 mt-3">
                Kamu akan menghapus <span class="font-semibold text-slate-900">{{ $assetToDeleteName }}</span>
                ({{ $assetToDeleteCode }}) beserta riwayat mutasi dan maintenance-nya. Tindakan ini tidak bisa dibatalkan.
            </p>

            <div class="flex items-center justify-center space-x-3 mt-6">
                <button type="button" wire:click="$set('isDeleteModalOpen', false)" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-medium px-4 py-2 rounded-lg">
                    Batal
                </button>
                <button type="button" wire:click="delete" wire:loading.attr="disabled" class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors disabled:opacity-60">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
