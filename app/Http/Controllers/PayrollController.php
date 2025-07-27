<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
         if (Auth::user()->employee?->role_id == '1'){
             $employees = Employee::all();
        $payrolls = Payroll::all();
         }else {
             $employees = Employee::where('id', Auth::user()->employee?->id)->get();
             $payrolls = Payroll::where('employee_id', Auth::user()->employee?->id)->get();
         }
       
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        $payrolls = Payroll::all();
        return view('payrolls.create', compact('employees', 'payrolls'));
    }

    public function store(Request $request)
    {
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

    public function edit($id)
    {
        $employees = Employee::all();
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.edit', compact('employees', 'payroll'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'salary' => 'required|string',
            'bonuses' => 'required|string',
            'deductions' => 'required|string',
            'net_salary' => 'required|string',
            'pay_date' => 'required|date',
        ]);
        $payrolls = Payroll::findOrFail($id);
        $payrolls->update($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payrolss update successfully');
    }

    public function destroy($id)
    {
        $payrolls = Payroll::findOrFail($id);
        $payrolls->delete();
        return redirect()->route('payrolls.index')->with('success', 'Deleted Payroll Successfully');
    }

    public function show($id)
    {
        $employee = Employee::all();
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.show', compact('payroll'));
    }

    public function exportPdf(Payroll $payroll)
    {
        return Pdf::loadView('payrolls.pdf', compact('payroll'))
            ->download('payroll-' . $payroll->employee->fullname . '.pdf');
    }
}
