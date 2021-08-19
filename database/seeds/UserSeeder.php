<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'amardikamahdi@gmail.com',
            'password' => Hash::make('dikadika1'),
        ])->assignRole('admin');
        User::create([
            'name' => 'Agustina',
            'email' => 'agustinadwirahayu@gmail.com',
            'password' => Hash::make('agustina')
        ])->assignRole('user');
    }
}
