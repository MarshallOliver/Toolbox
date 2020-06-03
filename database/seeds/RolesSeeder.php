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
                'create-databases' => true,
                'edit-databases' => true,
                'destroy-databases' => true,
<<<<<<< HEAD
                'list-signs' => true,
                'create-signs' => true,
                'view-signs' => true,
                'edit-signs' => true,
                'destroy-signs' => true,
=======
>>>>>>> 265320a05eed5b6e7498355e80ab419581b2b41e

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
                'create-databases' => false,
                'edit-databases' => false,
                'destroy-databases' => false,
<<<<<<< HEAD
                'list-signs' => false,
                'create-signs' => false,
                'view-signs' => false,
                'edit-signs' => false,
                'destroy-signs' => false,
=======
>>>>>>> 265320a05eed5b6e7498355e80ab419581b2b41e

            ]
        ]);
    }
}
