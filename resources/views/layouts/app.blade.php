<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SIM-ASET RS | Sistem Manajemen Aset Rumah Sakit' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://unpkg.com/lucide@0.544.0/dist/umd/lucide.min.js"></script>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased font-sans min-h-screen">
    <div class="min-h-full flex flex-col">
        <header class="sticky top-0 z-40 bg-slate-900 border-b border-slate-800 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-blue-400">
                        <i data-lucide="hospital" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center space-x-2">
                            <span class="text-base font-bold tracking-tight text-white">SIM RS UMMI
                        </div>
                        <p class="text-xs text-slate-400 truncate">Sistem Informasi Manajemen Aset Rumah Sakit</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3 pl-4 border-l border-slate-700">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                            AD
                        </div>
                        <div class="hidden md:block text-left text-xs">
                            <div class="font-semibold text-white">Admin Logistik & Elektromedis</div>
                            <div class="text-slate-400">admin@rumahsakit.local</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="bg-white border-t border-slate-200 py-4 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong class="text-slate-700">SIM-ASET RS</strong> - Minimum Viable Product (MVP) Fullstack Hospital Asset Management.
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">Laravel 13</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">Livewire 4</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">Tailwind CSS</span>
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
