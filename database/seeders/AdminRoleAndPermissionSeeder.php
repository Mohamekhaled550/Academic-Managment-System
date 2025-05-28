<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class AdminRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // إنشاء صلاحيات
        $permissions = [
            'manage courses',
            'manage students',
            'manage terms',
            'view dashboard',
            'manage admins',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // إنشاء دور وربط الصلاحيات به
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'admin']);
        $superAdmin->syncPermissions($permissions);

        // ربط أدمن معين بالدور
        $admin = \App\Models\Admin::first();

        if ($admin) {
            $admin = Admin::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Super Admin',
        'password' => bcrypt('hamo2002')
    ]
);
            $admin->assignRole('super-admin');
        }
    }
}
