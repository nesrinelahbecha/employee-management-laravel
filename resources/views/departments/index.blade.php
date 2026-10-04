@extends('layouts.app')

@section('title', 'Départements')
@section('page-title', 'Départements')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <p class="text-slate-500 text-sm">{{ $departments->count() }} département(s)</p>
        <a href="{{ route('departments.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Nouveau département
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-6 py-3 font-medium">Nom</th>
                    <th class="px-6 py-3 font-medium">Responsable</th>
                    <th class="px-6 py-3 font-medium">Employés</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($departments as $department)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $department->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $department->manager ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-50 text-indigo-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ $department->employees_count }} employé(s)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('departments.edit', $department) }}"
                               class="text-indigo-600 hover:underline">Modifier</a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer ce département ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                            Aucun département pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection