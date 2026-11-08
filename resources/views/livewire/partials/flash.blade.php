@if ($flashMessage)
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3500)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white border border-slate-200 shadow-xs rounded-lg p-4"
        role="alert"
    >
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0 w-6 h-6 rounded-full @if ($flashType === 'success') bg-emerald-50 text-emerald-600 @else bg-rose-50 text-rose-600 @endif flex items-center justify-center">
                <i data-lucide="{{ $flashType === 'success' ? 'circle-check' : 'circle-x' }}" class="w-4 h-4"></i>
            </div>
            <p class="text-sm font-medium text-slate-700 flex-1">{{ $flashMessage }}</p>
            <button wire:click="closeFlash" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
@endif
