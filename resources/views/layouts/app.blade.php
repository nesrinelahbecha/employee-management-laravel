<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Employés & Projets')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-800">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 flex flex-col">
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-800/80">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center font-bold text-sm">GP</div>
                <div>
                    <p class="font-semibold text-sm leading-tight">GEP</p>
                    <p class="text-[11px] text-slate-400">Gestion RH & Projets</p>
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-1 px-3">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Tableau de bord
                </a>

                <a href="{{ route('employees.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('employees.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                    </svg>
                    Employés
                </a>

                <a href="{{ route('projects.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('projects.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Projets
                </a>

                <a href="{{ route('departments.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('departments.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m16 0H8m0 0V9a2 2 0 012-2h4a2 2 0 012 2v12" />
                    </svg>
                    Départements
                </a>
            </nav>

            <div class="mt-auto px-3 pb-5">
                <div class="bg-slate-800/60 rounded-xl p-4">
                    <p class="text-xs text-slate-300 leading-relaxed">Besoin d'aide ? Consultez la documentation Laravel.</p>
                </div>
            </div>
        </aside>

        {{-- Contenu principal --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Header --}}
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <div>
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide">{{ now()->translatedFormat('l d F Y') }}</p>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Tableau de bord')</h1>
                </div>

                @auth
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-slate-700 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-slate-400 hover:text-red-500 transition ml-1" title="Déconnexion">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endauth
            </header>

            @if (session('success'))
                <div class="mx-8 mt-4 bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <main class="flex-1 p-8">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>