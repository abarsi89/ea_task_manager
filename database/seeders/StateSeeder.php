<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'state' => 'bejelentve',
        ]);
        DB::table('states')->insert([
            'state' => 'hozzárendelve valakihez',
        ]);
        DB::table('states')->insert([
            'state' => 'folyamatban',
        ]);
        DB::table('states')->insert([
            'state' => 'tesztelhető',
        ]);
        DB::table('states')->insert([
            'state' => 'kész',
        ]);
    }
}
