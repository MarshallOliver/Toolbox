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
        	'name' => 'Andretti',
        	'email' => 'support@andrettikarting.com',
        	'password' => Hash::make('Andretti'),
        ]);
    }
}
