<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Employee;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('employees')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:en_attente,en_cours,termine',
            'budget' => 'nullable|numeric|min:0',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Projet ajouté avec succès.');
    }

    public function show(Project $project)
{
    $project->load('employees');
    $allEmployees = Employee::whereNotIn('id', $project->employees->pluck('id'))->orderBy('first_name')->get();
    return view('projects.show', compact('project', 'allEmployees'));
}

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:en_attente,en_cours,termine',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Projet modifié avec succès.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
    public function attachEmployee(Request $request, Project $project)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'role' => 'nullable|string|max:255',
    ]);

    $project->employees()->attach($request->employee_id, ['role' => $request->role]);

    return redirect()->route('projects.show', $project)->with('success', 'Employé affecté avec succès.');
}

public function detachEmployee(Project $project, Employee $employee)
{
    $project->employees()->detach($employee->id);

    return redirect()->route('projects.show', $project)->with('success', 'Employé retiré du projet.');
}
}