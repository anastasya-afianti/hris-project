<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presences;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresencesController extends Controller
{
    public function index()
    {
        if ((Auth::user()->employee?->role_id == '1')) {
            $presences = Presences::all();
        } else {
            $presences = Presences::where('employee_id', Auth::user()->employee?->id)->get();
        }
        return view('presences.index', compact('presences'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->employee?->role_id == '1') {
            // ini HR
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:employees,id',
                'check_in' => 'required|date_format:H:i',
                'check_out' => 'required|date_format:H:i',
                'date' => 'required|date',
                'status' => 'required|string'
            ]);
            Presences::create($validated);
        } else {
            // ini user biasa
            Presences::create([
                'employee_id' => Auth::user()->employee?->id, // ambil dari user login
                'check_in' => Carbon::now()->format('H:i'),
                'check_out' => Carbon::now()->format('H:i'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present'
            ]);
        }

        // Check if the user is within the acceptable range        

        return redirect()->route('presences.index')->with('success', 'Presences created successfully.');
    }

    public function edit($id)
    {
        $employees = Employee::all();
        $presences = Presences::findOrFail($id);
        return view('presences.edit', compact('presences', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i',
            'date' => 'required|date',
            'status' => 'required|string'
        ]);
        $presences = Presences::findOrFail($id);
        $presences->update($validated);

        return redirect()->route('presences.index')->with('success', 'Presences updated succesfully');
    }

    public function destroy($id)
    {
        $presences = Presences::findOrFail($id);
        $presences->delete();

        return redirect()->route('presences.index')->with('success', 'Presences deleted succesfully');
    }
}
