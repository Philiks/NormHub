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
        $photo = Photo::create([
            'folder' => 'admin/profiles',
            'filename' => 'admin.png'
        ]);

        User::create([
            'fullname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('strongadminpassword'),
            'profile_id' => $photo->id,
            'is_admin' => true
        ]);
    }
}
