<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);  
        
        \App\Models\Role::create([
            'id' => 2,
            'name' => 'Pengurus',
        ]); 
    
        // Akun Admin
        \App\Models\User::create([
            'name' => 'Admin HMSE',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'), // Wajib di-encrypt
            'role_id' => 1,
        ]);

        // Akun Pengurus
        \App\Models\User::create([
            'name' => 'Pengurus HMSE',
            'email' => 'pengurus@example.com',
            'password' => bcrypt('password123'),
            'role_id' => 2,
        ]);
    }
}
