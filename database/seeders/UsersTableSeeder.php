<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-10-16 03:04:54',
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'Developer',
                'email'              => 'developer@developer.com',
                'password'           => bcrypt('developer'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-10-16 03:04:54',
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
        ];

        User::insert($users);
    }
}
