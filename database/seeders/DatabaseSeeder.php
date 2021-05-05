<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
