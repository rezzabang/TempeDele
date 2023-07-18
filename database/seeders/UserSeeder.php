<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run() : void
    {
        User::create([
            'name' => 'Rezza Aditiya Prayudha',
            'username' => 'mamang',
            'password' => bcrypt('@Rezzabang1'),
        ]);
    }
}
