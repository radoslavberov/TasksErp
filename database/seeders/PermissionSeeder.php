<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    protected $toTruncate = ['permissions'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::findByName('admin');

        $admin->givePermissionTo(Permission::create(['name' => 'user-view']));
        $admin->givePermissionTo(Permission::create(['name' => 'user-create']));
        $admin->givePermissionTo(Permission::create(['name' => 'user-edit']));
        $admin->givePermissionTo(Permission::create(['name' => 'user-delete']));

        $admin->givePermissionTo(Permission::create(['name' => 'permission-view']));
        $admin->givePermissionTo(Permission::create(['name' => 'permission-create']));
        $admin->givePermissionTo(Permission::create(['name' => 'permission-edit']));
        $admin->givePermissionTo(Permission::create(['name' => 'permission-delete']));

        $admin->givePermissionTo(Permission::create(['name' => 'role-view']));
        $admin->givePermissionTo(Permission::create(['name' => 'role-create']));
        $admin->givePermissionTo(Permission::create(['name' => 'role-edit']));
        $admin->givePermissionTo(Permission::create(['name' => 'role-delete']));

        $admin->givePermissionTo(Permission::create(['name' => 'employee-view']));
        $admin->givePermissionTo(Permission::create(['name' => 'employee-create']));
        $admin->givePermissionTo(Permission::create(['name' => 'employee-edit']));
        $admin->givePermissionTo(Permission::create(['name' => 'employee-delete']));

        $admin->givePermissionTo(Permission::create(['name' => 'task-view']));
        $admin->givePermissionTo(Permission::create(['name' => 'task-create']));
        $admin->givePermissionTo(Permission::create(['name' => 'task-edit']));
        $admin->givePermissionTo(Permission::create(['name' => 'task-delete']));


        $employee = Role::findByName('employee');
        $employee->givePermissionTo(Permission::create(['name' => 'task-view']));
        $employee->givePermissionTo(Permission::create(['name' => 'task-edit']));
    }
}
