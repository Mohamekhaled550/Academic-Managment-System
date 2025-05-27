<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roles')->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'roles'    => 'required|array',
        ]);

        $admin = Admin::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $admin->syncRoles($data['roles']);

        return redirect()->route('admin.admins.index')->with('success', 'تم إنشاء الأدمن بنجاح');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'roles' => 'required|array',
        ]);

        $admin->update($data);
        $admin->syncRoles($data['roles']);

        return redirect()->route('admin.admins.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'تم الحذف بنجاح');
    }
}
