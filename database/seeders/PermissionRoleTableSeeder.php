<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        /* Setting Admin Permissions */
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        /* Setting User Permissions */
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return (
                substr($permission->title, 0, 5) != 'user_' &&
                substr($permission->title, 0, 5) != 'role_' &&
                substr($permission->title, 0, 4) != 'dev_' &&
                substr($permission->title, 0, 11) != 'permission_'
            );
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);

        /* Setting Developer Permissions */
        $dev_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 4) == 'dev_';
        });
        Role::findOrFail(3)->permissions()->sync($dev_permissions);
    }
}
