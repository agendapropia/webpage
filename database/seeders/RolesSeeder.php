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
        Permission::create(['name' => 'auth-change-password']);
        
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

        Permission::create(['name' => 'configuration-module']);
        Permission::create(['name' => 'region-module']);
        Permission::create(['name' => 'region-list']);
        Permission::create(['name' => 'region-create']);
        Permission::create(['name' => 'region-delete']);
        Permission::create(['name' => 'region-update']);

        Permission::create(['name' => 'tag-module']);
        Permission::create(['name' => 'tag-list']);
        Permission::create(['name' => 'tag-create']);
        Permission::create(['name' => 'tag-delete']);
        Permission::create(['name' => 'tag-update']);

        Permission::create(['name' => 'special-module']);
        Permission::create(['name' => 'special-list']);
        Permission::create(['name' => 'special-create']);
        Permission::create(['name' => 'special-delete']);
        Permission::create(['name' => 'special-update']);
        
        Permission::create(['name' => 'alliedmedia-module']);
        Permission::create(['name' => 'alliedmedia-list']);
        Permission::create(['name' => 'alliedmedia-create']);
        Permission::create(['name' => 'alliedmedia-delete']);
        Permission::create(['name' => 'alliedmedia-update']);
        
        Permission::create(['name' => 'content-module']);
        Permission::create(['name' => 'content-list']);
        Permission::create(['name' => 'content-create']);
        Permission::create(['name' => 'content-delete']);
        Permission::create(['name' => 'content-update']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        
        //Modules
        PermissionModule::create(['name' => 'Users']);
        
        //User-admin
        $user = User::find(1);
        $user->assignRole('super-admin');
    }
}
