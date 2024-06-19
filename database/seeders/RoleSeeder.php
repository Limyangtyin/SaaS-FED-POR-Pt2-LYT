<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{

    private $permissions = [
//        'role-assign',    'role-revoke',
//        'role-list',      'role-show',      'role-create',     'role-edit',      'role-delete',
//        'product-list',   'product-show',   'product-create',  'product-edit',   'product-delete',
//        'user-list',      'user-show',      'user-create',     'user-edit',      'user-delete',
//        'members',

        'can delete admins', 'can delete staffs', 'can delete clients', 'assign roles',

        //user permissions
        'user-browse','user-show', 'user-edit','user-add', 'user-delete',
        'user-trash-recover', 'user-trash-remove','user-trash-empty','user-trash-restore',

        //listing permissions
        'listing-browse','listing-show', 'listing-edit','listing-add', 'listing-delete',
        'listing-trash-recover', 'listing-trash-remove','listing-trash-empty','listing-trash-restore',

        //roles and perms management
        'roles-permissions'

    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create each of the permissions ready for role creation
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Generate the Admin Role
        $roleAdmin = Role::create(['name' => 'Admin']);
        $permissionsAll = Permission::pluck('name')->all();
        $roleAdmin->syncPermissions($permissionsAll);

        // Generate the Staff Role
        $roleStaff = Role::create(['name' => 'Staff']);
        $roleStaff->givePermissionTo([
            'user-browse', 'user-show', 'user-edit', 'user-add', 'user-delete',
            'user-trash-recover', 'user-trash-remove', 'user-trash-empty', 'user-trash-restore',
            'listing-browse', 'listing-show', 'listing-edit', 'listing-add', 'listing-delete',
            'listing-trash-recover', 'listing-trash-remove', 'listing-trash-empty', 'listing-trash-restore',
        ]);
//        $roleStaff->givePermissionTo('client');

        // Generate the Client role
        $roleClient = Role::create(['name' => 'Client']);
        $roleClient->givePermissionTo([
            'listing-browse', 'listing-show', 'listing-edit', 'listing-add', 'listing-delete',
            'listing-trash-recover', 'listing-trash-remove'
        ]);
//        $roleClient->givePermissionTo('members');
    }
}
