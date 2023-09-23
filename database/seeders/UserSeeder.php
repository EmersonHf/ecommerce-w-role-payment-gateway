<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::inRandomOrder()->first();
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johndoe2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // You can change this to a hashed password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => $role['name']
        ]);
    }
}
