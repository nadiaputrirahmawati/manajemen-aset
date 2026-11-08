<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="bg-white p-5 rounded-xl border border-slate-200/90 shadow-xs min-w-0">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Aset</p>
        <p class="text-2xl font-bold tracking-tight text-slate-900 font-mono mt-2 tabular-nums">{{ $totalAssets }}</p>
    </div>

    <div class="bg-white p-5 rounded-xl border border-slate-200/90 shadow-xs min-w-0">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nilai Total Inventaris</p>
        <p class="text-xl xl:text-2xl font-bold tracking-tight text-slate-900 font-mono mt-2 tabular-nums whitespace-nowrap overflow-hidden text-ellipsis">
            Rp {{ number_format($totalValue, 0, ',', '.') }}
        </p>
    </div>

    <div class="bg-white p-5 rounded-xl border border-slate-200/90 shadow-xs min-w-0">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Aset Dalam Perbaikan</p>
        <p class="text-2xl font-bold tracking-tight text-slate-900 font-mono mt-2 tabular-nums">{{ $repairAssets }}</p>
    </div>

    <div class="bg-white p-5 rounded-xl border border-slate-200/90 shadow-xs min-w-0">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Aset Siap Pakai</p>
        <p class="text-2xl font-bold tracking-tight text-slate-900 font-mono mt-2 tabular-nums">{{ $readyAssets }}</p>
    </div>
</div>
