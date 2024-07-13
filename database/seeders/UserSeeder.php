<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            'name' => 'Superadmin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('superadmin'),
        ];

        $memberData = [
            'name' => 'Superadmin',
            'image' => 'superadmin.png',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
        ];

        $user = \App\Models\User::create($userData);

        $member = \App\Models\Member::create(array_merge($memberData, [
            'user_id' => $user->id
        ]));
    }
}
