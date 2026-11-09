<div class="space-y-7">
    <!-- Top Row: Main Account Card & Emerald Action Promo Card -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Main Asset Portfolio Card (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-7 sm:p-8 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Portofolio Aset Utama</span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">RS Asset Capital Reserve</h2>
                    <div class="flex items-center gap-2 mt-1.5 text-xs font-medium text-slate-500">
                        <span class="font-mono tracking-wider">ID: 88 1240 7793 3667</span>
                        <a href="#assets-section" class="text-emerald-600 hover:text-emerald-700 font-semibold inline-flex items-center ml-1">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

                <div class="text-right">
                    <span class="text-xs font-semibold text-slate-400 block mb-1">Total Nilai Inventaris</span>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-mono tracking-tight">
                        Rp {{ number_format($totalValue, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- Action Buttons inside Main Card -->
            <div class="flex flex-wrap items-center gap-3 mt-8 pt-2">
                <button
                    wire:click="openCreateModal"
                    type="button"
                    class="inline-flex items-center gap-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm px-5 py-3 rounded-2xl shadow-sm shadow-emerald-700/20 transition-all hover:shadow-md cursor-pointer"
                >
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Tambah Aset Baru</span>
                </button>

                <button
                    type="button"
                    onclick="document.getElementById('assets-filter-card')?.scrollIntoView({behavior: 'smooth'})"
                    class="inline-flex items-center gap-2 bg-[#f0f4f4] hover:bg-[#e4ebec] text-slate-700 font-semibold text-sm px-5 py-3 rounded-2xl transition-all cursor-pointer"
                >
                    <i data-lucide="layers" class="w-4 h-4 text-slate-500"></i>
                    <span>Kelola & Filter</span>
                </button>
            </div>
        </div>

        <!-- Emerald Feature / Standings Order Card (5 cols) -->
        <div class="lg:col-span-5 rounded-3xl p-7 sm:p-8 bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 text-white flex flex-col justify-between relative overflow-hidden shadow-[0_8px_30px_rgb(5,150,105,0.18)]">
            <!-- Contour Pattern lines in background -->
            <div class="absolute -right-12 -top-12 w-64 h-64 rounded-full bg-emerald-500/10 pointer-events-none blur-2xl"></div>
            <div class="absolute right-0 bottom-0 opacity-15 pointer-events-none transform translate-x-4 translate-y-4">
                <i data-lucide="shield-check" class="w-48 h-48 stroke-1"></i>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-bold tracking-tight text-white">Jadwal Kalibrasi & Servis</h3>
                    <div class="flex items-center gap-1.5 bg-white/20 px-2.5 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase text-emerald-100">
                        <span>Aktif</span>
                    </div>
                </div>
                <p class="text-xs text-emerald-100/90 leading-relaxed max-w-xs mt-2">
                    Pemeliharaan berkala elektromedis terintegrasi otomatis untuk menjamin akurasi dan standar kelayakan operasional RS.
                </p>
            </div>

            <div class="relative z-10 flex items-end justify-between mt-6 pt-2">
                <button
                    type="button"
                    wire:click="$set('statusFilter', 'dalam_perbaikan')"
                    class="bg-white hover:bg-emerald-50 text-emerald-800 font-bold text-xs px-5 py-3 rounded-2xl shadow-sm transition-all cursor-pointer inline-flex items-center gap-2"
                >
                    <span>Cek Perbaikan ({{ $repairAssets }})</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </button>

                <!-- Mini Calendar Illustration Graphic -->
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex flex-col items-center justify-center p-2 shadow-inner">
                    <div class="w-full flex justify-between px-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                    </div>
                    <span class="text-lg font-black mt-0.5">{{ date('d') }}</span>
                    <span class="text-[9px] uppercase tracking-wider font-semibold text-emerald-200">{{ date('M') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Row: Bank Card-Style KPI Tiles (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Card 1: Total Aset -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-slate-200 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Total Inventaris</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Kode: 44 •••• 9448</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="package" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $totalAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">100%</span>
            </div>
        </div>

        <!-- Card 2: Siap Pakai -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-slate-200 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Siap Operasional</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Status: Tersedia</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $readyAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($readyAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </div>

        <!-- Card 3: Sedang Digunakan -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-slate-200 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Sedang Digunakan</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Di Ruang Rawat & Poli</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i data-lucide="activity" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $inUseAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($inUseAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </div>

        <!-- Card 4: Dalam Perbaikan -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-slate-200 transition-all">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Dalam Perbaikan</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Bengkel / Servis</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $repairAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($repairAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </div>
    </div>
</div>
