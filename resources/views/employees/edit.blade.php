@extends('layouts.app')

@section('title', 'Modifier l\'employé')
@section('page-title', 'Modifier l\'employé')

@section('content')

    <div class="max-w-2xl bg-white rounded-xl border border-slate-200 p-6">
        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Photo actuelle + nouveau fichier --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Photo de profil</label>
                @if ($employee->photo)
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="Photo actuelle"
                             class="w-12 h-12 rounded-full object-cover">
                        <span class="text-xs text-slate-500">Photo actuelle</span>
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:text-sm">
                <p class="text-xs text-slate-400 mt-1">Laisse vide pour garder la photo actuelle</p>
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Adresse</label>
                    <input type="text" name="address" value="{{ old('address', $employee->address) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn (optionnel)</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $employee->linkedin) }}" placeholder="https://linkedin.com/in/..."
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('linkedin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Poste</label>
                    <input type="text" name="position" value="{{ old('position', $employee->position) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('position')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Date d'embauche</label>
                    <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('hire_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Département</label>
                <select name="department_id"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CV actuel + nouveau fichier --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">CV (PDF ou Word, 5 Mo max)</label>
                @if ($employee->cv_path)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $employee->cv_path) }}" target="_blank" class="text-indigo-600 text-xs hover:underline">
                            📄 Voir le CV actuel
                        </a>
                    </div>
                @endif
                <input type="file" name="cv" accept=".pdf,.doc,.docx"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:text-sm">
                <p class="text-xs text-slate-400 mt-1">Laisse vide pour garder le CV actuel</p>
                @error('cv')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Mettre à jour
                </button>
                <a href="{{ route('employees.index') }}"
                   class="text-slate-500 text-sm font-medium px-4 py-2 rounded-lg hover:bg-slate-100">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection