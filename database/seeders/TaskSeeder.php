<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'name' => 'Fontos feladat',
            'due_date' => '2022-10-29',
            'description' => 'Muszáj elvégezni.',
            'priority_id' => '3',
            'state_id' => '1',
            'created_by' => '1',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('tasks')->insert([
            'name' => 'Nem fontosfeladat',
            'due_date' => '2022-10-29',
            'description' => 'Nem muszáj elvégezni.',
            'priority_id' => '1',
            'state_id' => '1',
            'created_by' => '1',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);
    }
}
