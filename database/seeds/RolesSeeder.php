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
                'update-screens' => true,
        		'list-locations' => true,
                'create-locations' => true,
                'view-locations' => true,
                'edit-locations' => true,
                'destroy-locations' => true,

        	]
        ]);

        $user = Role::create([
        	'name' => 'User',
        	'permissions' => [
                'update-screens' => false,
                'list-locations' => false,
                'create-locations' => false,
                'view-locations' => false,
                'edit-locations' => false,
                'destroy-locations' => false,
        	]
        ]);
    }
}
