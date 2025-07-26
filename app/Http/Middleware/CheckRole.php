<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        $employeeID = Auth::user();
        $employee = Employee::find($employeeID);

        $request->session()->put('role', $employee->role->name);
        $request->session()->put('employee_id', $employee->id);

        if(!in_array($employee->role->name, $role)) {
            abort(403, 'You do not have permission to access this resource.');
        }
        return $next($request);
    }
}
