<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = User::create([
        	'name' => env('ADMIN_NAME', 'Super User'),
        	'email' => env('ADMIN_EMAIL', 'fake@yourapp.com'),
        	'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
        ]);
    }
}
