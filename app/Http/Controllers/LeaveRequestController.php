<?php

namespace App\Http\Controllers;
use App\Models\LeaveRequest;
Use App\Models\Employee;

use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(){
        $employee = Employee::all();
        $leaveRequest = LeaveRequest::all();
        return view('leave-request.index', compact('leaveRequest'));
    }
     public function confirm (int $id){
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->update(['status' => 'confirm']);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request confirmed');
    }

    public function reject (int $id){
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->update(['status' => 'reject']);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request rejected');
    }

    public function pending(int $id){
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->update(['status' => 'pending']);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request set to pending');
    }

    public function create(){
        $employees = Employee::all();
        $leaveRequest = LeaveRequest::all();
        return view('leave-request.create', compact('employees', 'leaveRequest'));
    }

    public function store(Request $request){
       $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'nullable|string|in:pending,confirm,reject',
        ]);
        LeaveRequest::create($validated);
        return redirect()->route('leave-requests.index')->with('success', 'Leave requested successfully');
    }
}
