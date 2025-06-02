<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
{
    $this->middleware('ensure.super.admin');
}


    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|unique:roles,name',
            'permissions' => 'array|required',
        ]);

        $role = Role::create(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);

        return redirect()->route('admin.roles.index')->with('success', 'تم إنشاء الدور بنجاح');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name'        => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array|required',
        ]);

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);

        return redirect()->route('admin.roles.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'تم الحذف بنجاح');
    }
}
