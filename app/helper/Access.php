<?php

namespace App\helper;

use Illuminate\Support\Facades\DB;

class Access
{
    const ROLES = [
        "super admin" => 1,
        "admin" => 2,
        "caisse" => 3,
        "facturation" => 4,
        "responsable stock" => 5
    ];

    const PERMISSIONS = [
        "view_customer", "create_customer", "update_customer",
        "view all",
        "create user",
        "create emballage",
        "view article", "create article", "edit article", "update article", "delete article",
        "edit articles",
        "edit selling price",
        "edit sales",
        "make sale",

        "delete articles",
        "cancel sales",
        "make inventory",
        "valid inventory",
        "delete one line article",
        "make payment",
        "print sale invoice",
        "view stock",
        "view dashboard",
        "view articles",
        "view inventory",
        "make payment",
        "print sale",
        "view dashboard",
        "create emballage",

        "enter_stock",
        "out_stock",
        "valid_stock",
        "print_stock",
        "view_intern_doc",

        "make sale", "view sale",
    ];

    const CAISSE = [
        "view_customer", "create_customer", "update_customer",
        "make payment",
        "print sale",
        "view dashboard",
        "view article",
        "view stock",
        "view sale",
    ];

    const FACTURATION = [
        "view_customer", "create_customer", "update_customer",
        "view article",
        "make sale",
        "view stock",
        "make sale", "view sale",
    ];

    const STOCKER = [
        "view article",
        "enter_stock",
        "out_stock",
        "print_stock",
        "view stock",
        "view_intern_doc",
        "view inventory",
        "make inventory",
    ];

    public static function syncRolePermission($user, $role = null)
    {
        if ($user) {
            if (is_null($role)) {
                $role = self::getRoleRequest();
            }

            $role = request()->permission_access ?? $role;

            switch ($role) {
                case Access::ROLES["admin"]:
                    $user->syncPermissions(Access::PERMISSIONS);
                    break;
                case Access::ROLES["caisse"]:
                    $user->syncPermissions(Access::CAISSE);
                    break;
                case Access::ROLES["facturation"]:
                    $user->syncPermissions(Access::FACTURATION);
                    break;
                case Access::ROLES["responsable stock"]:
                    $user->syncPermissions(Access::STOCKER);
                    break;
                default:
                    # code...
                    break;
            }

            DB::table("model_has_roles")->where("model_type", "App\Models\User")
                ->where("model_id", $user->id)->delete();
            $user->assignRole($role);
        }
    }

    private static function getRoleRequest()
    {
        $role =  array_search(request()->permission_access, Access::ROLES);

        return $role > 0 ? $role : "facturation";
    }
}
