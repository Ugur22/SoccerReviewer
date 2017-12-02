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
            'name' => 'Ugur Ertas',
            'speed' => 80,
            'passing' => 80,
            'Shooting' => 80,
            'Teamwork' => 80,
            'Defence' => 80,
            'Stamina' => 80,
            'Keeper' => 80,
            'total' => 80,
        ]);
    }
}
