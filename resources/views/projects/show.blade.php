@extends('layouts.app')

@section('title', $project->name)
@section('page-title', $project->name)

@section('content')

    @php
        $statusStyles = [
            'en_attente' => 'bg-amber-50 text-amber-600',
            'en_cours' => 'bg-green-50 text-green-600',
            'termine' => 'bg-slate-100 text-slate-500',
        ];
        $statusLabels = [
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'termine' => 'Terminé',
        ];
    @endphp

    <div class="grid grid-cols-3 gap-6">

        {{-- Infos projet --}}
        <div class="col-span-1 bg-white rounded-xl border border-slate-200 p-6 h-fit">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusStyles[$project->status] }}">
                    {{ $statusLabels[$project->status] }}
                </span>
                <a href="{{ route('projects.edit', $project) }}" class="text-indigo-600 text-sm hover:underline">Modifier</a>
            </div>

            <p class="text-sm text-slate-500 mb-4">{{ $project->description ?? 'Aucune description.' }}</p>

            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-slate-500">Début</dt>
                    <dd class="text-slate-800">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-500">Fin</dt>
                    <dd class="text-slate-800">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : '—' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-500">Budget</dt>
                    <dd class="text-slate-800">{{ $project->budget ? number_format($project->budget, 2) . ' DT' : '—' }}</dd>
                </div>
            </dl>

            <a href="{{ route('projects.index') }}" class="block text-center text-slate-500 text-sm mt-6 hover:underline">
                ← Retour aux projets
            </a>
        </div>

        {{-- Employés affectés --}}
        <div class="col-span-2 bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-medium text-slate-800 mb-4">Employés affectés ({{ $project->employees->count() }})</h2>

            <div class="divide-y divide-slate-100 mb-4">
                @forelse ($project->employees as $employee)
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                <p class="text-xs text-slate-500">{{ $employee->pivot->role ?? 'Rôle non précisé' }}</p>
                            </div>
                        </div>
                        <form action="{{ route('projects.detach-employee', [$project, $employee]) }}" method="POST"
                              onsubmit="return confirm('Retirer cet employé du projet ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">Retirer</button>
                        </form>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm py-4">Aucun employé affecté pour le moment.</p>
                @endforelse
            </div>

            {{-- Formulaire d'affectation --}}
            <form action="{{ route('projects.attach-employee', $project) }}" method="POST"
                  class="flex gap-2 pt-4 border-t border-slate-100">
                @csrf
                <select name="employee_id" required
                        class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Choisir un employé --</option>
                    @foreach ($allEmployees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                    @endforeach
                </select>
                <input type="text" name="role" placeholder="Rôle (optionnel)"
                       class="w-40 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition whitespace-nowrap">
                    Affecter
                </button>
            </form>
        </div>

    </div>

@endsection