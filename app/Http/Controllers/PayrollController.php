<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Payroll;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $payrolls = Payroll::all();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create(){
        $employees = Employee::all();
        $payrolls = Payroll::all();
        return view('payrolls.create', compact('employees','payrolls'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'salary' => 'required|string',
            'bonuses' => 'required|string',
            'deductions' => 'required|string',
            'net_salary' => 'required|string',
            'pay_date' => 'required|date',
        ]); 

        Payroll::create($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payrolls created successfully');
    }
}
