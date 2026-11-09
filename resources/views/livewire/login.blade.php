<div class="w-full max-w-md">
    <!-- Brand Logo & Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white p-2.5 shadow-md border border-slate-100 mb-4">
            <img src="{{ asset('images/logo-rs-ummi.svg') }}" alt="Logo RS UMMI" class="w-full h-full object-contain">
        </div>
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">RS UMMI</h1>
        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-wider">Sistem Manajemen Aset</p>
    </div>

    <!-- Login Box in NevBank Card Style -->
    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)]">
        <div class="mb-6">
            <h2 class="text-lg font-extrabold text-slate-900">Masuk ke Sistem</h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Silakan masuk menggunakan akun kredensial terdaftar</p>
        </div>

        <form wire:submit="login" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email</label>
                <div class="relative">
                    <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input
                        type="email"
                        wire:model="email"
                        required
                        autofocus
                        placeholder="nama@rumahsakit.local"
                        class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-3 pl-10 pr-4 shadow-2xs placeholder-slate-400 transition-all"
                    />
                </div>
                @error('email')
                    <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Kata Sandi</label>
                <div class="relative">
                    <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input
                        type="password"
                        wire:model="password"
                        required
                        placeholder="••••••••"
                        class="w-full bg-[#f8fafb] border border-slate-200 text-sm font-medium rounded-2xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 py-3 pl-10 pr-4 shadow-2xs placeholder-slate-400 transition-all"
                    />
                </div>
                @error('password')
                    <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between py-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model="remember" class="rounded-lg text-emerald-600 focus:ring-emerald-500 border-slate-300">
                    <span class="text-xs font-semibold text-slate-600">Ingat saya</span>
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm py-3 px-4 rounded-2xl shadow-sm shadow-emerald-600/25 transition-all cursor-pointer mt-2"
            >
                Masuk ke Sistem
            </button>
        </form>
    </div>

    <div class="text-center mt-6 text-xs text-slate-400 font-medium">
        &copy; {{ date('Y') }} RS UMMI &bull; Sistem Manajemen Aset Rumah Sakit
    </div>
</div>
