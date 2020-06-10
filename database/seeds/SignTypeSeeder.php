<?php

use Illuminate\Database\Seeder;
use App\SignType;

class SignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $RoomCards = SignType::create([
        	'name' => 'Room Card',
        ]);
    }
}
