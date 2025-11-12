<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'desc')->paginate(20);

        if ($request->expectsJson()) {
            return response()->json($roles);
        }

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100|unique:roles,name',
            'label' => 'nullable|string|max:150',
        ]);

        $role = Role::create($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $role], 201);
        }

        return redirect()->route('roles.index')->with('success', 'Role created.');
    }

    public function show(Role $role, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json($role);
        }

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100|unique:roles,name,' . $role->id,
            'label' => 'nullable|string|max:150',
        ]);

        $role->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $role]);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('roles.index')->with('success', 'Role deleted.');
    }
}
