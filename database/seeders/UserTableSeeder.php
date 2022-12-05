<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'first_name' => 'super',
            'last_name'  => 'admin',
            'email'      => 'super_admin@app.com',
            'password'   => bcrypt('12345'),
            'password_confirmation'   => bcrypt('12345'),


        ]);
        $user->attachRole('super_admin');
    }
}
