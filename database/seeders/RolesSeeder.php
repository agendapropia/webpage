<?php

namespace Database\Seeders;

use App\Models\Permissions\Permission;
use App\Models\Permissions\PermissionModule;
use App\Models\Permissions\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[
            \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'user-module']);
        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-update']);
        Permission::create(['name' => 'permission-module']);
        Permission::create(['name' => 'permission-list']);
        Permission::create(['name' => 'permission-create']);
        Permission::create(['name' => 'permission-delete']);
        Permission::create(['name' => 'permission-update']);
        Permission::create(['name' => 'permission-assign']);
        Permission::create(['name' => 'role-module']);
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-delete']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-assign']);
        
        // stores manager
        Permission::create(['name' => 'store-module']);
        Permission::create(['name' => 'store-list']);
        Permission::create(['name' => 'store-create']);
        Permission::create(['name' => 'store-delete']);
        Permission::create(['name' => 'store-update']);
        Permission::create(['name' => 'store-schedule']);
        Permission::create(['name' => 'store-schedule-update']);
        Permission::create(['name' => 'store-schedule-delete']);

        // menu
        Permission::create(['name' => 'menu-topping-module']);
        Permission::create(['name' => 'menu-topping-list']);
        Permission::create(['name' => 'menu-topping-create']);
        Permission::create(['name' => 'menu-topping-update']);
        Permission::create(['name' => 'menu-categorie-module']);
        Permission::create(['name' => 'menu-categorie-list']);
        Permission::create(['name' => 'menu-categorie-create']);
        Permission::create(['name' => 'menu-categorie-update']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        
        //Modules
        PermissionModule::create(['name' => 'Users']);
        
        //User-admin
        $user = User::find(1);
        $user->assignRole('super-admin');
    }
}
