<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'RS UMMI - Sistem Manajemen Aset' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://unpkg.com/lucide@0.544.0/dist/umd/lucide.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="h-full bg-[#f4f7f6] text-[#2c3e50] antialiased min-h-screen selection:bg-emerald-500 selection:text-white">
    <div class="min-h-full flex flex-col">
        <!-- Modern Clean Header like NevBank -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Brand & Primary Nav -->
                    <div class="flex items-center gap-10">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                            <div class="w-11 h-11 rounded-2xl bg-white p-1.5 border border-slate-100 shadow-sm flex items-center justify-center transition-transform group-hover:scale-105">
                                <img src="{{ asset('images/logo-rs-ummi.svg') }}" alt="Logo RS UMMI" class="w-full h-full object-contain">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-extrabold text-xl tracking-tight text-slate-900 leading-tight">RS UMMI</span>
                                <span class="text-[11px] font-semibold text-slate-400">Sistem Manajemen Aset</span>
                            </div>
                        </a>

                        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                            <a
                                href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? 'text-slate-900 border-b-2 border-emerald-600 pb-1 pt-1 font-bold' : 'text-slate-500 hover:text-slate-800 transition-colors pb-1 pt-1' }}"
                            >
                                Dashboard
                            </a>
                            <a
                                href="{{ route('assets.index') }}"
                                class="{{ request()->routeIs('assets.index') ? 'text-slate-900 border-b-2 border-emerald-600 pb-1 pt-1 font-bold' : 'text-slate-500 hover:text-slate-800 transition-colors pb-1 pt-1' }}"
                            >
                                Assets
                            </a>
                            <a
                                href="{{ route('vendors.index') }}"
                                class="{{ request()->routeIs('vendors.index') ? 'text-slate-900 border-b-2 border-emerald-600 pb-1 pt-1 font-bold' : 'text-slate-500 hover:text-slate-800 transition-colors pb-1 pt-1' }}"
                            >
                                Vendor
                            </a>
                        </nav>
                    </div>

                    <!-- Right Controls / User from Database -->
                    <div class="flex items-center gap-5">
                        <div class="flex items-center gap-2">
                            <button type="button" title="Pengaturan" class="w-9 h-9 rounded-full flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                                <i data-lucide="settings" class="w-4 h-4"></i>
                            </button>
                            <button type="button" title="Pesan" class="w-9 h-9 rounded-full flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </button>
                            <button type="button" title="Notifikasi" class="relative w-9 h-9 rounded-full flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                                <i data-lucide="bell" class="w-4 h-4"></i>
                                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                            </button>
                        </div>

                        <div class="h-6 w-[1px] bg-slate-200"></div>

                        <div class="flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-bold text-slate-800 leading-tight">
                                    {{ auth()->user()->name ?? 'Admin Rumah Sakit' }}
                                </div>
                                <div class="text-xs text-slate-400 font-medium">
                                    {{ auth()->user()->email ?? 'admin@rumahsakit.local' }}
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 border border-emerald-200/80 flex items-center justify-center text-emerald-800 font-black text-xs shadow-2xs">
                                {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                            </div>

                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" title="Keluar / Logout" class="text-slate-400 hover:text-rose-600 p-1.5 transition-colors cursor-pointer">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="mt-auto py-6 border-t border-slate-200/60 bg-white/50 text-xs text-slate-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-800">RS UMMI</span>
                    <span>&bull;</span>
                    <span>Sistem Manajemen Aset Rumah Sakit Terpadu</span>
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <span>Modern Clean UI</span>
                    <span>&bull;</span>
                    <span>&copy; {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script>
        document.addEventListener('livewire:init', () => {
            const renderIcons = () => window.lucide && lucide.createIcons();

            renderIcons();
            Livewire.hook('morph.added', () => renderIcons());
            Livewire.hook('morph.updated', () => renderIcons());
            Livewire.hook('element.updated', () => renderIcons());
        });
    </script>
</body>
</html>
