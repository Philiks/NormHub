<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('strongadminpassword'),
            'profile_photo' => 'profiles/admins/admin.png',
            'is_admin' => true
        ]);
    }
}
