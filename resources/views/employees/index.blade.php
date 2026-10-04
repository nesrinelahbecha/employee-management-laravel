@extends('layouts.app')

@section('title', 'Employés')
@section('page-title', 'Employés')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <p class="text-slate-500 text-sm">{{ $employees->count() }} employé(s)</p>
        <a href="{{ route('employees.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Nouvel employé
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-6 py-3 font-medium">Nom</th>
                    <th class="px-6 py-3 font-medium">Email</th>
                    <th class="px-6 py-3 font-medium">Poste</th>
                    <th class="px-6 py-3 font-medium">Département</th>
                    <th class="px-6 py-3 font-medium">Embauché le</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($employees as $employee)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->first_name }}"
                                         class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                        {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <a href="{{ route('employees.show', $employee) }}" class="font-medium text-slate-800 hover:text-indigo-600">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $employee->email }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $employee->position }}</td>
                        <td class="px-6 py-4">
                            @if ($employee->department)
                                <span class="bg-indigo-50 text-indigo-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                    {{ $employee->department->name }}
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('employees.edit', $employee) }}"
                               class="text-indigo-600 hover:underline">Modifier</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer cet employé ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                            Aucun employé pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection