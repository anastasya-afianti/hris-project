<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presences;
use Illuminate\Http\Request;

class PresencesController extends Controller
{
    public function index()
    {
        $presences = Presences::all();
        return view('presences.index', compact('presences'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i',
            'date' => 'required|date',
            'status' => 'required|string'

        ]);

        Presences::create($validated);

        return redirect()->route('presences.index')->with('success', 'Presences created successfully.');
    }

    public function edit($id){
        $employees = Employee::all();
        $presences = Presences::findOrFail($id);
        return view('presences.edit', compact('presences', 'employees'));
    }

    public function update(Request $request, $id){
        $validated = $request -> validate([
             'employee_id' => 'required|integer|exists:employees,id',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i',
            'date' => 'required|date',
            'status' => 'required|string'
        ]);
        $presences = Presences::findOrFail($id);
        $presences -> update($validated);

        return redirect()->route('presences.index') -> with('success', 'Presences updated succesfully');
    }

    public function destroy($id){
        $presences = Presences::findOrFail($id);
        $presences -> delete();

        return redirect()->route('presences.index')->with('success', 'Presences deleted succesfully');
    }
}
