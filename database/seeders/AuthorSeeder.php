<?php

namespace Database\Seeders;

use App\Facades\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'Michael Angelo Cerro',
            'username' => 'michael',
            'email' => 'michael@gmail.com',
            'password' => bcrypt('michaelangelocerro'),
        ]);

        User::create([
            'fullname' => 'Raffy Wamar',
            'username' => 'raffy',
            'email' => 'raffy@gmail.com',
            'password' => bcrypt('raffywamar'),
        ]);
    }
}
