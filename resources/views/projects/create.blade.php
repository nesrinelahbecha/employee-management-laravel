@extends('layouts.app')

@section('title', 'Nouveau projet')
@section('page-title', 'Nouveau projet')

@section('content')

    <div class="max-w-2xl bg-white rounded-xl border border-slate-200 p-6">
        <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nom du projet</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Date de début</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Date de fin (optionnelle)</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Statut</label>
                    <select name="status"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="en_attente" {{ old('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_cours" {{ old('status') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('status') == 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Budget (DT, optionnel)</label>
                    <input type="number" step="0.01" name="budget" value="{{ old('budget') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('budget')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Enregistrer
                </button>
                <a href="{{ route('projects.index') }}"
                   class="text-slate-500 text-sm font-medium px-4 py-2 rounded-lg hover:bg-slate-100">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection