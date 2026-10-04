@extends('layouts.app')

@section('title', $employee->first_name . ' ' . $employee->last_name)
@section('page-title', 'Profil employé')

@section('content')

    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-1 bg-white rounded-xl border border-slate-200 p-6 text-center h-fit">

            @if ($employee->photo)
                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->first_name }}"
                     class="w-24 h-24 rounded-full object-cover mx-auto mb-4">
            @else
                <div class="w-24 h-24 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-semibold mx-auto mb-4">
                    {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                </div>
            @endif

            <h2 class="font-semibold text-slate-800 text-lg">{{ $employee->first_name }} {{ $employee->last_name }}</h2>
            <p class="text-sm text-slate-500 mb-1">{{ $employee->position }}</p>

            @if ($employee->department)
                <span class="inline-block bg-indigo-50 text-indigo-600 text-xs font-medium px-2.5 py-1 rounded-full mt-2">
                    {{ $employee->department->name }}
                </span>
            @endif

            <div class="border-t border-slate-100 mt-5 pt-5 text-left space-y-3">
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <span class="text-slate-400">✉</span> {{ $employee->email }}
                </div>
                @if ($employee->phone)
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="text-slate-400">☎</span> {{ $employee->phone }}
                    </div>
                @endif
                @if ($employee->address)
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="text-slate-400">📍</span> {{ $employee->address }}
                    </div>
                @endif
                @if ($employee->linkedin)
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-slate-400">🔗</span>
                        <a href="{{ $employee->linkedin }}" target="_blank" class="text-indigo-600 hover:underline">Profil LinkedIn</a>
                    </div>
                @endif
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <span class="text-slate-400">📅</span> Embauché le {{ \Carbon\Carbon::parse($employee->hire_date)->format('d/m/Y') }}
                </div>
            </div>

            @if ($employee->cv_path)
                <a href="{{ asset('storage/' . $employee->cv_path) }}" target="_blank"
                   class="block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition mt-5">
                    📄 Télécharger le CV
                </a>
            @else
                <p class="text-slate-400 text-xs mt-5">Aucun CV téléchargé.</p>
            @endif

            <div class="flex gap-3 mt-4">
                <a href="{{ route('employees.edit', $employee) }}"
                   class="flex-1 text-center text-indigo-600 text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-50">
                    Modifier
                </a>
                <a href="{{ route('employees.index') }}"
                   class="flex-1 text-center text-slate-500 text-sm font-medium px-4 py-2 rounded-lg hover:bg-slate-100">
                    ← Retour
                </a>
            </div>
        </div>

        <div class="col-span-2 bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-medium text-slate-800 mb-4">Projets affectés ({{ $employee->projects->count() }})</h2>

            <div class="divide-y divide-slate-100">
                @forelse ($employee->projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="flex items-center justify-between py-3 hover:bg-slate-50 -mx-2 px-2 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-slate-800">{{ $project->name }}</p>
                            <p class="text-xs text-slate-500">{{ $project->pivot->role ?? 'Rôle non précisé' }}</p>
                        </div>
                        <span class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</span>
                    </a>
                @empty
                    <p class="text-slate-400 text-sm py-4">Aucun projet affecté pour le moment.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection