<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UseSeeder extends Seeder
{

public function run(): void
{
    $users = [
        
        ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'user',      'status' => 'active'],
        ['name' => 'Bob',   'email' => 'bob@example.com',   'role' => 'user',      'status' => 'inactive'],
        ['name' => 'Emma',  'email' => 'emma@example.com',  'role' => 'user',      'status' => 'active'],
        ['name' => 'David', 'email' => 'david@example.com', 'role' => 'admin',     'status' => 'inactive'],
    ];

    foreach ($users as $data) {
        User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'password' => Hash::make('Password'),
                'role' => $data['role'],
                'status' => $data['status'],
            ]
        );
    }
}

}

    