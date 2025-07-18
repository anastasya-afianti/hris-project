<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string',
            'phone_number' => 'required|string|max:12',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|integer|exists:departments,id',
            'role_id' => 'required|integer|exists:roles,id',
            'status' => 'required|string',
            'salary' => 'required|string',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Task created successfully.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        $employees = Employee::all();

        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string',
            'phone_number' => 'required|string|max:12',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|integer|exists:departments,id',
            'role_id' => 'required|integer|exists:roles,id',
            'status' => 'required|string',
            'salary' => 'required|string',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Task updated successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
