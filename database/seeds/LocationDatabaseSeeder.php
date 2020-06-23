<?php

use Illuminate\Database\Seeder;
use App\Database;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = Database::create([
        	'location_id' => 1,
        	'host' => env('SEED_DB_HOST', '127.0.0.1'),
        	'port' => env('SEED_DB_PORT', '1433'),
        	'catalog' => env('SEED_DB_DATABASE', 'Test'),
        	'username' => env('SEED_DB_USERNAME', 'root'),
        	'password' => env('SEED_DB_PASSWORD', ''),

        ]);
    }
}
