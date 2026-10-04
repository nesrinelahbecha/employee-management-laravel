<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'position' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'nullable|image|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('cv')) {
            $validated['cv_path'] = $request->file('cv')->store('employees/cv', 'public');
        }

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'projects']);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'position' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'nullable|image|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $validated['photo'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($employee->cv_path) {
                Storage::disk('public')->delete($employee->cv_path);
            }
            $validated['cv_path'] = $request->file('cv')->store('employees/cv', 'public');
        }

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employé modifié avec succès.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        if ($employee->cv_path) {
            Storage::disk('public')->delete($employee->cv_path);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }
}