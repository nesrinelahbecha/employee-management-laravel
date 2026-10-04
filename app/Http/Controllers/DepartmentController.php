<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('employees')->latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'manager' => 'nullable|string|max:255',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Département ajouté avec succès.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'manager' => 'nullable|string|max:255',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Département modifié avec succès.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Département supprimé avec succès.');
    }
}