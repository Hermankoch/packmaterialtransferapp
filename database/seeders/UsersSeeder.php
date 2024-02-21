<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Herman',
                'surname' => 'Koch',
                'email' => 'admin@test.co.za',
                'password' => hash::make('Cookie!2023'),
                'type' => 'admin'
            ],
        ];
        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
