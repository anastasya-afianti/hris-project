<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create(){
        return view('roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
        ]);
        Role::create($validated);
        return redirect()->route('roles.index')->with('success', 'Roles created successfully');
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id){
         $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        $role = Role::findOrfail($id);
        $role->update($validated);
        return redirect()->route('roles.index')->with('success', 'Roles updated successfully');
    }

    public function show(Role $role){
        return view('roles.show', compact('role'));
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
