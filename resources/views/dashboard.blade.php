@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

    {{-- Bannière d'accueil --}}
<div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
            </svg>
        </div>
        <div>
            <p class="text-sm text-slate-500">Bonjour {{ explode(' ', auth()->user()->name)[0] }}, voici votre aperçu</p>
            <h2 class="text-lg font-semibold text-slate-800">
                {{ $stats['employees'] }} employé(s) · {{ $stats['departments'] }} département(s) · {{ $stats['projects_active'] }} projet(s) actif(s)
            </h2>
        </div>
    </div>
    <div class="hidden md:flex items-center gap-2 text-xs text-slate-400 bg-slate-50 px-3 py-1.5 rounded-full">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
        Système à jour
    </div>
</div>

    {{-- Cartes statistiques --}}
    <div class="grid grid-cols-4 gap-4 mb-8">

        <div class="bg-white rounded-2xl border border-slate-200 p-5 transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 mb-1">Employés</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['employees'] }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <p class="text-xs text-slate-500 mb-1">Projets actifs</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['projects_active'] }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m16 0H8m0 0V9a2 2 0 012-2h4a2 2 0 012 2v12" />
                </svg>
            </div>
            <p class="text-xs text-slate-500 mb-1">Départements</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['departments'] }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-xs text-slate-500 mb-1">Projets terminés</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['projects_done'] }}</p>
        </div>

    </div>

    <div class="grid grid-cols-3 gap-6">

        {{-- Projets récents --}}
        <div class="col-span-2 bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-semibold text-slate-800">Projets récents</h2>
                <a href="{{ route('projects.index') }}" class="text-xs font-medium text-indigo-600 hover:underline">Voir tout →</a>
            </div>

            @php
                $statusStyles = ['en_attente' => 'bg-amber-50 text-amber-600', 'en_cours' => 'bg-emerald-50 text-emerald-600', 'termine' => 'bg-slate-100 text-slate-500'];
                $statusLabels = ['en_attente' => 'En attente', 'en_cours' => 'En cours', 'termine' => 'Terminé'];
                $statusDot = ['en_attente' => 'bg-amber-500', 'en_cours' => 'bg-emerald-500', 'termine' => 'bg-slate-400'];
            @endphp

            <div class="space-y-1">
                @forelse ($recentProjects as $project)
                    <a href="{{ route('projects.show', $project) }}"
                       class="flex items-center justify-between px-3 py-3 rounded-xl hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full {{ $statusDot[$project->status] }}"></span>
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $project->name }}</p>
                                <p class="text-xs text-slate-500">{{ $project->employees_count }} employé(s) affecté(s)</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusStyles[$project->status] }}">
                            {{ $statusLabels[$project->status] }}
                        </span>
                    </a>
                @empty
                    <p class="text-slate-400 text-sm py-4">Aucun projet pour le moment.</p>
                @endforelse
            </div>
        </div>

        {{-- Colonne droite --}}
        <div class="space-y-6">

            {{-- Graphique répartition --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h2 class="font-semibold text-slate-800 mb-4">Répartition des projets</h2>
                <canvas id="projectsChart" height="180"></canvas>
            </div>

            {{-- Derniers employés --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-slate-800">Derniers employés</h2>
                    <a href="{{ route('employees.index') }}" class="text-xs font-medium text-indigo-600 hover:underline">Voir tout →</a>
                </div>

                <div class="space-y-3">
                    @forelse ($recentEmployees as $employee)
                        <a href="{{ route('employees.show', $employee) }}" class="flex items-center gap-3 hover:bg-slate-50 -mx-2 px-2 py-1.5 rounded-lg">
                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" class="w-9 h-9 rounded-full object-cover flex-shrink-0">
                            @else
                                <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm text-slate-800 truncate">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $employee->department->name ?? $employee->position }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-slate-400 text-sm py-4">Aucun employé pour le moment.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <script>
        const ctx = document.getElementById('projectsChart');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['En attente', 'En cours', 'Terminés'],
                datasets: [{
                    data: [
                        {{ \App\Models\Project::where('status', 'en_attente')->count() }},
                        {{ $stats['projects_active'] }},
                        {{ $stats['projects_done'] }}
                    ],
                    backgroundColor: ['#f59e0b', '#10b981', '#94a3b8'],
                    borderWidth: 0,
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } } },
                cutout: '70%'
            }
        });
    </script>

@endsection