@extends('layouts.app')

@section('title', 'Nouveau département')
@section('page-title', 'Nouveau département')

@section('content')

    <div class="max-w-lg bg-white rounded-xl border border-slate-200 p-6">
        <form action="{{ route('departments.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nom du département</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Responsable</label>
                <input type="text" name="manager" value="{{ old('manager') }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('manager')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Enregistrer
                </button>
                <a href="{{ route('departments.index') }}"
                   class="text-slate-500 text-sm font-medium px-4 py-2 rounded-lg hover:bg-slate-100">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection