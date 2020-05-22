<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create([
        	'name' => 'Administrator',
        	'permissions' => [
        		'view-location' => true,
        	]
        ]);

        $user = Role::create([
        	'name' => 'User',
        	'permissions' => [
        		'view-location' => false,
        	]
        ]);
    }
}
