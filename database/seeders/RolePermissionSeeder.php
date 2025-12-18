<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'delete own posts',
            'edit own posts',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'view subscribers',
            'delete subscribers',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage tenants',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin = Role::create(['name' => 'super-admin'
    ]);
        $superAdmin->givePermissionTo(Permission::all());


        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'view subscribers',
            'delete subscribers',
            'manage roles',
        ]);

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'view posts',
            'edit posts',
            'view categories',
            'edit categories',

        ]);

        $author = Role::create(['name' => 'author']);
        $author->givePermissionTo([
            'view posts',
            'create posts',
            'edit own posts',
            'view categories',
            'delete own posts',
        ]);

        $guest = Role::create(['name' => 'guest']);
        $guest->givePermissionTo([
            'view posts',
            'view categories',

        ]);
    }
}
