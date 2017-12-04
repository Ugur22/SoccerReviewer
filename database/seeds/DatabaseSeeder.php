<?php

use Illuminate\Database\Seeder;
use App\Models\Players;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Players::create([
            'name' => 'Robert',
            'speed' => 70,
            'passing' =>  70,
            'Shooting' =>  70,
            'Teamwork' =>  70,
            'Defence' =>  70,
            'Stamina' => 80,
            'Keeper' => 80,
            'total' => 80,
        ]);
    }
}
