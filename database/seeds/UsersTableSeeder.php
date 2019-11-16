<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'test',
            'lastname' => 'test',
            'email' => 'testfgc@mailinator.com',
            'password' => Hash::make('test'),
        ]);
    }
}
