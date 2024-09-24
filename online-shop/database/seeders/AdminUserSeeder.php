<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(['email' => 'admin@com.com'],[
            'name' => 'Admin',
            'password' => bcrypt('12345678')
        ]);

        $role = Role::updateOrCreate(['name' => 'Admin']);

        $user->assignRole([$role->id]);
    }
}
