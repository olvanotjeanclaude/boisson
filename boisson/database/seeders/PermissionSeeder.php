<?php

namespace Database\Seeders;

use App\helper\Access;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array_values(array_keys(Access::ROLES));
        $permissions = Access::PERMISSIONS;

        foreach ($roles as $role) {
            Role::updateOrCreate(["name" => $role], ["name" => $role]);
        }

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(["name" => $permission], ["name" => $permission]);
        }

        $roleAdmin = Role::where("name", "admin")->first();
        $roleFacturation = Role::where("name", "facturation")->first();
        $roleCaisse = Role::where("name", "caisse")->first();
        $roleMagasinier = Role::where("name","responsable stock")->first();

        $roleAdmin->syncPermissions($permissions);
        $roleFacturation->syncPermissions(Access::FACTURATION);
        $roleCaisse->syncPermissions(Access::CAISSE);
        $roleMagasinier->syncPermissions(Access::STOCKER);

        foreach (User::all() as $key => $user) {
            $role =  Access::ROLES[$user->permission_access]??Access::ROLES["facturation"];
            Access::syncRolePermission($user, $role);
        }
    }
}
