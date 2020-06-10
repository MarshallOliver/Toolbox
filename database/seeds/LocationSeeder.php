<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = Location::create([
        	'short_name' => env('SEED_LOCATION_SHORT_NAME', 'TST'),
        	'long_name' => env('SEED_LOCATION_LONG_NAME', 'Test'),
        	'address1' => env('SEED_LOCATION_ADDRESS_1', '123 Main St'),
        	'address2' => env('SEED_LOCATION_ADDRESS_2', ''),
        	'city' => env('SEED_LOCATION_CITY', 'Testerton'),
        	'state' => env('SEED_LOCATION_STATE', 'NV'),
        	'zip_code' => env('SEED_LOCATION_ZIP_CODE', '12345'),

        ]);
    }
}
