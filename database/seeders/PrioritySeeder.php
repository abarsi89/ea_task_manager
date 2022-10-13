<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            'priority' => 'alacsony',
        ]);
        DB::table('priorities')->insert([
            'priority' => 'közepes',
        ]);
        DB::table('priorities')->insert([
            'priority' => 'magas',
        ]);
    }
}
