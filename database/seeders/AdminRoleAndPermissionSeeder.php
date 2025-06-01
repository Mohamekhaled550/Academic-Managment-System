<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminRoleAndPermissionSeeder extends Seeder
{
    public function run()
    {

            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // حذف الكل لتجنب التكرار
        \DB::table('role_has_permissions')->truncate();
        \DB::table('model_has_roles')->truncate();
        \DB::table('permissions')->truncate();
        \DB::table('roles')->truncate();


            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // صلاحيات عامة
        $permissions = [
            'view dashboard',
            'manage courses',
            'manage students',
            'manage terms',
            'manage admins',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $advisorRole = Role::firstOrCreate(['name' => 'advisor', 'guard_name' => 'admin']);

        // ربط الصلاحيات بالأدوار
        $adminRole->syncPermissions(Permission::all());

        $advisorPermissions = [
            'view dashboard',
            'manage students',
            'manage courses',
        ];

        $advisorRole->syncPermissions($advisorPermissions);

        // إنشاء مسؤول (admin)
        $admin = Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole($adminRole);

        // إنشاء مرشد أكاديمي (advisor)
        $advisor = Admin::updateOrCreate(
            ['email' => 'advisor@example.com'],
            [
                'name' => 'Advisor',
                'password' => Hash::make('advisor123'),
            ]
        );
        $advisor->assignRole($advisorRole);

        // ✅ تم إنشاء المستخدمين:
        echo "-----------------------------\n";
        echo "🧑‍💼 Admin:\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n\n";

        echo "👨‍🏫 Advisor:\n";
        echo "Email: advisor@example.com\n";
        echo "Password: advisor123\n";
        echo "-----------------------------\n";
    }
}
