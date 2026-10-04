@extends('layouts.app')

@section('title', 'Projets')
@section('page-title', 'Projets')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <p class="text-slate-500 text-sm">{{ $projects->count() }} projet(s)</p>
        <a href="{{ route('projects.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Nouveau projet
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-6 py-3 font-medium">Nom</th>
                    <th class="px-6 py-3 font-medium">Statut</th>
                    <th class="px-6 py-3 font-medium">Début</th>
                    <th class="px-6 py-3 font-medium">Fin</th>
                    <th class="px-6 py-3 font-medium">Employés</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($projects as $project)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <a href="{{ route('projects.show', $project) }}" class="font-medium text-slate-800 hover:text-indigo-600">
                                {{ $project->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
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
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusStyles[$project->status] }}">
                                {{ $statusLabels[$project->status] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-slate-600">
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-50 text-indigo-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ $project->employees_count }} employé(s)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('projects.edit', $project) }}"
                               class="text-indigo-600 hover:underline">Modifier</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer ce projet ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                            Aucun projet pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection