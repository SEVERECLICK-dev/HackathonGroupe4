<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cours')->insert([
            [
                'nom' => 'HTML / CSS',
            ],
            [
                'nom' => 'Javascript',
            ],   
            [
                'nom' => 'React JS',
            ],
            [
                'nom' => 'Laravel',
            ],   
        ]);
    }
}
