<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "super",
                "surname" => "admin",
                "permission_access" => 1,
                "email" => "superadmin@gmail.com",
                "phone" => "0340000000",
                "password" => Hash::make("123456")
            ],
            [
                "name" => "admin",
                "surname" => "admin",
                "permission_access" => 2,
                "email" => "admin@gmail.com",
                "phone" => "0340000000",
                "password" => Hash::make("123456")
            ],
            [
                "name" => "Facturation",
                "surname" => "1",
                "permission_access" => 3,
                "email" => "facturation1@gmail.com",
                "phone" => "0340000000",
                "password" => Hash::make("123456")
            ],
            [
                "name" => "Facturation",
                "surname" => "2",
                "permission_access" => 4,
                "email" => "facturation2@gmail.com",
                "phone" => "0340000000",
                "password" => Hash::make("123456")
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
