<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'role' => 'admin',
        ];

        $memberData = [
            'name' => 'Superadmin',
            'image' => 'superadmin.png',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
        ];

        $user = \App\Models\User::create($userData);

        $member = Member::create(array_merge($memberData, [
            'user_id' => $user->id
        ]));
    }
}
