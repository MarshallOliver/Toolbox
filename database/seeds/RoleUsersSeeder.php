<?php

use Illuminate\Database\Seeder;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = DB::table('role_users')->insert([
        	'user_id' => App\User::where('email', env('ADMIN_EMAIL', 'fake@yourapp.com'))->first()->id,
        	'role_id' => App\Role::where('name', 'Administrator')->first()->id,
        ]); 

    }
}
