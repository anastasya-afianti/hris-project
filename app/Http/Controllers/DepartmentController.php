<?php

namespace App\Http\Controllers;

use App\Models\Department;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
            'status' => 'required|string'
        ]);
        Department::create($validated);
        return redirect()->route('departments.index')->with('success', 'Task created succesfully');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $department = Department::findOrFail($id);
        $department->update($validated);
        return redirect()->route('departments.index')->with('success', 'Task Updated Successfully');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function destroy($id)
    {
        $departments = Department::findOrFail($id);
        $departments->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
}
