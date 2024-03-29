<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@ndachi.dev',
            'password' => bcrypt('Password'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole(Role::ADMIN);
    }
}
